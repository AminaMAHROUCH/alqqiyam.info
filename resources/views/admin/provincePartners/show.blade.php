@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.provincePartner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.province-partners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.id') }}
                        </th>
                        <td>
                            {{ $provincePartner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.nom') }}
                        </th>
                        <td>
                            {{ $provincePartner->nom }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.image') }}
                        </th>
                        <td>
                            @if($provincePartner->image)
                                <a href="{{ $provincePartner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $provincePartner->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.tel_1') }}
                        </th>
                        <td>
                            {{ $provincePartner->tel_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.adresse') }}
                        </th>
                        <td>
                            {{ $provincePartner->adresse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.description') }}
                        </th>
                        <td>
                            {!! $provincePartner->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.responsable') }}
                        </th>
                        <td>
                            {{ $provincePartner->responsable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.email') }}
                        </th>
                        <td>
                            {{ $provincePartner->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.tel_2') }}
                        </th>
                        <td>
                            {{ $provincePartner->tel_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.provincePartner.fields.province') }}
                        </th>
                        <td>
                            {{ $provincePartner->region->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.province-partners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection