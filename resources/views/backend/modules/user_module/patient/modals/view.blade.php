
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ $patient->patient_id }}</h5>
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
                            @if( $patient->image )
                            <img src="{{ asset('images/profile/patient/'.$patient->image) }}" width="50px" alt="">
                            @else
                            <img src="{{ asset('images/profile/user.png') }}" width="50px" alt="">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $patient->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $patient->email }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $patient->phone }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $patient->gender }}</td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>{{ $patient->blood_group }}</td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        @php
                        $birthday = $patient->date_of_birth;
                        $age = Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y years, %m months and %d days');
                        @endphp
                        
                        <td>{{$age}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $patient->address }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $patient->city }}</td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td>{{ $patient->district }}</td>
                    </tr>
                    <tr>
                        <td>Created Time</td>
                        <td>{{ $patient->created_at->toDayDateTimeString() }}</td>
                    </tr>
                    <tr>
                        <td>Updated Time</td>
                        <td>{{ $patient->updated_at->toDayDateTimeString() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
