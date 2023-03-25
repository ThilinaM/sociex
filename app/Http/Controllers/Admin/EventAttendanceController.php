<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventAttendanceRequest;
use App\Http\Requests\StoreEventAttendanceRequest;
use App\Http\Requests\UpdateEventAttendanceRequest;
use App\Models\Event;
use App\Models\EventAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventAttendanceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventAttendance::with(['event', 'created_by'])->select(sprintf('%s.*', (new EventAttendance)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'event_attendance_show';
                $editGate      = 'event_attendance_edit';
                $deleteGate    = 'event_attendance_delete';
                $crudRoutePart = 'event-attendances';

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
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('whatsup', function ($row) {
                return $row->whatsup ? $row->whatsup : '';
            });
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->editColumn('event.start_time', function ($row) {
                return $row->event ? (is_string($row->event) ? $row->event : $row->event->start_time) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event']);

            return $table->make(true);
        }

        return view('admin.eventAttendances.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('event_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventAttendances.create', compact('events'));
    }

    public function store(StoreEventAttendanceRequest $request)
    {
        $eventAttendance = EventAttendance::create($request->all());

        return redirect()->route('admin.event-attendances.index');
    }

    public function edit(EventAttendance $eventAttendance)
    {
        abort_if(Gate::denies('event_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventAttendance->load('event', 'created_by');

        return view('admin.eventAttendances.edit', compact('eventAttendance', 'events'));
    }

    public function update(UpdateEventAttendanceRequest $request, EventAttendance $eventAttendance)
    {
        $eventAttendance->update($request->all());

        return redirect()->route('admin.event-attendances.index');
    }

    public function show(EventAttendance $eventAttendance)
    {
        abort_if(Gate::denies('event_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendance->load('event', 'created_by');

        return view('admin.eventAttendances.show', compact('eventAttendance'));
    }

    public function destroy(EventAttendance $eventAttendance)
    {
        abort_if(Gate::denies('event_attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendance->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventAttendanceRequest $request)
    {
        $eventAttendances = EventAttendance::find(request('ids'));

        foreach ($eventAttendances as $eventAttendance) {
            $eventAttendance->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
