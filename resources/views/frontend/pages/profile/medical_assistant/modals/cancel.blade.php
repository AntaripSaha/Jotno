<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ $appoinment->appoinment_no }}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

@if( $appoinment->status == "Pending" )
<div class="modal-body">

    <form method="post" action="{{ route('medical.assistant.appoinment.cancel',$appoinment->id) }}">
        @csrf
        <div class="row">

            <div class="col-md-12">
                <p>
                If you need to cancel your appointment, please call us at [Business Phone] between the hours of [Business Hours]. If necessary, you may leave a detailed voicemail message. We will return your call as soon as possible.
                </p>
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Cancel Appoinment
                </button>
            </div>

        </div>
    </form>

</div>
@else
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 alert alert-warning">
            <p>You Cann't cancel appoinment when status is complete/confirm. <strong>Talk to the administrator</strong> </p>
        </div>
    </div>
</div>
@endif
<div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>


