@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.eventFeedback.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.event-feedbacks.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="event_id">{{ trans('cruds.eventFeedback.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id">
                                @foreach($events as $id => $entry)
                                    <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventFeedback.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="feedback">{{ trans('cruds.eventFeedback.fields.feedback') }}</label>
                            <textarea class="form-control" name="feedback" id="feedback">{{ old('feedback') }}</textarea>
                            @if($errors->has('feedback'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('feedback') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventFeedback.fields.feedback_helper') }}</span>
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