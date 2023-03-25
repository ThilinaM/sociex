<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventFeedbackRequest;
use App\Http\Requests\StoreEventFeedbackRequest;
use App\Http\Requests\UpdateEventFeedbackRequest;
use App\Models\Event;
use App\Models\EventFeedback;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventFeedbackController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedbacks = EventFeedback::with(['event', 'created_by'])->get();

        return view('frontend.eventFeedbacks.index', compact('eventFeedbacks'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_feedback_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventFeedbacks.create', compact('events'));
    }

    public function store(StoreEventFeedbackRequest $request)
    {
        $eventFeedback = EventFeedback::create($request->all());

        return redirect()->route('frontend.event-feedbacks.index');
    }

    public function edit(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventFeedback->load('event', 'created_by');

        return view('frontend.eventFeedbacks.edit', compact('eventFeedback', 'events'));
    }

    public function update(UpdateEventFeedbackRequest $request, EventFeedback $eventFeedback)
    {
        $eventFeedback->update($request->all());

        return redirect()->route('frontend.event-feedbacks.index');
    }

    public function show(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedback->load('event', 'created_by');

        return view('frontend.eventFeedbacks.show', compact('eventFeedback'));
    }

    public function destroy(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedback->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventFeedbackRequest $request)
    {
        $eventFeedbacks = EventFeedback::find(request('ids'));

        foreach ($eventFeedbacks as $eventFeedback) {
            $eventFeedback->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
