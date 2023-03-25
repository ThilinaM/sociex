<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRegistrationRequest;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\UpdateEventRegistrationRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventRegistrationController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventRegistration::with(['event', 'created_by'])->select(sprintf('%s.*', (new EventRegistration)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'event_registration_show';
                $editGate      = 'event_registration_edit';
                $deleteGate    = 'event_registration_delete';
                $crudRoutePart = 'event-registrations';

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
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->editColumn('event.start_time', function ($row) {
                return $row->event ? (is_string($row->event) ? $row->event : $row->event->start_time) : '';
            });
            $table->editColumn('event.end_time', function ($row) {
                return $row->event ? (is_string($row->event) ? $row->event : $row->event->end_time) : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? EventRegistration::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('whatsup', function ($row) {
                return $row->whatsup ? $row->whatsup : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event']);

            return $table->make(true);
        }

        return view('admin.eventRegistrations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventRegistrations.create', compact('events'));
    }

    public function store(StoreEventRegistrationRequest $request)
    {
        $eventRegistration = EventRegistration::create($request->all());

        return redirect()->route('admin.event-registrations.index');
    }

    public function edit(EventRegistration $eventRegistration)
    {
        abort_if(Gate::denies('event_registration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventRegistration->load('event', 'created_by');

        return view('admin.eventRegistrations.edit', compact('eventRegistration', 'events'));
    }

    public function update(UpdateEventRegistrationRequest $request, EventRegistration $eventRegistration)
    {
        $eventRegistration->update($request->all());

        return redirect()->route('admin.event-registrations.index');
    }

    public function show(EventRegistration $eventRegistration)
    {
        abort_if(Gate::denies('event_registration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventRegistration->load('event', 'created_by');

        return view('admin.eventRegistrations.show', compact('eventRegistration'));
    }

    public function destroy(EventRegistration $eventRegistration)
    {
        abort_if(Gate::denies('event_registration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventRegistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRegistrationRequest $request)
    {
        $eventRegistrations = EventRegistration::find(request('ids'));

        foreach ($eventRegistrations as $eventRegistration) {
            $eventRegistration->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
