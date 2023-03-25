@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('sponsorship_tracking_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.sponsorship-trackings.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.sponsorshipTracking.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.sponsorshipTracking.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SponsorshipTracking">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.sponsorship_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.sponsorshipTracking.fields.display_status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sponsorshipTrackings as $key => $sponsorshipTracking)
                                    <tr data-entry-id="{{ $sponsorshipTracking->id }}">
                                        <td>
                                            {{ $sponsorshipTracking->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $sponsorshipTracking->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($sponsorshipTracking->logo)
                                                <a href="{{ $sponsorshipTracking->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $sponsorshipTracking->logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $sponsorshipTracking->sponsorship_type->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\SponsorshipTracking::DISPLAY_STATUS_SELECT[$sponsorshipTracking->display_status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('sponsorship_tracking_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.sponsorship-trackings.show', $sponsorshipTracking->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('sponsorship_tracking_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.sponsorship-trackings.edit', $sponsorshipTracking->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('sponsorship_tracking_delete')
                                                <form action="{{ route('frontend.sponsorship-trackings.destroy', $sponsorshipTracking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sponsorship_tracking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.sponsorship-trackings.massDestroy') }}",
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
  let table = $('.datatable-SponsorshipTracking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection