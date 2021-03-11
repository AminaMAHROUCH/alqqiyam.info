@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.nationalPartner.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.national-partners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.id') }}
                        </th>
                        <td>
                            {{ $nationalPartner->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.nom') }}
                        </th>
                        <td>
                            {{ $nationalPartner->nom }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.image') }}
                        </th>
                        <td>
                            @if($nationalPartner->image)
                                <a href="{{ $nationalPartner->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $nationalPartner->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.description') }}
                        </th>
                        <td>
                            {!! $nationalPartner->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.responsable') }}
                        </th>
                        <td>
                            {{ $nationalPartner->responsable }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.email') }}
                        </th>
                        <td>
                            {{ $nationalPartner->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.nationalPartner.fields.tel') }}
                        </th>
                        <td>
                            {{ $nationalPartner->tel }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.national-partners.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection