@extends('layouts.app')

@section('content')
<div class="bg-light p-5 rounded bg-white">
    <div class="col-sm-8 mx-auto">
        <h3 class="modal-title"> Select Facebook Pages </h3>
        <hr>

        <form action={{ route("connect.search") }} method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group mb-3">

                <!-- Search Facebook Pages -->
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2" name="search">
                <div class="input-group-append">
                    <button class="btn btn-primary active" type="submit">
                        <svg class="bi me-2" style="fill: white" width="16" height="16"><use xlink:href="#search"/></svg>
                    </button>
                </div>
            </div>
        </form>

        @yield('select_pages')
    </div>
</div>
@endsection
