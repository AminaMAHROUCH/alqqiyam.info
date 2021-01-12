@extends('layouts.admin')
@section('content')
@can('link_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class="btn  btn-success" type="button"  data-toggle="modal" data-target="#createModal1">{{ trans('global.add') }} {{ trans('cruds.link.title_singular') }}</button>
        </div> 
    </div>
@endcan 
<div class="card">
    <div class="card-header">
        {{ trans('cruds.link.title_singular') }} {{ trans('global.list') }}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Link">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.link.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.link.fields.link') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $key => $link)
                        <tr data-entry-id="{{ $link->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $link->id ?? '' }}
                            </td>
                            <td>
                                {{ $link->title ?? '' }}
                            </td>
                            <td>
                                {{ $link->link ?? '' }}
                            </td>
                            <td>
                               @can('link_show')
                                     <button class="btn btn-xs btn-primary" href="{{ route('admin.links.show', $link->id) }}" type="button"  data-toggle="modal" data-target="#showModal{{$link->id}}">{{ trans('global.view') }}</button>
                                @endcan

                                @can('link_edit')
                                    <button class="btn btn-xs btn-info" type="button"  data-toggle="modal" data-target="#editModal{{$link->id}}">{{ trans('global.edit') }}</button>
                                @endcan

                                @can('link_delete')
                                    <form action="{{ route('admin.links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@foreach($links as $key => $link)
<!-- Edit  -->
<div id="editModal{{$link->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.edit') }} {{ trans('cruds.link.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
        <form method="POST" action="{{ route("admin.links.update", [$link->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.link.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $link->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.link.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $link->link) }}" required>
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.link.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
       </div>
      </div>
    </div>
  </div>
   <!-- fin Modal -->
   <!-- Show  -->
<div id="showModal{{$link->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.view') }} {{ trans('cruds.link.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="card-body">
         <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.id') }}
                        </th>
                        <td>
                            {{ $link->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.title') }}
                        </th>
                        <td>
                            {{ $link->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.link.fields.link') }}
                        </th>
                        <td>
                            {{ $link->link }}
                        </td>
                    </tr>
                </tbody>
         </table>
         </div>
      </div>
    </div>
  </div>
   <!-- fin Modal -->
@endforeach
 <!-- Create Modal -->
  <div id="createModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title">{{ trans('global.add') }} {{ trans('cruds.directorate.title_singular') }} </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="card-body">
         <form method="POST" action="{{ route("admin.links.store") }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label class="required" for="title">{{ trans('cruds.link.fields.title') }}</label>
                  <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                  @if($errors->has('title'))
                      <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.link.fields.title_helper') }}</span>
              </div>
              <div class="form-group">
                  <label class="required" for="link">{{ trans('cruds.link.fields.link') }}</label>
                  <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                  @if($errors->has('link'))
                      <span class="text-danger">{{ $errors->first('link') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.link.fields.link_helper') }}</span>
              </div>
              <div class="form-group">
                  <button class="btn btn-danger" type="submit">
                      {{ trans('global.save') }}
                  </button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
   <!-- fin Modal -->


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('link_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.links.massDestroy') }}",
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
  let table = $('.datatable-Link:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection