<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $doctor->doctor_id }}</h5>
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
                            @if( $doctor->image )
                            <img src="{{ asset('images/profile/doctor/'.$doctor->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/profile/user.png') }}" width="50px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $doctor->name }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>{{ $doctor->charge->type }}</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>{{ $doctor->designation }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $doctor->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $doctor->phone }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $doctor->gender }}</td>
                    </tr>
                    <tr>
                        <td>In Time</td>
                        <td>{{ $doctor->in }}</td>
                    </tr>
                    <tr>
                        <td>Out Time</td>
                        <td>{{ $doctor->out }}</td>
                    </tr>
                    <tr>
                        <td>Available</td>
                        <td>{{ $doctor->is_availabe ? "Yes" : "No" }}</td>
                    </tr>
                    <tr>
                        <td>Chamber</td>
                        <td>{{ $doctor->chamber }}</td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td>{{ $doctor->location }}</td>
                    </tr>
                    <tr>
                        <td>Degree</td>
                        <td>{{ $doctor->degree }}</td>
                    </tr>
                    <tr>
                        <td>Speciality</td>
                        <td>{{ $doctor->speciality ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>NID</td>
                        <td>{{ $doctor->nid ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Created Time</td>
                        <td>{{ $doctor->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Updated Time</td>
                        <td>{{ $doctor->updated_at->toDayDateTimeString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
