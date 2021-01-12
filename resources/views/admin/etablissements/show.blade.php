@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.etablissement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.etablissements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.id') }}
                        </th>
                        <td>
                            {{ $etablissement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.name_complet') }}
                        </th>
                        <td>
                            {{ $etablissement->name_complet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.tel_1') }}
                        </th>
                        <td>
                            {{ $etablissement->tel_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.tel_2') }}
                        </th>
                        <td>
                            {{ $etablissement->tel_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.email_professionel') }}
                        </th>
                        <td>
                            {{ $etablissement->email_professionel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.email_personnel') }}
                        </th>
                        <td>
                            {{ $etablissement->email_personnel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.image') }}
                        </th>
                        <td>
                            @if($etablissement->image)
                                <a href="{{ $etablissement->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $etablissement->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.direction') }}
                        </th>
                        <td>
                            {{ $etablissement->direction->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.unite') }}
                        </th>
                        <td>
                            {{ $etablissement->unite->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.etablissement.fields.profession') }}
                        </th>
                        <td>
                            {{ $etablissement->profession->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.etablissements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection