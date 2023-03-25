@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('event_setting_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.event-settings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.eventSetting.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.eventSetting.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EventSetting">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.start_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_reminder_sms') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_remind_sms') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_form_sms') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_form_filling_message') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_thank_sms') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventSetting.fields.event_attend_thank_message') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventSettings as $key => $eventSetting)
                                    <tr data-entry-id="{{ $eventSetting->id }}">
                                        <td>
                                            {{ $eventSetting->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventSetting->event->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventSetting->event->start_time ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $eventSetting->event_reminder_sms ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $eventSetting->event_reminder_sms ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $eventSetting->event_remind_sms ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $eventSetting->event_attend_form_sms ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $eventSetting->event_attend_form_sms ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $eventSetting->event_attend_form_filling_message ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $eventSetting->event_attend_thank_sms ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $eventSetting->event_attend_thank_sms ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $eventSetting->event_attend_thank_message ?? '' }}
                                        </td>
                                        <td>
                                            @can('event_setting_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.event-settings.show', $eventSetting->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_setting_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.event-settings.edit', $eventSetting->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('event_setting_delete')
                                                <form action="{{ route('frontend.event-settings.destroy', $eventSetting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.event-settings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-EventSetting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection