@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.nationalPartner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.national-partners.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nom">{{ trans('cruds.nationalPartner.fields.nom') }}</label>
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" type="text" name="nom" id="nom" value="{{ old('nom', '') }}" required>
                @if($errors->has('nom'))
                    <span class="text-danger">{{ $errors->first('nom') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.nom_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.nationalPartner.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.nationalPartner.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="responsable">{{ trans('cruds.nationalPartner.fields.responsable') }}</label>
                <input class="form-control {{ $errors->has('responsable') ? 'is-invalid' : '' }}" type="text" name="responsable" id="responsable" value="{{ old('responsable', '') }}" required>
                @if($errors->has('responsable'))
                    <span class="text-danger">{{ $errors->first('responsable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.responsable_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.nationalPartner.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tel">{{ trans('cruds.nationalPartner.fields.tel') }}</label>
                <input class="form-control {{ $errors->has('tel') ? 'is-invalid' : '' }}" type="text" name="tel" id="tel" value="{{ old('tel', '') }}">
                @if($errors->has('tel'))
                    <span class="text-danger">{{ $errors->first('tel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.nationalPartner.fields.tel_helper') }}</span>
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
$(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/public-news/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $publicNews->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.national-partners.storeMedia') }}',
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
@if(isset($nationalPartner) && $nationalPartner->image)
      var file = {!! json_encode($nationalPartner->image) !!}
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
