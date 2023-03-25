<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySponsorshipTrackingRequest;
use App\Http\Requests\StoreSponsorshipTrackingRequest;
use App\Http\Requests\UpdateSponsorshipTrackingRequest;
use App\Models\SponsorshipTracking;
use App\Models\SponsorshipType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SponsorshipTrackingController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sponsorship_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTrackings = SponsorshipTracking::with(['sponsorship_type', 'created_by', 'media'])->get();

        return view('frontend.sponsorshipTrackings.index', compact('sponsorshipTrackings'));
    }

    public function create()
    {
        abort_if(Gate::denies('sponsorship_tracking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorship_types = SponsorshipType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.sponsorshipTrackings.create', compact('sponsorship_types'));
    }

    public function store(StoreSponsorshipTrackingRequest $request)
    {
        $sponsorshipTracking = SponsorshipTracking::create($request->all());

        if ($request->input('logo', false)) {
            $sponsorshipTracking->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sponsorshipTracking->id]);
        }

        return redirect()->route('frontend.sponsorship-trackings.index');
    }

    public function edit(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorship_types = SponsorshipType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsorshipTracking->load('sponsorship_type', 'created_by');

        return view('frontend.sponsorshipTrackings.edit', compact('sponsorshipTracking', 'sponsorship_types'));
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

        return redirect()->route('frontend.sponsorship-trackings.index');
    }

    public function show(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTracking->load('sponsorship_type', 'created_by');

        return view('frontend.sponsorshipTrackings.show', compact('sponsorshipTracking'));
    }

    public function destroy(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTracking->delete();

        return back();
    }

    public function massDestroy(MassDestroySponsorshipTrackingRequest $request)
    {
        $sponsorshipTrackings = SponsorshipTracking::find(request('ids'));

        foreach ($sponsorshipTrackings as $sponsorshipTracking) {
            $sponsorshipTracking->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sponsorship_tracking_create') && Gate::denies('sponsorship_tracking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SponsorshipTracking();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
