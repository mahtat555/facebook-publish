<form action={{ route("connect.select") }} method="POST" enctype="multipart/form-data">
    @csrf

    <div class="modal" id="connect_facebook">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    {{-- Modal Title --}}
                    <h4 class="modal-title">
                    Select Facebook Pages
                    </h4>

                    {{-- For closing--}}
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true"> x </button>
                </div>

                {{-- Modal Body --}}
                <div style="padding:10px" class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <!-- Search and Select some  Facebook Pages -->
                        <button class="btn btn-primary btn-lg active" type="button">
                            <svg class="bi me-2" style="fill: white" width="16" height="16"><use xlink:href="#search"/></svg>
                        </button>
                    </div>
                </div>

                @for ($i = 0; $i < 6; $i++)
                    <div style="padding-left:10px" class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="form-control">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="pages[]" value="id_{{ $i }}" type="checkbox" id="{{ "fb_page_" . $i }}">
                                    <label style="margin-left:10px" class="form-check-label" for="{{ "fb_page_" . $i }}"> Facebook Page {{ $i }} </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

                {{-- Modal Footer --}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Save </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                </div>
            </div>
        </div>
    </div>
</form>
