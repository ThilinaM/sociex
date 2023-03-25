<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventTypeRequest;
use App\Http\Requests\UpdateEventTypeRequest;
use App\Http\Resources\Admin\EventTypeResource;
use App\Models\EventType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventTypeResource(EventType::with(['created_by'])->get());
    }

    public function store(StoreEventTypeRequest $request)
    {
        $eventType = EventType::create($request->all());

        return (new EventTypeResource($eventType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventType $eventType)
    {
        abort_if(Gate::denies('event_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventTypeResource($eventType->load(['created_by']));
    }

    public function update(UpdateEventTypeRequest $request, EventType $eventType)
    {
        $eventType->update($request->all());

        return (new EventTypeResource($eventType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventType $eventType)
    {
        abort_if(Gate::denies('event_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
