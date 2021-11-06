<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Appoinment Initial Test</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('medical.assistant.appoinment.initial.test.delete',$appoinment_initial_test->id) }}">
        @csrf
        <div class="row">

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Delete
                </button>
            </div>

        </div>
    </form>

</div>
<div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>





