@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.uniteRegional.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.unite-regionals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_complet">{{ trans('cruds.uniteRegional.fields.name_complet') }}</label>
                <input class="form-control {{ $errors->has('name_complet') ? 'is-invalid' : '' }}" type="text" name="name_complet" id="name_complet" value="{{ old('name_complet', '') }}" required>
                @if($errors->has('name_complet'))
                    <span class="text-danger">{{ $errors->first('name_complet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.name_complet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tel_1">{{ trans('cruds.uniteRegional.fields.tel_1') }}</label>
                <input class="form-control {{ $errors->has('tel_1') ? 'is-invalid' : '' }}" type="text" name="tel_1" id="tel_1" value="{{ old('tel_1', '') }}" required>
                @if($errors->has('tel_1'))
                    <span class="text-danger">{{ $errors->first('tel_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.tel_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tel_2">{{ trans('cruds.uniteRegional.fields.tel_2') }}</label>
                <input class="form-control {{ $errors->has('tel_2') ? 'is-invalid' : '' }}" type="text" name="tel_2" id="tel_2" value="{{ old('tel_2', '') }}">
                @if($errors->has('tel_2'))
                    <span class="text-danger">{{ $errors->first('tel_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.tel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fix">{{ trans('cruds.uniteRegional.fields.fix') }}</label>
                <input class="form-control {{ $errors->has('fix') ? 'is-invalid' : '' }}" type="text" name="fix" id="fix" value="{{ old('fix', '') }}">
                @if($errors->has('fix'))
                    <span class="text-danger">{{ $errors->first('fix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.tel_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_profesionel">{{ trans('cruds.uniteRegional.fields.email_profesionel') }}</label>
                <input class="form-control {{ $errors->has('email_profesionel') ? 'is-invalid' : '' }}" type="email" name="email_profesionel" id="email_profesionel" value="{{ old('email_profesionel') }}" required>
                @if($errors->has('email_profesionel'))
                    <span class="text-danger">{{ $errors->first('email_profesionel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.email_profesionel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_personnel">{{ trans('cruds.uniteRegional.fields.email_personnel') }}</label>
                <input class="form-control {{ $errors->has('email_personnel') ? 'is-invalid' : '' }}" type="email" name="email_personnel" id="email_personnel" value="{{ old('email_personnel') }}">
                @if($errors->has('email_personnel'))
                    <span class="text-danger">{{ $errors->first('email_personnel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.email_personnel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.uniteRegional.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.uniteRegional.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="region_id">{{ trans('cruds.uniteRegional.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id">
                    @foreach($regions as $id => $region)
                        <option value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <span class="text-danger">{{ $errors->first('region') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="province_id">{{ trans('cruds.uniteRegional.fields.province') }}</label>
                <select class="form-control select2 {{ $errors->has('province') ? 'is-invalid' : '' }}" name="province_id" id="province_id">
                    @foreach($provinces as $id => $province)
                        <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $province }}</option>
                    @endforeach
                </select>
                @if($errors->has('province'))
                    <span class="text-danger">{{ $errors->first('province') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.province_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profession">{{ trans('cruds.uniteRegional.fields.profession') }}</label>
                <input class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}" type="text" name="profession" id="profession" value="{{ old('profession', '') }}" required>
                @if($errors->has('profession'))
                    <span class="text-danger">{{ $errors->first('profession') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.uniteRegional.fields.profession_helper') }}</span>
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
    url: '{{ route('admin.unite-regionals.storeMedia') }}',
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
@if(isset($uniteRegional) && $uniteRegional->image)
      var file = {!! json_encode($uniteRegional->image) !!}
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
