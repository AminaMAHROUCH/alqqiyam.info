@extends('layouts.admin')
@section('content')
@can('province_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <button class="btn  btn-success" type="button"  data-toggle="modal" data-target="#createModal1">{{ trans('global.add') }} {{ trans('cruds.province.title_singular') }}</button>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.province.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Province">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.province.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.province.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.province.fields.region') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($provinces as $key => $province)
                        <tr data-entry-id="{{ $province->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $province->id ?? '' }}
                            </td>
                            <td>
                                {{ $province->name ?? '' }}
                            </td>
                            <td>
                                {{ $province->region->name ?? '' }}
                            </td>
                            <td>
                                @can('province_show')
                                    <button class="btn btn-xs btn-primary" ref="{{ route('admin.provinces.show', $province->id) }}" type="button"  data-toggle="modal" data-target="#showModal{{$province->id}}">{{ trans('global.view') }}</button>
                                @endcan

                                @can('province_edit')
                                     <button class="btn btn-xs btn-info" type="button"  data-toggle="modal" data-target="#editModal{{$province->id}}">{{ trans('global.edit') }}</button>
                                @endcan

                                @can('province_delete')
                                    <form action="{{ route('admin.provinces.destroy', $province->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@foreach($provinces as $key => $province)
<!-- Edit  -->
<div id="editModal{{$province->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.edit') }} {{ trans('cruds.province.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
          <form method="POST" action="{{ route("admin.provinces.update", [$province->id]) }}" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <div class="form-group">
                  <label class="required" for="name">{{ trans('cruds.province.fields.name') }}</label>
                  <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $province->name) }}" required>
                  @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.province.fields.name_helper') }}</span>
              </div>
              <div class="form-group">
                  <label class="required" for="region_id">{{ trans('cruds.province.fields.region') }}</label>
                  <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id" required>
                      @foreach($regions as $id => $region)
                          <option value="{{ $id }}" {{ (old('region_id') ? old('region_id') : $province->region->id ?? '') == $id ? 'selected' : '' }}>{{ $region }}</option>
                      @endforeach
                  </select>
                  @if($errors->has('region'))
                      <span class="text-danger">{{ $errors->first('region') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.province.fields.region_helper') }}</span>
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
<div id="showModal{{$province->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title"> {{ trans('global.view') }} {{ trans('cruds.province.title_singular') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
          <div class="card-body">
           <table class="table table-bordered table-striped">
                  <tbody>
                      <tr>
                          <th>
                              {{ trans('cruds.province.fields.id') }}
                          </th>
                          <td>
                              {{ $province->id }}
                          </td>
                      </tr>
                      <tr>
                          <th>
                              {{ trans('cruds.province.fields.name') }}
                          </th>
                          <td>
                              {{ $province->name }}
                          </td>
                      </tr>
                      <tr>
                          <th>
                              {{ trans('cruds.province.fields.region') }}
                          </th>
                          <td>
                              {{ $province->region->name ?? '' }}
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
           <h4 class="modal-title">{{ trans('global.add') }} {{ trans('cruds.province.title_singular') }} </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="card-body">
           <form method="POST" action="{{ route("admin.provinces.store") }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label class="required" for="name">{{ trans('cruds.province.fields.name') }}</label>
                  <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                  @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.province.fields.name_helper') }}</span>
              </div>
              <div class="form-group">
                  <label class="required" for="region_id">{{ trans('cruds.province.fields.region') }}</label>
                  <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id" required>
                      @foreach($regions as $id => $region)
                          <option value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>{{ $region }}</option>
                      @endforeach
                  </select>
                  @if($errors->has('region'))
                      <span class="text-danger">{{ $errors->first('region') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.province.fields.region_helper') }}</span>
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
@can('province_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.provinces.massDestroy') }}",
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
  let table = $('.datatable-Province:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection