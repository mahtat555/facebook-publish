@extends('connect.search')

@section('select_pages')
<form action={{ route("connect.select") }} method="POST" enctype="multipart/form-data">
    @csrf

    @foreach ($pages as $page)
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="form-control">
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="pages[{{ $page["id"] }}]" value="{{ $page["name"] }}" type="checkbox" id="{{ $page["id"] }}">
                        <label class="form-check-label" for="{{ $page["id"] }}"> {{ $page["name"] }} </label>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"> Save </button>
    </div>
</form>
@endsection
