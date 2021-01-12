@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publicNews.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.id') }}
                        </th>
                        <td>
                            {{ $publicNews->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.title') }}
                        </th>
                        <td>
                            {{ $publicNews->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.published_at') }}
                        </th>
                        <td>
                            {{ $publicNews->published_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.content') }}
                        </th>
                        <td>
                            {!! $publicNews->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.image') }}
                        </th>
                        <td>
                            @foreach($publicNews->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publicNews.fields.video') }}
                        </th>
                        <td>
                            {{ $publicNews->video }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.public-news.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection