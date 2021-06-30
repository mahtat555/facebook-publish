@extends('layouts.app')

@section('content')
<div class="jumbotron bg-white">
    <h1> Connect </h1>

    <!-- Connect Facebook -->
    <hr>
    @if(auth()->user()->id_fb)
        <a class="btn btn-primary btn-lg active" href="{{ route("connect.search") }}">
            Connect Facebook
        </a>
    @else
        <a class="btn btn-primary btn-lg active" href="{{ route("login.facebook") }}">
            Connect Facebook
        </a>
    @endif

    <!-- List of Posts -->
    <hr>
    <table class="table table-striped">
        <tr>
            <th> Page Name </th>
            <th> Added On </th>
            <th></th>
        </tr>
        @foreach ($pages as $page)
        <tr>
            <td> Page {{ $page->id }} </td>
            <td class="col-lg-3"> {{ $page->created_at->format("F j, Y H:i:s") }} </td>
            <td>
                <div class="row float-right">
                    <form action="{{ route("connect.reconnect", $page->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input class="btn btn-primary btn-sm" type="submit" value="Reconnect">
                    </form>
                    <form action="{{ route("connect.delete", $page->id) }}" method="POST" class="col-lg-3">
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

{{ $pages->links("pagination::bootstrap-4") }}

@endsection
