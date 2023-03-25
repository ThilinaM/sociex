@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.eventSetting.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.event-settings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $eventSetting->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event') }}
                                    </th>
                                    <td>
                                        {{ $eventSetting->event->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_reminder_sms') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $eventSetting->event_reminder_sms ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_remind_sms') }}
                                    </th>
                                    <td>
                                        {{ $eventSetting->event_remind_sms }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_form_sms') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $eventSetting->event_attend_form_sms ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_form_filling_message') }}
                                    </th>
                                    <td>
                                        {{ $eventSetting->event_attend_form_filling_message }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_thank_sms') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $eventSetting->event_attend_thank_sms ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_thank_message') }}
                                    </th>
                                    <td>
                                        {{ $eventSetting->event_attend_thank_message }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.event-settings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection