@extends("layouts.app")

@section('content')
<div class="bg-light p-5 rounded bg-white">
    <div class="col-sm-8 mx-auto">
        {{-- Go to Blog page --}}
        <a class="btn btn-secondary" href="{{ route("publish.index") }}">
            <i class="fa fa-chevron-left fa-1x" aria-hidden="true"></i> Go Back
        </a>
        <hr>

        {{-- Display Media --}}
        @if ($post->type !== "Status")
            @if ($post->type === "Image")
                <img style="width:100%" src="/storage/images/{{ $post->media }}" />
            @else
                <video width="500" height="400" controls>
                    <source src="/storage/videos/{{ $post->media }}" type="video/mp4">
                </video>
            @endif
        @endif
        <hr>

        {{-- Post Description --}}
        @if ($post->description !== 'null')
            <p class="blockquote"> {!! $post->description !!} </p>
            <hr>
        @endif

        <small> Share on {{ $post->created_at }} </small>

        {{-- Remove the Post --}}
        <form action="{{ route("publish.delete", $post->id) }}" method="POST" class="float-right">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Delete">
        </form>
    </div>
</div>
@endsection
