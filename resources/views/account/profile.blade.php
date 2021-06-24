@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-white">
        <div class="row">
            {{-- User avatar --}}
            <div class="col-md-3 col-sm-3">
                <img style="width:100%" src="/storage/avatars/{{ Auth::user()->avatar }}" class="rounded-circle">
            </div>

            {{-- User information --}}
            <div class="col-md-4 col-sm-4">
                {{-- User Name --}}
                <h1 class="media-heading"> {{ Auth::user()->name }} </h1>
                {{-- User Email --}}
                <h5 class="text-secondary">
                    <svg style="margin-right: 5px" class="bi me-2" width="16" height="16" fill="currentColor"><use xlink:href="#person"/></svg>
                    {{ Auth::user()->email }}
                </h5>
                {{-- Member Since --}}
                <hr>
                <h5 class="text-secondary">
                    <svg style="margin-right: 5px" class="bi me-2" width="16" height="16" fill="currentColor"><use xlink:href="#date"/></svg>
                    Member Since {{ Auth::user()->created_at->format('j F, Y') }}
                </h5>
            </div>

            {{-- Edit profile --}}
            <div class="col-md-5 col-sm-5 text-right">
                <a class="btn btn-primary" href="#">
                    <svg style="margin-right: 5px" class="bi me-2" width="16" height="16" fill="currentColor"><use xlink:href="#edit"/></svg>
                    {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
@endsection
