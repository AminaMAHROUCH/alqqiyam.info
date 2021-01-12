@extends('layouts.admin')
@section('content')
@can('etablissement_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.etablissements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.etablissement.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.etablissement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Etablissement">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.name_complet') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.tel_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.tel_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.email_professionel') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.email_personnel') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.direction') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.unite') }}
                        </th>
                        <th>
                            {{ trans('cruds.etablissement.fields.profession') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etablissements as $key => $etablissement)
                        <tr data-entry-id="{{ $etablissement->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $etablissement->id ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->name_complet ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->tel_1 ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->tel_2 ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->email_professionel ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->email_personnel ?? '' }}
                            </td>
                            <td>
                                @if($etablissement->image)
                                    <a href="{{ $etablissement->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $etablissement->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $etablissement->direction->title ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->unite->title ?? '' }}
                            </td>
                            <td>
                                {{ $etablissement->profession->title ?? '' }}
                            </td>
                            <td>
                                @can('etablissement_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.etablissements.show', $etablissement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('etablissement_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.etablissements.edit', $etablissement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('etablissement_delete')
                                    <form action="{{ route('admin.etablissements.destroy', $etablissement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('etablissement_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.etablissements.massDestroy') }}",
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
  let table = $('.datatable-Etablissement:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection