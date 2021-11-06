<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $medical_assistant->medical_assistant_id }}</h5>
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
                            @if( $medical_assistant->image )
                            <img src="{{ asset('images/profile/medical_assistant/'.$medical_assistant->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/profile/user.png') }}" width="50px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $medical_assistant->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $medical_assistant->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $medical_assistant->phone }}</td>
                    </tr>
                    <tr>
                        <td>Present Address</td>
                        <td>{{ $medical_assistant->present_address }}</td>
                    </tr>
                    <tr>
                        <td>Permanent Address</td>
                        <td>{{ $medical_assistant->permanent_address }}</td>
                    </tr>
                    <tr>
                        <td>NID</td>
                        <td>{{ $medical_assistant->nid }}</td>
                    </tr>
                    <tr>
                        <td>BMDC Registration No.</td>
                        <td>{{ $medical_assistant->bmdc_reg_no }}</td>
                    </tr>
                    <tr>
                        <td>Created Time</td>
                        <td>{{ $medical_assistant->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Updated Time</td>
                        <td>{{ $medical_assistant->updated_at->toDayDateTimeString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
