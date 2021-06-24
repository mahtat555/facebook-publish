@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center bg-white">
        <h1> Simple tool for publishing on Facebook pages </h1>
        <hr>

        <p class="blockquote text-secondary">
            Please login if you have an account If you don't have one, create one,
            and start posting to Facebook pages.
        </p>

        <p>
            <a class="btn btn-primary btn-lg" role="button" href="{{ route('login') }}"> Login </a>
            <a class="btn btn-success btn-lg" role="button" href="{{ route('register') }}"> Register </a>
        </p>
    </div>
@endsection
