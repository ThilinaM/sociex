<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSponsorshipTrackingRequest;
use App\Http\Requests\UpdateSponsorshipTrackingRequest;
use App\Http\Resources\Admin\SponsorshipTrackingResource;
use App\Models\SponsorshipTracking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SponsorshipTrackingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sponsorship_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SponsorshipTrackingResource(SponsorshipTracking::with(['sponsorship_type', 'created_by'])->get());
    }

    public function store(StoreSponsorshipTrackingRequest $request)
    {
        $sponsorshipTracking = SponsorshipTracking::create($request->all());

        if ($request->input('logo', false)) {
            $sponsorshipTracking->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        return (new SponsorshipTrackingResource($sponsorshipTracking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SponsorshipTrackingResource($sponsorshipTracking->load(['sponsorship_type', 'created_by']));
    }

    public function update(UpdateSponsorshipTrackingRequest $request, SponsorshipTracking $sponsorshipTracking)
    {
        $sponsorshipTracking->update($request->all());

        if ($request->input('logo', false)) {
            if (! $sponsorshipTracking->logo || $request->input('logo') !== $sponsorshipTracking->logo->file_name) {
                if ($sponsorshipTracking->logo) {
                    $sponsorshipTracking->logo->delete();
                }
                $sponsorshipTracking->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($sponsorshipTracking->logo) {
            $sponsorshipTracking->logo->delete();
        }

        return (new SponsorshipTrackingResource($sponsorshipTracking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTracking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
