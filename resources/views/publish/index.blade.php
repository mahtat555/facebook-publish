@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-white">
        <h1> Publish </h1>

        <!-- Create Post -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_post"  data-whatever="@mdo">
            Create Post
        </button>

        <!-- List of Posts -->

        <!-- Create Post Modal -->
        @include("publish.create")

        <!-- Edit Post Modal -->
        @include("publish.edit")
    </div>
@endsection
