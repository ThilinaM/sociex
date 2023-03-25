<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SponsorshipTrackingController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sponsorship_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SponsorshipTracking::with(['sponsorship_type', 'created_by'])->select(sprintf('%s.*', (new SponsorshipTracking)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sponsorship_tracking_show';
                $editGate      = 'sponsorship_tracking_edit';
                $deleteGate    = 'sponsorship_tracking_delete';
                $crudRoutePart = 'sponsorship-trackings';

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
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('sponsorship_type_name', function ($row) {
                return $row->sponsorship_type ? $row->sponsorship_type->name : '';
            });

            $table->editColumn('display_status', function ($row) {
                return $row->display_status ? SponsorshipTracking::DISPLAY_STATUS_SELECT[$row->display_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo', 'sponsorship_type']);

            return $table->make(true);
        }

        return view('admin.sponsorshipTrackings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sponsorship_tracking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorship_types = SponsorshipType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sponsorshipTrackings.create', compact('sponsorship_types'));
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

        return redirect()->route('admin.sponsorship-trackings.index');
    }

    public function edit(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorship_types = SponsorshipType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sponsorshipTracking->load('sponsorship_type', 'created_by');

        return view('admin.sponsorshipTrackings.edit', compact('sponsorshipTracking', 'sponsorship_types'));
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

        return redirect()->route('admin.sponsorship-trackings.index');
    }

    public function show(SponsorshipTracking $sponsorshipTracking)
    {
        abort_if(Gate::denies('sponsorship_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sponsorshipTracking->load('sponsorship_type', 'created_by');

        return view('admin.sponsorshipTrackings.show', compact('sponsorshipTracking'));
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
