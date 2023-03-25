@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.eventSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.event-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="event_id">{{ trans('cruds.eventSetting.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id">
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <div class="form-check {{ $errors->has('event_reminder_sms') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_reminder_sms" value="0">
                    <input class="form-check-input" type="checkbox" name="event_reminder_sms" id="event_reminder_sms" value="1" {{ old('event_reminder_sms', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_reminder_sms">{{ trans('cruds.eventSetting.fields.event_reminder_sms') }}</label>
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
                <input class="form-control {{ $errors->has('event_remind_sms') ? 'is-invalid' : '' }}" type="text" name="event_remind_sms" id="event_remind_sms" value="{{ old('event_remind_sms', '') }}">
                @if($errors->has('event_remind_sms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_remind_sms') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventSetting.fields.event_remind_sms_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('event_attend_form_sms') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_attend_form_sms" value="0">
                    <input class="form-check-input" type="checkbox" name="event_attend_form_sms" id="event_attend_form_sms" value="1" {{ old('event_attend_form_sms', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_attend_form_sms">{{ trans('cruds.eventSetting.fields.event_attend_form_sms') }}</label>
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
                <input class="form-control {{ $errors->has('event_attend_form_filling_message') ? 'is-invalid' : '' }}" type="text" name="event_attend_form_filling_message" id="event_attend_form_filling_message" value="{{ old('event_attend_form_filling_message', '') }}">
                @if($errors->has('event_attend_form_filling_message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_attend_form_filling_message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.eventSetting.fields.event_attend_form_filling_message_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('event_attend_thank_sms') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_attend_thank_sms" value="0">
                    <input class="form-check-input" type="checkbox" name="event_attend_thank_sms" id="event_attend_thank_sms" value="1" {{ old('event_attend_thank_sms', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_attend_thank_sms">{{ trans('cruds.eventSetting.fields.event_attend_thank_sms') }}</label>
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
                <input class="form-control {{ $errors->has('event_attend_thank_message') ? 'is-invalid' : '' }}" type="text" name="event_attend_thank_message" id="event_attend_thank_message" value="{{ old('event_attend_thank_message', '') }}">
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



@endsection