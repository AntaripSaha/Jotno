<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Medical Assistant</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>

<div class="modal-body">

    <form class="ajax-form" method="post" action="{{ route('medical_assistant.add') }}">
        @csrf
        <div class="row">
            <!-- name -->
            <div class="col-md-6 col-12 form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" >
            </div>

            <!-- email -->
            <div class="col-md-6 col-12 form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email">
            </div>

            <!-- phone number -->
            <div class="col-md-6 col-12 form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" class="form-control" name="phone">
            </div>

            <!-- Present Address -->
            <div class="col-md-6 col-12 form-group">
                <label>Present Address</label>
                <input type="text" class="form-control" name="present_address" >
            </div>

            <!-- Permanent Address -->
            <div class="col-md-6 col-12 form-group">
                <label>Permanent Address</label>
                <input type="text" class="form-control" name="permanent_address" >
            </div>

            <!-- Nid -->
            <div class="col-md-6 col-12 form-group">
                <label>NID</label>
                <input type="number" class="form-control" name="nid" >
            </div>

            <!-- BMDC Registration Number -->
            <div class="col-md-6 col-12 form-group">
                <label>BMDC Registration Number</label>
                <input type="number" class="form-control" name="bmdc_reg_no" >
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <!-- confirm password -->
            <div class="col-md-6 col-12 form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>

            <div class="col-md-12 form-group text-right">
                <button type="submit" class="btn btn-outline-dark">
                    Add
                </button>
            </div>

        </div>
    </form>

</div>
<div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>