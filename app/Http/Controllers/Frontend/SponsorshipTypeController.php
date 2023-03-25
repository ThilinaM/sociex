<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySponsorshipTypeRequest;
use App\Http\Requests\StoreSponsorshipTypeRequest;
use App\Http\Requests\UpdateSponsorshipTypeRequest;
use App\Models\SponsorshipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SponsorshipTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sponsorship_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTypes = SponsorshipType::with(['created_by'])->get();

        return view('frontend.sponsorshipTypes.index', compact('sponsorshipTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('sponsorship_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.sponsorshipTypes.create');
    }

    public function store(StoreSponsorshipTypeRequest $request)
    {
        $sponsorshipType = SponsorshipType::create($request->all());

        return redirect()->route('frontend.sponsorship-types.index');
    }

    public function edit(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->load('created_by');

        return view('frontend.sponsorshipTypes.edit', compact('sponsorshipType'));
    }

    public function update(UpdateSponsorshipTypeRequest $request, SponsorshipType $sponsorshipType)
    {
        $sponsorshipType->update($request->all());

        return redirect()->route('frontend.sponsorship-types.index');
    }

    public function show(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->load('created_by');

        return view('frontend.sponsorshipTypes.show', compact('sponsorshipType'));
    }

    public function destroy(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->delete();

        return back();
    }

    public function massDestroy(MassDestroySponsorshipTypeRequest $request)
    {
        $sponsorshipTypes = SponsorshipType::find(request('ids'));

        foreach ($sponsorshipTypes as $sponsorshipType) {
            $sponsorshipType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
