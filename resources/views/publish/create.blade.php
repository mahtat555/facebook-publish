<form action="{{ route("publish.create") }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="modal" id="create_post">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    {{-- Modal Title --}}
                    <h4 class="modal-title">
                        Create Post
                    </h4>

                    {{-- For closing--}}
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true"> x </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body">

                    {{-- Post Description --}}
                    <div class="form-group">
                        <label for="description" >{{ __('Post Description') }}</label>
                        <textarea id="description" class="form-control" name="description" value="{{ old('text') }}"> </textarea>
                    </div>

                    {{-- Add Image or Video --}}
                    <div class="form-group">
                        <label> {{ __('Add Image or Video') }} </label>
                        <div class="border border-5 text-center">

                            {{-- Add Image --}}
                            <label for="add_image">
                                <svg style="margin:10px" class="bi me-2" width="30" height="30"><use xlink:href="#image"/></svg>
                            </label>
                            <input accept="image/*" id="add_image" style="display:none" type="file" name="image">
                            </a>

                            {{-- Add Video --}}
                            <label for="add_video">
                                <svg class="bi me-2" width="30" height="30"><use xlink:href="#video"/></svg>
                            </label>
                            <input accept="video/*" id="add_video" style="display:none" type="file" name="video">
                            </a>

                            <div>
                                {{--  To display the image selected by the user --}}
                                <img  width="500" height="400" id="show_image" style="display:none">

                                {{-- To display the video selected by the user --}}
                                <video id="show_video" style="display:none" width="500" height="400" controls>
                                    <source type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>

                    {{-- Select Page to Post To --}}
                    <div class="form-group">
                        <label for="description" >{{ __('Select Page to Post To') }}</label>

                        <select title="select page" class="form-control selectpicker" name="page_id">
                            @foreach (Auth::user()->pages as $page)
                                <option value="{{ $page->id }}"> Page {{ $page->id }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer">
                    <button type="submit" onclick="publishNow()" class="btn btn-primary"> Publish Now </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_schedule"> Schedule </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                </div>
        </div>
        </div>
    </div>


    <!-- Schedule Section -->
    <div class="modal" id="create_schedule" data-backdrop="static">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <!-- Schedule Title -->
            <h4 class="modal-title">
                Schedule Post
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div><div class="container"></div>

                <div class="modal-body">
                    <input class="form-control" type="datetime-local" id="schedule" name="schedule"
                        value="{{ now() }}" min="{{ now() }}">
                </div>

                {{-- Schedule Footer --}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Schedule </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                </div>
            </div>
        </div>
    </div>
</form>

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
</script>
