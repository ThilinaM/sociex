@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('event_attendance_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.event-attendances.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.eventAttendance.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.eventAttendance.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EventAttendance">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.event') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.start_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventAttendance.fields.whatsup') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventAttendances as $key => $eventAttendance)
                                    <tr data-entry-id="{{ $eventAttendance->id }}">
                                        <td>
                                            {{ $eventAttendance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->event->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->event->start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventAttendance->whatsup ?? '' }}
                                        </td>
                                        <td>
                                            @can('event_attendance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.event-attendances.show', $eventAttendance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_attendance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.event-attendances.edit', $eventAttendance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('event_attendance_delete')
                                                <form action="{{ route('frontend.event-attendances.destroy', $eventAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.event-attendances.massDestroy') }}",
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
  let table = $('.datatable-EventAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection