@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.sponsorshipTracking.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.sponsorship-trackings.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $sponsorshipTracking->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $sponsorshipTracking->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($sponsorshipTracking->logo)
                                            <a href="{{ $sponsorshipTracking->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $sponsorshipTracking->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.sponsorship_type') }}
                                    </th>
                                    <td>
                                        {{ $sponsorshipTracking->sponsorship_type->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.display_status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\SponsorshipTracking::DISPLAY_STATUS_SELECT[$sponsorshipTracking->display_status] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.sponsorship-trackings.index') }}">
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