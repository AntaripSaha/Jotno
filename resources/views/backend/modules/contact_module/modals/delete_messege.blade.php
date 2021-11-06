<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $messege->messege_id }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
   
</div>
<div class="modal-body">
    <p class="text-center text-danger">Are You Sure to Delete ??</p>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    <form action="{{ route('messege.delete', $messege->id) }}" class="ajax-form" method="post">
        @csrf
        <button type="submit" class="btn btn-danger" >Yes Delete</button>
    </form>
</div>
