@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.privateNews.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.private-news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.id') }}
                        </th>
                        <td>
                            {{ $privateNews->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.title') }}
                        </th>
                        <td>
                            {{ $privateNews->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.published_at') }}
                        </th>
                        <td>
                            {{ $privateNews->published_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.content') }}
                        </th>
                        <td>
                            {!! $privateNews->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.image') }}
                        </th>
                        <td>
                            @foreach($privateNews->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.privateNews.fields.video') }}
                        </th>
                        <td>
                            {{ $privateNews->video }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.private-news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection