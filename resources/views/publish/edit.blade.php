<form id="publish_form_id" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal" id="edit_post">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    {{-- Modal Title --}}
                    <h4 class="modal-title">
                        Edit Post
                    </h4>

                    {{-- For closing--}}
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true"> x </button>
                </div>

                {{-- Modal Body --}}
                <div class="modal-body">

                    {{-- Post Description --}}
                    <div class="form-group">
                        <label for="description" >{{ __('Post Description') }}</label>
                        <textarea id="edit_description_id" class="form-control" name="description"> </textarea>
                    </div>

                    {{-- Add Image or Video --}}
                    <div class="form-group">
                        <label> {{ __('Add Image or Video') }} </label>
                        <div class="border border-5 text-center">

                            {{-- Add Image --}}
                            <label for="edit_add_image">
                                <svg style="margin:10px" class="bi me-2" width="30" height="30"><use xlink:href="#image"/></svg>
                            </label>
                            <input accept="image/*" id="edit_add_image" style="display:none" type="file" name="image">
                            </a>

                            {{-- Add Video --}}
                            <label for="edit_add_video">
                                <svg class="bi me-2" width="30" height="30"><use xlink:href="#video"/></svg>
                            </label>
                            <input accept="video/*" id="edit_add_video" style="display:none" type="file" name="video">
                            </a>

                            <div>
                                {{--  To display the image selected by the user --}}
                                <img  width="500" height="400" id="edit_show_image" style="display:none">

                                {{-- To display the video selected by the user --}}
                                <video id="edit_show_video" style="display:none" width="500" height="400" controls>
                                    <source type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>

                    {{-- Select Page to Post To --}}
                    <div class="form-group">
                        <label for="description" >{{ __('Select Page to Post To') }}</label>

                        <select id="edit_page_id" title="select page" class="form-control selectpicker" name="page_id">
                            @foreach (Auth::user()->pages as $page)
                                <option value="{{ $page->id }}"> Page {{ $page->id }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer">
                    <button type="submit" onclick="publishNow()" class="btn btn-primary"> Publish Now </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit_schedule"> Schedule </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                </div>
        </div>
        </div>
    </div>


    <!-- Schedule Section -->
    <div class="modal" id="edit_schedule" data-backdrop="static">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <!-- Schedule Title -->
            <h4 class="modal-title">
                Edit Schedule Post
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div><div class="container"></div>

                <div class="modal-body">
                    <input class="form-control" type="datetime-local" id="edit_schedule" name="schedule"
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
    let edit_image = document.getElementById("edit_add_image");
    let edit_video = document.getElementById("edit_add_video");
    let edit_img = document.getElementById("edit_show_image");
    let edit_vid = document.getElementById("edit_show_video");

    // To display the image selected by the user
    edit_image.addEventListener("change", function(event) {
        edit_img.style.display = "inline";
        edit_vid.style.display = "none";
        edit_video.value = null;
        edit_img.src = URL.createObjectURL(event.target.files[0]);
    })

    // To display the video selected by the user
    edit_video.addEventListener("change", function(event) {
        edit_vid.style.display = "inline";
        edit_img.style.display = "none";
        edit_image.value = null;
        edit_vid.src = URL.createObjectURL(event.target.files[0]);
    })

    /**
    * Publish Now by Delete schedule posts
    */
    function publishNow(event){
        document.getElementById("edit_schedule").value =  null;
    }

    /**
    * Edit Data with Bootstrap Modal Window
    */
    function editDataModal(event, action){
        //  Change Form Action
        document.getElementById("publish_form_id").action = action;

        // Get Post description
        let description = event.target.dataset.description;
        document.getElementById("edit_description_id").value = description;

        // Get Post Media
        let media = event.target.dataset.media;
        let media_type = event.target.dataset.media_type;
        if (media_type === "Image") {
            edit_img.src = "{{ route('home') }}/storage/images/" + media;
            edit_img.style.display = "inline";
        } else if(media_type === "Video") {
            edit_vid.src = "{{ route('home') }}/storage/videos/" + media;
            edit_vid.style.display = "inline";
        }

        console.log("{{ route('home') }}/storage/images/" + media);

        // Get Post Page_id
        value = event.target.dataset.page_id;
        document.getElementById("edit_page_id").value = value;
    }
</script>
