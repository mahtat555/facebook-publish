@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-white">
        <h1> Publish </h1>

        <!-- Create Post -->
        <hr>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_post"s>
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
                    <td class="col-lg-2"> {{ $post->created_at->format("d/m/Y H:i:s") }} </td>
                    <td class="col-lg-3">
                        <div class="row float-right">
                            @if ($post->created_at > now())

                                {{-- Share the post Now --}}
                                <form action="{{ route("publish.share", $post->id) }}" method="POST">
                                    @csrf
                                    <input class="btn btn-outline-success btn-sm" type="submit" value="Share Now">
                                </form>

                                {{-- Edit the post --}}
                                <button id="edit_button_id" style="margin-left:10px" type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#edit_post" onclick='editDataModal(event, "{{ route("publish.edit", $post->id) }}")'
                                    data-description="{{ $post->description }}" data-page_id="{{ $post->page_id }}" data-media_type="{{ $post->type }}"
                                    data-media="{{ $post->media }}" data-schedule="{{ $post->created_at }}">
                                    Edit
                                </button>
                            @else
                                {{-- View the post --}}
                                <a class="btn btn-outline-primary btn-sm" href="{{ route("publish.show", $post->id) }}"> View </a>
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
        // ....
    </script>
@endsection
