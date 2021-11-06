@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
    .sub_module_block ul {
        padding-left: 15px !important;
    }
    .sub_module_block ul p {
        margin-bottom: 5px !important;
    }
    .select2-container {
        z-index: 99999 !important;
    }
</style>
@endsection

@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                All Appointment
                            </a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline table-responsive">                       
                        <div class="card-body">
                            <!--search-->
                            <div class="row float-right">
                                <div class="form-group ">
                                    <input type="search" name="search" id="search" class="form-control" placeholder="Search Here..." />
                                </div>
                            </div>
                            <!--search-->
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Appoinment No</th>
                                        <th>Appoinment Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dynamic-row">
                                    @foreach( $appointments as $key => $appointment )
                                    <tr>    
                                        
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $appointment->appoinment_no }}</td>
                                        <td>{{ $appointment->appoinment_date ?? ' N/A' }}</td>
                                        <td>{{ $appointment->total ?? 'N/A' }}</td>
                                        <td>{{ $appointment->status }}</td>
                                        <td>{{ $appointment->payment_status }}</td>
                                       
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle"
                                                    type="button" id="dropdownMenuButton_{{ $appointment->id }}"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $appointment->id }}">
                                                    <a class="dropdown-item" href="{{ route('perscription.view', $appointment->appoinment_no) }}" >
                                                        <i class="fa fa-eye"></i>
                                                        View Prescription
                                                    </a>
                                                    <a class="dropdown-item"  href="{{ route('individual.appointment.details', $appointment->appoinment_no) }}" >
                                                        <i class="far fa-calendar-check"></i>
                                                        View Appointment
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginate-row">
                                {{ $appointments->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

<script>
    $("#search").on('input', function(){
        var searchRequest = $(this).val();
        
       $.ajax({
            "type" : 'GET',
            "url": '{{ route("appointment.search") }}',
            data:{
                search : searchRequest,
            },
            success: function(response){
                $("#dynamic-row tr").remove()

                $.each(response.searchResult , function(index, val) { 
				
                    let view_prescription_route = "{{ route('perscription.view',':id') }}";
                    view_prescription_route = view_prescription_route.replace(':id', val.appoinment_no);

                    let view_appoinment_route = "{{ route('individual.appointment.details',':id') }}";
                    view_appoinment_route = view_appoinment_route.replace(':id', val.appoinment_no);


                    $("#dynamic-row").append(`
                    <tr>             
                        <td>${index+1}</td>
                        <td>${val.appoinment_no}</td>
                        <td>${val.appoinment_date ? val.appoinment_date : 'N/A' }</td>
                        <td>${val.total ? val.total : 'N/A' }</td>
                        <td>${val.status}</td>
                        <td>${val.payment_status}</td>
                        
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle"
                                    type="button" id="dropdownMenuButton_${val.id}"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_${val.id}">
                                    <a class="dropdown-item" href="${view_prescription_route}" >
                                        <i class="fa fa-eye"></i>
                                        View Prescription
                                    </a>
                                    <a class="dropdown-item"  href="${view_appoinment_route}" >
                                        <i class="far fa-calendar-check"></i>
                                        View Appointment
                                    </a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    `)
                });
            }
        });
    });
</script>

@endsection