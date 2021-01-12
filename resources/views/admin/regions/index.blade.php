@extends('layouts.admin')
@section('content')
@can('region_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class="btn  btn-success" type="button"  data-toggle="modal" data-target="#createModal1">{{ trans('global.add') }} {{ trans('cruds.region.title_singular') }}</button>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.region.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Region">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.region.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.region.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $key => $region)
                        <tr data-entry-id="{{ $region->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $region->id ?? '' }}
                            </td>
                            <td>
                                {{ $region->name ?? '' }}
                            </td>
                            <td>
                                @can('region_show')
                                    <button class="btn btn-xs btn-primary" href="{{ route('admin.regions.show', $region->id) }}" type="button"  data-toggle="modal" data-target="#showModal{{$region->id}}">{{ trans('global.view') }}</button>
                                @endcan

                                @can('region_edit')
                                    <button class="btn btn-xs btn-info" type="button"  data-toggle="modal" data-target="#editModal{{$region->id}}">{{ trans('global.edit') }}</button>
                                @endcan

                                @can('region_delete')
                                    <form action="{{ route('admin.regions.destroy', $region->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@foreach($regions as $key => $region)
<!-- Edit  -->
<div id="editModal{{$region->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.edit') }} {{ trans('cruds.directorate.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
            <form method="POST" action="{{ route("admin.regions.update", [$region->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="form-group">
                  <label class="required" for="name">{{ trans('cruds.region.fields.name') }}</label>
                  <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $region->name) }}" required>
                  @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.region.fields.name_helper') }}</span>
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
<div id="showModal{{$region->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.view') }} {{ trans('cruds.region.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.id') }}
                        </th>
                        <td>
                            {{ $region->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.region.fields.name') }}
                        </th>
                        <td>
                            {{ $region->name }}
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
           <form method="POST" action="{{ route("admin.regions.store") }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label class="required" for="name">{{ trans('cruds.region.fields.name') }}</label>
                  <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                  @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.region.fields.name_helper') }}</span>
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
@can('region_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.regions.massDestroy') }}",
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
  let table = $('.datatable-Region:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection