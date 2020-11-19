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
                        {{ __('Editar imagen') }}
                    </div>

                    <div class="card-body mt-5">
                        <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <div class="form-group row">
                                <label for="image_path" class="col-md-4 col-form-label text-md-right"></label>
                                <div class="col-md-6">
                                    <div class="text-center avatar pb-4">
                                        @if (Auth::user()->image)
                                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                                 class="img-fluid mx-auto d-block" width="200">
                                        @endif
                                    </div>
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
                                    <textarea class="form-control" id="description" name="description">
                                    {{ $image->description }} </textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-6 offset-md-4 mt-4">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-save"></i>
                                        {{ __('Actualizar') }}
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
