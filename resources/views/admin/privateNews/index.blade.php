@extends('layouts.admin')
@section('content')
@can('private_news_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.private-news.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.privateNews.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.privateNews.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-PrivateNews">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.privateNews.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.privateNews.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.privateNews.fields.published_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.privateNews.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.privateNews.fields.video') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($privateNews as $key => $privateNews)
                        <tr data-entry-id="{{ $privateNews->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $privateNews->id ?? '' }}
                            </td>
                            <td>
                                {{ $privateNews->title ?? '' }}
                            </td>
                            <td>
                                {{ $privateNews->published_at ?? '' }}
                            </td>
                            <td>
                                @foreach($privateNews->image as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $privateNews->video ?? '' }}
                            </td>
                            <td>
                                @can('private_news_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.private-news.show', $privateNews->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('private_news_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.private-news.edit', $privateNews->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('private_news_delete')
                                    <form action="{{ route('admin.private-news.destroy', $privateNews->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('private_news_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.private-news.massDestroy') }}",
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
  let table = $('.datatable-PrivateNews:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection