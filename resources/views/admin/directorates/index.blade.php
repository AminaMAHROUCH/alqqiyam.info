@extends('layouts.admin')
@section('content')
@can('directorate_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <!-- <a class="btn btn-success" href="{{ route('admin.directorates.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.directorate.title_singular') }}
            </a> -->
            <button class="btn  btn-success" type="button"  data-toggle="modal" data-target="#createModal1">{{ trans('global.add') }} {{ trans('cruds.directorate.title_singular') }}</button>
        </div>
    </div>
@endcan 
<div class="card">
    <div class="card-header">
        {{ trans('cruds.directorate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Directorate">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.directorate.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.directorate.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($directorates as $key => $directorate)
                        <tr data-entry-id="{{ $directorate->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $directorate->id ?? '' }}
                            </td>
                            <td>
                                {{ $directorate->title ?? '' }}
                            </td>
                            <td>
                                @can('directorate_show')
                                   <!--  <a class="btn btn-xs btn-primary" href="{{ route('admin.directorates.show', $directorate->id) }}">
                                        {{ trans('global.view') }}
                                    </a> -->
                                     <button class="btn btn-xs btn-primary" href="{{ route('admin.directorates.show', $directorate->id) }}" type="button"  data-toggle="modal" data-target="#showModal{{$directorate->id}}">{{ trans('global.view') }}</button>
                                @endcan

                                @can('directorate_edit')
                                    <button class="btn btn-xs btn-info" type="button"  data-toggle="modal" data-target="#editModal{{$directorate->id}}">{{ trans('global.edit') }}</button>
                                @endcan

                                @can('directorate_delete')
                                    <form action="{{ route('admin.directorates.destroy', $directorate->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@foreach($directorates as $key => $directorate)
<!-- Edit  -->
<div id="editModal{{$directorate->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.edit') }} {{ trans('cruds.directorate.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
        <form method="POST" action="{{ route("admin.directorates.update", [$directorate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.directorate.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $directorate->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.directorate.fields.title_helper') }}</span>
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
<div id="showModal{{$directorate->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.view') }} {{ trans('cruds.directorate.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
         <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.directorate.fields.id') }}
                        </th>
                        <td>
                            {{ $directorate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.directorate.fields.title') }}
                        </th>
                        <td>
                            {{ $directorate->title }}
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
          <form method="POST" action="{{ route("admin.directorates.store") }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label class="required" for="title">{{ trans('cruds.directorate.fields.title') }}</label>
                  <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                  @if($errors->has('title'))
                      <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.directorate.fields.title_helper') }}</span>
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
@can('directorate_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.directorates.massDestroy') }}",
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
  let table = $('.datatable-Directorate:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection