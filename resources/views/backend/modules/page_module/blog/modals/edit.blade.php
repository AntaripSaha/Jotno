<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit blog</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('blog.update', $blog->id) }}">
        @csrf
        <div class="row">

            <!-- Title -->
            <div class="col-md-6 col-12 form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{$blog->title}}">
            </div>

            <!-- Description -->
            <div class="col-md-6 col-12 form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{$blog->description }}</textarea>
            </div>

            <!-- image -->
            <div class="col-md-6 col-12 form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" value="{{$blog->image}}">
            </div>

            <!-- Status -->
            <div class="col-md-12 col-12 form-group">
                <h6>Status</h6>
                <select class="form-control select2" name="is_active">
                    <option value="1" @if($blog->is_active == true) selected @endif>Active</option>
                    <option value="0" @if($blog->is_active == false) selected @endif>Inactive</option>
                </select>
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Update
                </button>
            </div>

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>