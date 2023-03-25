@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.eventSetting.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-settings.update", [$eventSetting->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="event_id">{{ trans('cruds.eventSetting.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id">
                                @foreach($events as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventSetting->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="event_reminder_sms" value="0">
                                <input type="checkbox" name="event_reminder_sms" id="event_reminder_sms" value="1" {{ $eventSetting->event_reminder_sms || old('event_reminder_sms', 0) === 1 ? 'checked' : '' }}>
                                <label for="event_reminder_sms">{{ trans('cruds.eventSetting.fields.event_reminder_sms') }}</label>
                            </div>
                            @if($errors->has('event_reminder_sms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_reminder_sms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_reminder_sms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="event_remind_sms">{{ trans('cruds.eventSetting.fields.event_remind_sms') }}</label>
                            <input class="form-control" type="text" name="event_remind_sms" id="event_remind_sms" value="{{ old('event_remind_sms', $eventSetting->event_remind_sms) }}">
                            @if($errors->has('event_remind_sms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_remind_sms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_remind_sms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="event_attend_form_sms" value="0">
                                <input type="checkbox" name="event_attend_form_sms" id="event_attend_form_sms" value="1" {{ $eventSetting->event_attend_form_sms || old('event_attend_form_sms', 0) === 1 ? 'checked' : '' }}>
                                <label for="event_attend_form_sms">{{ trans('cruds.eventSetting.fields.event_attend_form_sms') }}</label>
                            </div>
                            @if($errors->has('event_attend_form_sms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_attend_form_sms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_attend_form_sms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="event_attend_form_filling_message">{{ trans('cruds.eventSetting.fields.event_attend_form_filling_message') }}</label>
                            <input class="form-control" type="text" name="event_attend_form_filling_message" id="event_attend_form_filling_message" value="{{ old('event_attend_form_filling_message', $eventSetting->event_attend_form_filling_message) }}">
                            @if($errors->has('event_attend_form_filling_message'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_attend_form_filling_message') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_attend_form_filling_message_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="event_attend_thank_sms" value="0">
                                <input type="checkbox" name="event_attend_thank_sms" id="event_attend_thank_sms" value="1" {{ $eventSetting->event_attend_thank_sms || old('event_attend_thank_sms', 0) === 1 ? 'checked' : '' }}>
                                <label for="event_attend_thank_sms">{{ trans('cruds.eventSetting.fields.event_attend_thank_sms') }}</label>
                            </div>
                            @if($errors->has('event_attend_thank_sms'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_attend_thank_sms') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_attend_thank_sms_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="event_attend_thank_message">{{ trans('cruds.eventSetting.fields.event_attend_thank_message') }}</label>
                            <input class="form-control" type="text" name="event_attend_thank_message" id="event_attend_thank_message" value="{{ old('event_attend_thank_message', $eventSetting->event_attend_thank_message) }}">
                            @if($errors->has('event_attend_thank_message'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_attend_thank_message') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventSetting.fields.event_attend_thank_message_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection