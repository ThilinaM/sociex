@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.eventAttendance.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.event-attendances.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.event') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->event->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.first_name') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.mobile') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.whatsup') }}
                                    </th>
                                    <td>
                                        {{ $eventAttendance->whatsup }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.event-attendances.index') }}">
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