@extends('layouts.app')

@section('content')
    <div class="container">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                @foreach ($images as $image)
                    @include('includes.image', ['image'=> $image])
                @endforeach
                <div class="clearfix mt-4"></div>
                {{-- Paginacion --}}
                {{ $images->links() }}
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
                    $(this).attr('src', 'img/heart-red.png');
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
                    $(this).attr('src', 'img/heart.png');
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
