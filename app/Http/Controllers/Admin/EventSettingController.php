<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventSettingRequest;
use App\Http\Requests\StoreEventSettingRequest;
use App\Http\Requests\UpdateEventSettingRequest;
use App\Models\Event;
use App\Models\EventSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventSettingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('event_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventSetting::with(['event', 'created_by'])->select(sprintf('%s.*', (new EventSetting)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'event_setting_show';
                $editGate      = 'event_setting_edit';
                $deleteGate    = 'event_setting_delete';
                $crudRoutePart = 'event-settings';

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
            $table->editColumn('event_reminder_sms', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->event_reminder_sms ? 'checked' : null) . '>';
            });
            $table->editColumn('event_remind_sms', function ($row) {
                return $row->event_remind_sms ? $row->event_remind_sms : '';
            });
            $table->editColumn('event_attend_form_sms', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->event_attend_form_sms ? 'checked' : null) . '>';
            });
            $table->editColumn('event_attend_form_filling_message', function ($row) {
                return $row->event_attend_form_filling_message ? $row->event_attend_form_filling_message : '';
            });
            $table->editColumn('event_attend_thank_sms', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->event_attend_thank_sms ? 'checked' : null) . '>';
            });
            $table->editColumn('event_attend_thank_message', function ($row) {
                return $row->event_attend_thank_message ? $row->event_attend_thank_message : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event', 'event_reminder_sms', 'event_attend_form_sms', 'event_attend_thank_sms']);

            return $table->make(true);
        }

        return view('admin.eventSettings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventSettings.create', compact('events'));
    }

    public function store(StoreEventSettingRequest $request)
    {
        $eventSetting = EventSetting::create($request->all());

        return redirect()->route('admin.event-settings.index');
    }

    public function edit(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventSetting->load('event', 'created_by');

        return view('admin.eventSettings.edit', compact('eventSetting', 'events'));
    }

    public function update(UpdateEventSettingRequest $request, EventSetting $eventSetting)
    {
        $eventSetting->update($request->all());

        return redirect()->route('admin.event-settings.index');
    }

    public function show(EventSetting $eventSetting)
    {
        abort_if(Gate::denies('event_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventSetting->load('event', 'created_by');

        return view('admin.eventSettings.show', compact('eventSetting'));
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
