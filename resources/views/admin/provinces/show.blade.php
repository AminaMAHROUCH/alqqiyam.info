@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.province.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
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
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection