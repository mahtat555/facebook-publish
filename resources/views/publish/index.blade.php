@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-white">
        <h1> Publish </h1>

        <!-- Create Post -->
        <hr>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_post"  data-whatever="@mdo">
            Create Post
        </button>

        <!-- List of Posts -->
        <hr>
        <table class="table table-striped">
            <tr>
                <th> Post </th>
                <th> Type </th>
                <th> Date </th>
                <th></th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td> {{ $post->description }} </td>
                <td> {{ $post->type }} </td>
                <td> {{ $post->created_at }} </td>
                <td></td>
            </tr>
            @endforeach
        </table>
        {{ $posts->links("pagination::bootstrap-4") }}

        <!-- Create Post Modal -->
        @include("publish.create")

        <!-- Edit Post Modal -->
        @include("publish.edit")
    </div>
@endsection
