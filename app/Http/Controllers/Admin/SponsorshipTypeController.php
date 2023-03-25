<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySponsorshipTypeRequest;
use App\Http\Requests\StoreSponsorshipTypeRequest;
use App\Http\Requests\UpdateSponsorshipTypeRequest;
use App\Models\SponsorshipType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SponsorshipTypeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('sponsorship_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SponsorshipType::with(['created_by'])->select(sprintf('%s.*', (new SponsorshipType)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sponsorship_type_show';
                $editGate      = 'sponsorship_type_edit';
                $deleteGate    = 'sponsorship_type_delete';
                $crudRoutePart = 'sponsorship-types';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.sponsorshipTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sponsorship_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sponsorshipTypes.create');
    }

    public function store(StoreSponsorshipTypeRequest $request)
    {
        $sponsorshipType = SponsorshipType::create($request->all());

        return redirect()->route('admin.sponsorship-types.index');
    }

    public function edit(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->load('created_by');

        return view('admin.sponsorshipTypes.edit', compact('sponsorshipType'));
    }

    public function update(UpdateSponsorshipTypeRequest $request, SponsorshipType $sponsorshipType)
    {
        $sponsorshipType->update($request->all());

        return redirect()->route('admin.sponsorship-types.index');
    }

    public function show(SponsorshipType $sponsorshipType)
    {
        abort_if(Gate::denies('sponsorship_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipType->load('created_by');

        return view('admin.sponsorshipTypes.show', compact('sponsorshipType'));
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
