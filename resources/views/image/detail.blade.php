@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-9">
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

                    <div class="card-body car-img">
                        <div class="justify-content-center image">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                class="img-fluid mx-auto d-block">
                        </div>

                        <div class="likes pl-4 pt-3">
                              {{-- Comprobar si el usuario le dio like a la publicación--}}
                              <?php $user_like = false; ?>
                              @foreach ($image->likes as $like)
                                  @if ($like->user->id == Auth::user()->id)
                                  <?php $user_like = true; ?>
                                  @endif
                             @endforeach
   
                             @if ($user_like)
                             {{-- <i class="fas fa-heart text-danger btn-dislike" id="like"></i> --}}
                             <img src="{{ asset('img/heart-red.png')}}" data-id="{{ $image->id}}" class="img-liks btn-dislike">
                             @else                                  
                             {{-- <i class="fas fa-heart  btn-like text-primary" id="like"></i> --}}
                             <img src="{{ asset('img/heart.png')}}" data-id="{{ $image->id}}" class="img-liks btn-like">
                             @endif
                        </div>
                        <div class="count_likes mt-2">
                            <span class="pl-4 likes">{{ count($image->likes) }} Me gusta</span>
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
                                <div class="col-md-12 pl-4 pr-4">
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                        rows="3"></textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 pl-4 pt-3">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-paper-plane"></i>
                                        Publicar</button>
                                </div>
                                @if (Auth::user() && Auth::user()->id == $image->user->id)
                                    <div class="col-md-6 pt-3 pr-4 pb-4 text-right">
                                        <a href="{{ route('image.edit', ['id'=> $image->id]) }}" class="btn btn-sm btn-success"> <i class="fas fa-edit"></i>
                                            Modificar</a>
                                        {{-- <a href="{{ route('image.delete', ['id'=>$image->id]) }}" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash-alt"></i> Borrar</a> --}}

                                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>Eliminar
                                                </a>
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Deseas eliminar esta imagen</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ route('image.delete', ['id'=>$image->id]) }}"
                                                            class="btn btn-sm btn-danger">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                @endif
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

                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger mb-5">
                                            <i class="fas fa-trash-alt text-white"></i> 
                                            Eliminar comentario
                                        </a>
                                    @endif

                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        var url = "http://insta.com.net";
        window.addEventListener("load", function() {
            $('.btn-like').css('cursor', 'pointer');
            $('.btn-dislike').css('cursor', 'pointer');

            // Boton de like
            function like() {
                $('.btn-like').unbind('click').click(function() {
                    console.log('like');
                    $(this).addClass('btn-dislike').removeClass('btn-like');
                    $(this).attr('src', url + '/img/heart-red.png');
                    $.ajax({
                        url: url + '/like/' + $(this).data('id'),
                        type: 'GET',
                        success: function(response) {
                            if (response.like) {
                                console.log("Has dado un like a esta publicación");
                            } else {
                                console.log("Error al dar like ala publicación");
                            }
                        }

                    });

                    dislike();

                });
            }
            like();

            //Boton de dislike
            function dislike() {
                $('.btn-dislike').unbind('click').click(function() {
                    console.log('dislike');
                    $(this).addClass('btn-like').removeClass('btn-dislike');
                    $(this).attr('src', url + '/img/heart.png');
                    $.ajax({
                        url: url + '/dislike/' + $(this).data('id'),
                        type: 'GET',
                        success: function(response) {
                            if (response.like) {
                                console.log("Has dado dislike a esta publicación");
                            } else {
                                console.log("Error al dar dislike ala publicación");
                            }
                        }

                    });

                    like();

                });
            }
            dislike();

        });

    </script>
@endsection
