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
    .card-table .card-body {
        padding: 15px;
    }

    .addDiv {
        margin-top: 4px;
        padding: 0px;
        border-radius: 2px;
    }

</style>
<link rel="stylesheet" href="{{ asset('frontend/css/prescription.css') }}">
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
                                Prescription
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
                <div class="col-md-12 rightSideSection">
                    <div class="card card-primary card-outline table-responsive">                       
                        <div class="card-body">
                            <!-- right part start -->

                                <div class="row">

                                    <div class="col-md-12">
                                        <h4 class="mb-4">
                                            Patient Appoinment No : {{ $appoinment->appoinment_no }}
                                        </h4>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="appointment-tab">
                                            <div class="tab-content">
                                                <!-- TAB ITEM START -->
                                                <div class="tab-pane active" id="today-appointments">
                                                    <div class="card card-table mb-0">
                                                        <div class="card-body prescription-topbar">
                                                            <div class="col-md-12">
                                                                
                                                                    <p class="text-center"><b>There Is No Prescription By This Appointment</b></p><br>
                                                                    <ul  class="text-center">
                                                                        <li>
                                                                            <a href="{{ route('appointment.all') }}">
                                                                                < Back To All Appoinment Page
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- right part end -->
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection

@section('per_page_js')


@endsection