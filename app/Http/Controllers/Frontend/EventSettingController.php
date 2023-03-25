<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventSettingRequest;
use App\Http\Requests\StoreEventSettingRequest;
use App\Http\Requests\UpdateEventSettingRequest;
use App\Models\Event;
use App\Models\EventSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventSettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventSettings = EventSetting::with(['event', 'created_by'])->get();

        return view('frontend.eventSettings.index', compact('eventSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.eventSettings.create', compact('events'));
    }

    public function store(StoreEventSettingRequest $request)
    {
        $eventSetting = EventSetting::create($request->all());

        return redirect()->route('frontend.event-settings.index');
    }

    public function edit(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventSetting->load('event', 'created_by');

        return view('frontend.eventSettings.edit', compact('eventSetting', 'events'));
    }

    public function update(UpdateEventSettingRequest $request, EventSetting $eventSetting)
    {
        $eventSetting->update($request->all());

        return redirect()->route('frontend.event-settings.index');
    }

    public function show(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventSetting->load('event', 'created_by');

        return view('frontend.eventSettings.show', compact('eventSetting'));
    }

    public function destroy(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventSettingRequest $request)
    {
        $eventSettings = EventSetting::find(request('ids'));

        foreach ($eventSettings as $eventSetting) {
            $eventSetting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
