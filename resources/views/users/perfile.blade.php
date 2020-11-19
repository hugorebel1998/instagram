@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="col-md-4 data ">
                    @if ($user->image)
                        <div class="perfile-user pb-2">
                            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                                class="img-fluid mx-auto d-block rounded-circle" width="250">
                        </div>
                    @endif
                </div>
                <div class="info-user">
                    <h2 class="pt-5"> {{'@' . $user->nick }}</h2>
                    <h3>{{ $user->name . ' ' . $user->surname }}</h3>
                    <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>

                </div>

                <div class="clearfix"></div>
                <hr>
                @foreach ($user->images as $image)
                    @include('includes.image', ['image'=> $image])

                @endforeach

            </div>

        </div>

    </div>

@endsection
