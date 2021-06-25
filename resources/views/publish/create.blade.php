<form action="/publish" method="POST" enctype="multipart/form-data">
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
                        <textarea id="description" class="form-control" name="text" value="{{ old('text') }}" required> </textarea>
                    </div>

                    {{-- Add Image or Video --}}
                    <div class="form-group">
                        <label> {{ __('Add Image or Video') }} </label>
                        <div class="border border-5 text-center">

                            {{-- Add Image --}}
                            <label for="add_iamge">
                                <svg style="margin:10px" class="bi me-2" width="30" height="30"><use xlink:href="#image"/></svg>
                            </label>
                            <input id="add_iamge" style="display:none" type="file" name="image">
                            </a>

                            {{-- Add Video --}}
                            <label for="add_video">
                                <svg class="bi me-2" width="30" height="30"><use xlink:href="#video"/></svg>
                            </label>
                            <input id="add_video" style="display:none" type="file" name="video">
                            </a>
                        </div>
                    </div>

                    {{-- Select Page to Post To --}}
                    <div class="form-group">
                        <label for="description" >{{ __('Select Page to Post To') }}</label>

                        <select title="select page" class="form-control selectpicker" name="page">
                            <option> page 1 </option>
                            <option> page 2 </option>
                            <option> page 3 </option>
                            </select>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Publish Now </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#schedule"> Schedule </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                </div>
        </div>
        </div>
    </div>

    <div class="modal" id="schedule" data-backdrop="static">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">2nd Modal title</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div><div class="container"></div>

                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" name="description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Sand </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
