<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventSettingRequest;
use App\Http\Requests\UpdateEventSettingRequest;
use App\Http\Resources\Admin\EventSettingResource;
use App\Models\EventSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventSettingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventSettingResource(EventSetting::with(['event', 'created_by'])->get());
    }

    public function store(StoreEventSettingRequest $request)
    {
        $eventSetting = EventSetting::create($request->all());

        return (new EventSettingResource($eventSetting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventSettingResource($eventSetting->load(['event', 'created_by']));
    }

    public function update(UpdateEventSettingRequest $request, EventSetting $eventSetting)
    {
        $eventSetting->update($request->all());

        return (new EventSettingResource($eventSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventSetting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
