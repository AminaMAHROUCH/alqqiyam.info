@extends('layouts.admin')
@section('content')
@can('province_partner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.national-partners.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.nationalPartner.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.nationalPartner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-NationalPartner">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.nom') }}
                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.responsable') }}
                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.tel') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nationalPartners as $key => $nationalPartner)
                        <tr data-entry-id="{{ $nationalPartner->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $nationalPartner->id ?? '' }}
                            </td>
                            <td>
                                {{ $nationalPartner->nom ?? '' }}
                            </td>
                            <td>
                                @if($nationalPartner->image)
                                    <a href="{{ $nationalPartner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $nationalPartner->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>

                            <td>
                                {{ $nationalPartner->responsable ?? '' }}
                            </td>
                            <td>
                                {{ $nationalPartner->email ?? '' }}
                            </td>
                            <td>
                                {{ $nationalPartner->tel ?? '' }}
                            </td>
                            <td>
                                @can('national_partner_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.national-partners.show', $nationalPartner->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('national_partner_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.national-partners.edit', $nationalPartner->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('national_partner_delete')
                                    <form action="{{ route('admin.national-partners.destroy', $nationalPartner->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('national_partner_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.national-partners.massDestroy') }}",
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
  let table = $('.datatable-NationalPartner:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection