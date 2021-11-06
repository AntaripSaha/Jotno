<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Reply Messege</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form class="ajax-form" method="post" action="{{ route('messege.reply', $messege->id) }}">
        @csrf

        <div class="row">

            <!-- subject -->
            <div class="col-md-12 col-12 form-group">
                <label for="subject">Subject</label> : {{ $messege->subject }}
            </div>

            <!-- message -->
            <div class="col-md-12 col-12 form-group">
                <label for="message">Messege</label> : {{ $messege->message }}
            </div>

            <!-- email -->
            <div class="col-md-12 col-12 form-group">
                <label for="email">Email</label> : {{ $messege->email }}
            </div>

            <!-- reply -->
            @if($messege->reply==null)
            <div class="col-md-12 col-12 form-group">
                <label for="reply">Reply Messege</label>
                <textarea class="form-control" name="reply" placeholder="Type Your Reply Messege Here..."></textarea>
            </div>
            @endif

            <!-- reply -->
            @if($messege->reply !==null)
            <div class="col-md-12 col-12 form-group">
                <label for="reply">Reply Messege</label> : {{ $messege->reply }}
            </div>
            @endif

            @if($messege->reply ==null)
            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Send Messege
                </button>
            </div>
            @endif

        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>


