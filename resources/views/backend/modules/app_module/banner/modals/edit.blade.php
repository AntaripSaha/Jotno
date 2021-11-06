<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('banner.update', $banner->id) }}">
        @csrf

        <div class="row">
            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $banner->title }}">
            </div>

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                <label for="position">Position</label>
                <input type="number" class="form-control" name="position" value="{{ $banner->position }}">
            </div>

            <!-- name -->
            <div class="col-md-12 col-12 form-group">
                @if( $banner->image )
                    <img src="{{ asset('images/banners/'.$banner->image) }}" width="200px;heigh:10px;" alt="">
                @endif
                <label for="name">Image</label>
                <input type="file" class="form-control" name="image" value="{{ $banner->image }}">
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


