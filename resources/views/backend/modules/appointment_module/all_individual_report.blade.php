@extends("backend.template.layout")

@section('per_page_css')
<link href="{{ asset('backend/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="http://127.0.0.1:8000/frontend/css/jquery.fancybox.css">
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
    .paginate-row {
        padding-left: 15px;
    }

    .card-table .card-body {
        padding: 15px;
    }

    .addDiv {
        margin-top: 4px;
        padding: 0px;
        border-radius: 2px;
    }

    .addDivLeft {
        margin: 0px;
        padding: 0px;
    }

    .contact .info-box {
        border-top: 4px solid #6d1a0c;
        padding: 0px;
    }

    .formGroupRightPadding {
        padding: 2px;
    }

    .smallDiv-6 {
        margin: 0px;
        padding: 0px;
    }

    .section-title {
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
    }

    .theiaStickySidebar .widget-profile .rightSideSection {
        padding: 0px;
        margin: 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        color: #0168b3 !important;
    }

    .medicine-box {
        padding: 15px;
        border: 1px solid #0168b3;
        border-left: 5px solid red;
        margin-bottom: 15px;
    }

    .right-part {
        padding: 0 30px;
    }
    .prescription-view-card.print{
        display: none;
    }
    @media print {
        .main-wrapper,
        header{
            display: none;
        }
        .prescription-view-card.print{
            display: block;
        }
    }
    .pbtn:hover{
        background-color: #EE344E; /* Green */
        color: white; 
    }
</style>
<link rel="stylesheet" href="{{ asset('frontend/css/prescription.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/billing.css') }}">
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
                                        Appointment No  : {{ $appoinment->appoinment_no }}                      
                                    </h4>
                                </div>

                                <div class="col-md-12">
                                   <button class="btn btn-primary pbtn">
                                       <a href="{{ route('perscription.view',$appoinment->appoinment_no) }}" style="color: #fff;" >< Back</a>
                                   </button>
                                            
                                       
                                    <div class="appointment-tab"> 
                                        <div class="tab-content">
                                            <!-- TAB ITEM START -->
                                            <div class="tab-pane active" id="today-appointments">
                                                <div class="card card-table mb-0">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SI</th>
                                                                        <th>Prescription No.</th>
                                                                        <th>Image</th>
                                                                        <th>Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach( $prescription_reports as $key => $prescription_report )
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>                                                        
                                                                    <td>{{ $prescription_report->prescription->prescription_no }}</td>
                                                                    <div>
                                                                        <td ><a class="fancybox-buttons" data-fancybox-group="button"  href="{{ asset('images/report/'.$prescription_report->image) }}"><img src="{{ asset('images/report/'.$prescription_report->image) }}" id="image-preview" style="height: 50px;width:50px;"></a></td>
                                                                    </div>
                                                                    
                                                                    <td>{{ $prescription_report->name }}</td>                                                      
                                                                    
                                                                        
                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            <div class="paginate-row">
                                                                {{ $prescription_reports->links() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TAB ITEM END -->

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
<!--fency-box support-->
<script src="http://127.0.0.1:8000/frontend/js/jquery.fancybox.js"></script>
<script src="http://127.0.0.1:8000/frontend/js/jquery.fancybox.pack.js"></script>
<!--fency-box support-->
<script>
    $(document).ready(function() {
    $('.fancybox').fancybox();
    $('.fancybox-buttons').fancybox({
    openEffect : 'none',
    closeEffect : 'none',
    prevEffect : 'none',
    nextEffect : 'none',
    closeBtn : false,
    helpers : {
    title : {
    type : 'inside'
    },
    buttons	: {}
    },
    afterLoad : function() {
    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
    }
    });
    });
</script>

@endsection