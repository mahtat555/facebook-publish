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
                    <td> {{ strlen($post->description) > 100 ? substr($post->description, 0, 100) . "..." : $post->description }} </td>
                    <td> {{ $post->type }} </td>
                    <td class="col-lg-3"> {{ $post->created_at->format("d/m/Y H:i:s") }} </td>
                    <td>
                        <div class="row float-right">
                            @if ($post->created_at > now())

                                {{-- Share the post Now --}}
                                <form action="{{ route("publish.share", $post->id) }}" method="POST">
                                    @csrf
                                    <input class="btn btn-primary btn-sm" type="submit" value="Share Now">
                                </form>

                                {{-- Edit the post --}}
                            @else
                                {{-- View the post --}}
                                <a class="btn btn-primary btn-sm" href="{{ route("publish.show", $post->id) }}"> View </a>
                            @endif

                            {{-- Remove the Post --}}
                            <form action="{{ route("publish.delete", $post->id) }}" method="POST" class="col-lg-3">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                            </form>
                        </div>
                    </td>
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
        /***********************************************
        *********** Display Image or Video   ***********
        ***********************************************/
        let image = document.getElementById("add_image");
        let video = document.getElementById("add_video");
        let img = document.getElementById("show_image");
        let vid = document.getElementById("show_video");

        // To display the image selected by the user
        image.addEventListener("change", function(event) {
            img.style.display = "inline";
            vid.style.display = "none";
            video.value = null;
            img.src = URL.createObjectURL(event.target.files[0]);
        })

        // To display the video selected by the user
        video.addEventListener("change", function(event) {
            vid.style.display = "inline";
            img.style.display = "none";
            image.value = null;
            vid.src = URL.createObjectURL(event.target.files[0]);
        })

        /**
        * Publish Now by Delete schedule posts
        */
        function publishNow(event){
            document.getElementById("schedule").value =  null;
        }

        /**
        * Edit Data with Bootstrap Modal Window
        */
        //  Change Form Action
        function changeFormAction(event, action){
            event.target.action =  action;
        }
    </script>
@endsection
