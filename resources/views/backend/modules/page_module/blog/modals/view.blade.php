<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $blog->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered table-sm">
                <tbody>
                    <tr>
                        <td>Image</td>
                        <td>
                            @if( $blog->image )
                            <img src="{{ asset('images/blogs/'.$blog->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/blogs/user.png') }}" width="50px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $blog->title}}</td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td>{{ $blog->id}}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $blog->created_by}}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $blog->description}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>