@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.update", [$unit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.unit.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $unit->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="direction_id">{{ trans('cruds.unit.fields.direction') }}</label>
                <select class="form-control select2 {{ $errors->has('direction') ? 'is-invalid' : '' }}" name="direction_id" id="direction_id">
                    @foreach($directions as $id => $direction)
                        <option value="{{ $id }}" {{ (old('direction_id') ? old('direction_id') : $unit->direction->id ?? '') == $id ? 'selected' : '' }}>{{ $direction }}</option>
                    @endforeach
                </select>
                @if($errors->has('direction'))
                    <span class="text-danger">{{ $errors->first('direction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.direction_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection