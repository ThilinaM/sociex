@extends('layouts.admin')
@section('content')
@can('event_setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.event-settings.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EventSetting">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-settings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.event-settings.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'event_title', name: 'event.title' },
{ data: 'event.start_time', name: 'event.start_time' },
{ data: 'event_reminder_sms', name: 'event_reminder_sms' },
{ data: 'event_remind_sms', name: 'event_remind_sms' },
{ data: 'event_attend_form_sms', name: 'event_attend_form_sms' },
{ data: 'event_attend_form_filling_message', name: 'event_attend_form_filling_message' },
{ data: 'event_attend_thank_sms', name: 'event_attend_thank_sms' },
{ data: 'event_attend_thank_message', name: 'event_attend_thank_message' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EventSetting').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection