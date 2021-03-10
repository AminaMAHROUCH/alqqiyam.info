@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.helpCase.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.help-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.helpCase.fields.id') }}
                        </th>
                        <td>
                            {{ $helpCase->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.helpCase.fields.title') }}
                        </th>
                        <td>
                            {{ $helpCase->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.helpCase.fields.description') }}
                        </th>
                        <td>
                            {!! $helpCase->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.helpCase.fields.image') }}
                        </th>
                        <td>
                            @foreach($helpCase->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.helpCase.fields.video') }}
                        </th>
                        <td>
                            {{ $helpCase->video }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.news.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\News::TYPE_SELECT[$helpCase->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.help-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection