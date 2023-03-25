<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSponsorshipTypeRequest;
use App\Http\Requests\UpdateSponsorshipTypeRequest;
use App\Http\Resources\Admin\SponsorshipTypeResource;
use App\Models\SponsorshipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SponsorshipTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sponsorship_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SponsorshipTypeResource(SponsorshipType::with(['created_by'])->get());
    }

    public function store(StoreSponsorshipTypeRequest $request)
    {
        $sponsorshipType = SponsorshipType::create($request->all());

        return (new SponsorshipTypeResource($sponsorshipType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SponsorshipTypeResource($sponsorshipType->load(['created_by']));
    }

    public function update(UpdateSponsorshipTypeRequest $request, SponsorshipType $sponsorshipType)
    {
        $sponsorshipType->update($request->all());

        return (new SponsorshipTypeResource($sponsorshipType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
