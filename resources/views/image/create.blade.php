@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-info">
                        <i class="fas fa-cloud-upload-alt text-primary"></i>
                        {{ __('Subir imagenes') }}
                    </div>

                    <div class="card-body mt-5">
                        <form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="image_path"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Imagen') }}</label>
                                <div class="col-md-6">
                                    <input id="image_path" type="file"
                                        class="form-control-file @error('image_path') is-invalid @enderror"
                                        name="image_path">
                                </div>
                                 @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>

                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="description" name="description" required></textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-6 offset-md-4 mt-4">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-save"></i>
                                        {{ __('Subir imagen') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>


@endsection
