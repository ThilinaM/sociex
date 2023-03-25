@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('event_registration_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.event-registrations.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.eventRegistration.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.eventRegistration.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EventRegistration">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.event') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.start_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.end_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.first_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.last_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.gender') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.eventRegistration.fields.whatsup') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventRegistrations as $key => $eventRegistration)
                                    <tr data-entry-id="{{ $eventRegistration->id }}">
                                        <td>
                                            {{ $eventRegistration->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->event->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->event->start_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->event->end_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->first_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\EventRegistration::GENDER_SELECT[$eventRegistration->gender] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $eventRegistration->whatsup ?? '' }}
                                        </td>
                                        <td>
                                            @can('event_registration_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.event-registrations.show', $eventRegistration->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_registration_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.event-registrations.edit', $eventRegistration->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('event_registration_delete')
                                                <form action="{{ route('frontend.event-registrations.destroy', $eventRegistration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_registration_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.event-registrations.massDestroy') }}",
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
  let table = $('.datatable-EventRegistration:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection