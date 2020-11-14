@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                @foreach ($images as $image)
                    <div class="card pu_image mt-5">
                        <div class="card-header">
                            @if ($image->user->image)
                                <div class="container-avatar_mu">
                                    <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}"
                                        class="img-fluid mx-auto d-block">
                                </div>
                            @endif
                            <div class="mt-2">

                                <p>
                                    <a href="{{ route('image.detail', ['id' => $image->id]) }} " class="detalle">
                                        <b>{{ $image->user->name . ' ' . $image->user->surname }}</b> | @
                                        {{ $image->user->nick }}

                                    </a>
                                </p>

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="justify-content-center image">
                                <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                    class="img-fluid mx-auto d-block">
                            </div>

                            <div class="likes pl-4 pt-3">
                                <i class="fas fa-heart text-danger"></i>
                                <i class="fas fa-comment pl-3 pr-3"></i>
                                <i class="fas fa-paper-plane"></i>
                            </div>
                            <div class="desciption pl-4 mt-3 mb-4">
                                <span>{{ '@' . $image->user->nick }}</span>
                                <p class="">{{ $image->description }}</p>
                            </div>

                            <a href="#" class="btn btn-sm btn-warning ml-4 mb-3">
                                Comentarios
                            </a>

                        </div>
                    </div>
                @endforeach
                <div class="clearfix mt-4"></div>
                {{-- Paginacion --}}
                {{ $images->links() }}
            </div>
        </div>
    </div>
@endsection
