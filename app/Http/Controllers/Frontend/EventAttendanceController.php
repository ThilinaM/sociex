<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventAttendanceRequest;
use App\Http\Requests\StoreEventAttendanceRequest;
use App\Http\Requests\UpdateEventAttendanceRequest;
use App\Models\Event;
use App\Models\EventAttendance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventAttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendances = EventAttendance::with(['event', 'created_by'])->get();

        return view('frontend.eventAttendances.index', compact('eventAttendances'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventAttendances.create', compact('events'));
    }

    public function store(StoreEventAttendanceRequest $request)
    {
        $eventAttendance = EventAttendance::create($request->all());

        return redirect()->route('frontend.event-attendances.index');
    }

    public function edit(EventAttendance $eventAttendance)
    {
        abort_if(Gate::denies('event_attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventAttendance->load('event', 'created_by');

        return view('frontend.eventAttendances.edit', compact('eventAttendance', 'events'));
    }

    public function update(UpdateEventAttendanceRequest $request, EventAttendance $eventAttendance)
    {
        $eventAttendance->update($request->all());

        return redirect()->route('frontend.event-attendances.index');
    }

    public function show(EventAttendance $eventAttendance)
    {
        abort_if(Gate::denies('event_attendance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendance->load('event', 'created_by');

        return view('frontend.eventAttendances.show', compact('eventAttendance'));
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
