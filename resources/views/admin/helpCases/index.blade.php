@extends('layouts.admin')
@section('content')
@can('help_case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.help-cases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.helpCase.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.helpCase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-HelpCase">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.helpCase.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.helpCase.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.helpCase.fields.image') }}
                        </th>
                         <th>
                            {{ trans('cruds.news.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($helpCases as $key => $helpCase)
                        <tr data-entry-id="{{ $helpCase->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $helpCase->id ?? '' }}
                            </td>
                            <td>
                                {{ $helpCase->title ?? '' }}
                            </td>
                            <td>
                                @foreach($helpCase->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\HelpCase::TYPE_SELECT[$helpCase->type] ?? '' }}
                            </td>
                            <td>
                                @can('help_case_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.help-cases.show', $helpCase->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('help_case_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.help-cases.edit', $helpCase->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('help_case_delete')
                                    <form action="{{ route('admin.help-cases.destroy', $helpCase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('help_case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.help-cases.massDestroy') }}",
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
  let table = $('.datatable-HelpCase:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection