@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                <div class="card">
                    <div class="card-header"><i class="fas fa-home"></i> {{ __('Inicio') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Bienvenido') }} <b>Hugo Guillermo</b> {{__('que haremos hoy')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
