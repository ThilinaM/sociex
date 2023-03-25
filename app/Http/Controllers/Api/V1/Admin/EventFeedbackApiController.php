<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventFeedbackRequest;
use App\Http\Requests\UpdateEventFeedbackRequest;
use App\Http\Resources\Admin\EventFeedbackResource;
use App\Models\EventFeedback;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventFeedbackApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventFeedbackResource(EventFeedback::with(['event', 'created_by'])->get());
    }

    public function store(StoreEventFeedbackRequest $request)
    {
        $eventFeedback = EventFeedback::create($request->all());

        return (new EventFeedbackResource($eventFeedback))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventFeedbackResource($eventFeedback->load(['event', 'created_by']));
    }

    public function update(UpdateEventFeedbackRequest $request, EventFeedback $eventFeedback)
    {
        $eventFeedback->update($request->all());

        return (new EventFeedbackResource($eventFeedback))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventFeedback $eventFeedback)
    {
        abort_if(Gate::denies('event_feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventFeedback->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
