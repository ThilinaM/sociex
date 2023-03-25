<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRegistrationRequest;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\UpdateEventRegistrationRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventRegistrationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventRegistrations = EventRegistration::with(['event', 'created_by'])->get();

        return view('frontend.eventRegistrations.index', compact('eventRegistrations'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_registration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventRegistrations.create', compact('events'));
    }

    public function store(StoreEventRegistrationRequest $request)
    {
        $eventRegistration = EventRegistration::create($request->all());

        return redirect()->route('frontend.event-registrations.index');
    }

    public function edit(EventRegistration $eventRegistration)
    {
        abort_if(Gate::denies('event_registration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventRegistration->load('event', 'created_by');

        return view('frontend.eventRegistrations.edit', compact('eventRegistration', 'events'));
    }

    public function update(UpdateEventRegistrationRequest $request, EventRegistration $eventRegistration)
    {
        $eventRegistration->update($request->all());

        return redirect()->route('frontend.event-registrations.index');
    }

    public function show(EventRegistration $eventRegistration)
    {
        abort_if(Gate::denies('event_registration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventRegistration->load('event', 'created_by');

        return view('frontend.eventRegistrations.show', compact('eventRegistration'));
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
