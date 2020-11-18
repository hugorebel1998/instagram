@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')
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
                                <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="detalle">
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

                        <h2 class="pl-4">
                            Comentarios ({{ count($image->comments) }})
                        </h2>
                        <hr>
                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf
                            <div class="row pl-3">
                                <div class="col-md-6">
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                </div>
                                <div class="col-md-12 pl-4">
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                        rows="3"></textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="from-group mt-4 pl-4">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-paper-plane"></i> Publicar</button>
                                </div>
                            </div>
                        </form>
                        @foreach ($image->comments as $comment)
                            <div class="row">
                                <div class="col-md-12 pl-5">
                                    <hr class="pl-4">
                                    <span class="nick">{{ '@' . $comment->user->nick }}</span>
                                    <span class="fecha">
                                        | {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                                    </span>
                                    <p> {{ $comment->content }}</p>
                                    @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))

                                        {{-- <a
                                            href="{{ route('comment.delete', ['id' => $comment->id]) }}">
                                            Eliminar
                                        </a>
                                        <hr>
                                        <br> --}}
                                        <!-- Button trigger modal -->
                                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                          </a

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Comentario</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>Deseas eliminar este comentario</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
