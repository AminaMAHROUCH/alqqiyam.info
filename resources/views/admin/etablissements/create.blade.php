@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.etablissement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.etablissements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_complet">{{ trans('cruds.etablissement.fields.name_complet') }}</label>
                <input class="form-control {{ $errors->has('name_complet') ? 'is-invalid' : '' }}" type="text" name="name_complet" id="name_complet" value="{{ old('name_complet', '') }}" required>
                @if($errors->has('name_complet'))
                    <span class="text-danger">{{ $errors->first('name_complet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.name_complet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tel_1">{{ trans('cruds.etablissement.fields.tel_1') }}</label>
                <input class="form-control {{ $errors->has('tel_1') ? 'is-invalid' : '' }}" type="text" name="tel_1" id="tel_1" value="{{ old('tel_1', '') }}" required>
                @if($errors->has('tel_1'))
                    <span class="text-danger">{{ $errors->first('tel_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.tel_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tel_2">{{ trans('cruds.etablissement.fields.tel_2') }}</label>
                <input class="form-control {{ $errors->has('tel_2') ? 'is-invalid' : '' }}" type="text" name="tel_2" id="tel_2" value="{{ old('tel_2', '') }}">
                @if($errors->has('tel_2'))
                    <span class="text-danger">{{ $errors->first('tel_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.tel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fix">{{ trans('cruds.etablissement.fields.fix') }}</label>
                <input class="form-control {{ $errors->has('fix') ? 'is-invalid' : '' }}" type="text" name="fix" id="fix" value="{{ old('fix', '') }}">
                @if($errors->has('fix'))
                    <span class="text-danger">{{ $errors->first('fix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.tel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_professionel">{{ trans('cruds.etablissement.fields.email_professionel') }}</label>
                <input class="form-control {{ $errors->has('email_professionel') ? 'is-invalid' : '' }}" type="email" name="email_professionel" id="email_professionel" value="{{ old('email_professionel') }}" required>
                @if($errors->has('email_professionel'))
                    <span class="text-danger">{{ $errors->first('email_professionel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.email_professionel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_personnel">{{ trans('cruds.etablissement.fields.email_personnel') }}</label>
                <input class="form-control {{ $errors->has('email_personnel') ? 'is-invalid' : '' }}" type="email" name="email_personnel" id="email_personnel" value="{{ old('email_personnel') }}">
                @if($errors->has('email_personnel'))
                    <span class="text-danger">{{ $errors->first('email_personnel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.email_personnel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.etablissement.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="direction_id">{{ trans('cruds.etablissement.fields.direction') }}</label>
                <select class="form-control select2 {{ $errors->has('direction') ? 'is-invalid' : '' }}" name="direction_id" id="direction_id">
                    @foreach($directions as $id => $direction)
                        <option value="{{ $id }}" {{ old('direction_id') == $id ? 'selected' : '' }}>{{ $direction }}</option>
                    @endforeach
                </select>
                @if($errors->has('direction'))
                    <span class="text-danger">{{ $errors->first('direction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.direction_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="unite_id">{{ trans('cruds.etablissement.fields.unite') }}</label>
                <select class="form-control select2 {{ $errors->has('unite') ? 'is-invalid' : '' }}" name="unite_id" id="unite_id">
                    @foreach($unites as $id => $unite)
                        <option value="{{ $id }}" {{ old('unite_id') == $id ? 'selected' : '' }}>{{ $unite }}</option>
                    @endforeach
                </select>
                @if($errors->has('unite'))
                    <span class="text-danger">{{ $errors->first('unite') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.unite_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="profession_id">{{ trans('cruds.etablissement.fields.profession') }}</label>
                <select class="form-control select2 {{ $errors->has('profession') ? 'is-invalid' : '' }}" name="profession_id" id="profession_id">
                    @foreach($professions as $id => $profession)
                        <option value="{{ $id }}" {{ old('profession_id') == $id ? 'selected' : '' }}>{{ $profession }}</option>
                    @endforeach
                </select>
                @if($errors->has('profession'))
                    <span class="text-danger">{{ $errors->first('profession') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.etablissement.fields.profession_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.etablissements.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($etablissement) && $etablissement->image)
      var file = {!! json_encode($etablissement->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection