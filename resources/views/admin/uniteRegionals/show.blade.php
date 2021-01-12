@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.uniteRegional.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.unite-regionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.id') }}
                        </th>
                        <td>
                            {{ $uniteRegional->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.name_complet') }}
                        </th>
                        <td>
                            {{ $uniteRegional->name_complet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.tel_1') }}
                        </th>
                        <td>
                            {{ $uniteRegional->tel_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.tel_2') }}
                        </th>
                        <td>
                            {{ $uniteRegional->tel_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.email_profesionel') }}
                        </th>
                        <td>
                            {{ $uniteRegional->email_profesionel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.email_personnel') }}
                        </th>
                        <td>
                            {{ $uniteRegional->email_personnel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.image') }}
                        </th>
                        <td>
                            @if($uniteRegional->image)
                                <a href="{{ $uniteRegional->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $uniteRegional->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.region') }}
                        </th>
                        <td>
                            {{ $uniteRegional->region->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.province') }}
                        </th>
                        <td>
                            {{ $uniteRegional->province->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uniteRegional.fields.profession') }}
                        </th>
                        <td>
                            {{ $uniteRegional->profession }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.unite-regionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection