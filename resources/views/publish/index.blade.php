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
    </div>

    {{ $posts->links("pagination::bootstrap-4") }}

    <!-- Create Post Modal -->
    @include("publish.create")

    <!-- Edit Post Modal -->
    @include("publish.edit")

    <!-- JavaScript -->
    <script>
        // To display the image selected by the user
        let image = document.getElementById("add_image");

        image.addEventListener("change", function(event) {
            let img = document.getElementById("show_image");
            img.style.display = "inline";
            img.src = URL.createObjectURL(event.target.files[0]);
        })

        // To display the video selected by the user
        let video = document.getElementById("add_video");

        video.addEventListener("change", function(event) {
            let vid = document.getElementById("show_video");
            vid.style.display = "inline";
            vid.src = URL.createObjectURL(event.target.files[0]);
        })

        alert("Hello");
        document.getElementById("form_id").action = {{ route("publish.edit", 1) }};
    </script>
@endsection
