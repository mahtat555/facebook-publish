@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-white">
        <h1> Connect </h1>

        <!-- Connect Facebook -->
        <hr>
        <button type="button" class="btn btn-primary btn-lg active" data-toggle="modal" data-target="#connect_facebook">
            Connect Facebook
        </button>

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
                    <td class="col-lg-3"> {{ date('F j, Y H:i:s', strtotime($page->created_at)) }} </td>
                    <td>
                        <div class="row float-right">
                            <form action="{{ route("connect.update", $page->id) }}" method="POST">
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

    <!-- Modal : Connect Facebook -->
    @extends("connect.connect")

    <!-- JavaScript -->
    <script>
        //
    </script>
@endsection
