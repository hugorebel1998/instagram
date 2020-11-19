@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-end">
                    <div class="col-md-5">
                        <form action="{{ route('users.index') }}" method="GET" id="buscador">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @foreach ($users as $user)
                    <div class="col-md-10">
                        <div class="col-md-6 data ">
                            @if ($user->image)
                                <div class="perfile-user pb-2">
                                    <img src="{{ route('user.avatar', ['filename' => $user->image]) }}"
                                        class="img-fluid mx-auto d-block rounded-circle" width="250">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h2 class="pt-5"> {{ '@' . $user->nick }}</h2>
                            <h3>{{ $user->name . ' ' . $user->surname }}</h3>
                            <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>
                        </div>
                    </div>

                @endforeach
                <div class="clearfix"></div>
                {{ $users->links() }}
            </div>

        </div>

    </div>
    {{-- Buscardor --}}
    <script>
        var url = "http://insta.com.net";
        $('#buscador').submit(function(e) {
            $(this).attr('action', url + '/users/index/' + $('#buscador #search').val());
        });

    </script>
@endsection
