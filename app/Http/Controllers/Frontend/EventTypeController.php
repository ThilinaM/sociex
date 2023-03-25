<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventTypeRequest;
use App\Http\Requests\StoreEventTypeRequest;
use App\Http\Requests\UpdateEventTypeRequest;
use App\Models\EventType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventTypes = EventType::with(['created_by'])->get();

        return view('frontend.eventTypes.index', compact('eventTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.eventTypes.create');
    }

    public function store(StoreEventTypeRequest $request)
    {
        $eventType = EventType::create($request->all());

        return redirect()->route('frontend.event-types.index');
    }

    public function edit(EventType $eventType)
    {
        abort_if(Gate::denies('event_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventType->load('created_by');

        return view('frontend.eventTypes.edit', compact('eventType'));
    }

    public function update(UpdateEventTypeRequest $request, EventType $eventType)
    {
        $eventType->update($request->all());

        return redirect()->route('frontend.event-types.index');
    }

    public function show(EventType $eventType)
    {
        abort_if(Gate::denies('event_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventType->load('created_by');

        return view('frontend.eventTypes.show', compact('eventType'));
    }

    public function destroy(EventType $eventType)
    {
        abort_if(Gate::denies('event_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventTypeRequest $request)
    {
        $eventTypes = EventType::find(request('ids'));

        foreach ($eventTypes as $eventType) {
            $eventType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
