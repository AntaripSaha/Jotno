@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link href="{{ asset('backend/css/select2/form-select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2-materialize.css') }}" rel="stylesheet">
<link href="{{ asset('backend/css/select2/select2.min.css') }}" rel="stylesheet">
<style>
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

    .add-more-row .col-md-3 {
        padding-left: 0;
        margin-bottom: 15px;
    }

    .add-more-row .col-md-3 button {
        background: #0168b3;
        color: white;
        border: none;
        padding: 7px 20px;
    }
    .or-row{
        display: none;
    }
    .drop-row{
        display: none;
    }

   /*--  fency-box css start--*/
   .main-section{
    text-align: center;
    }
    h1{
    margin-top:125px;
    text-align: center;
    }
    img{
    width: 150px;
    padding:10px;
    }
    /*--  fency-box css end --*/
</style>
@endsection

@section('body-content')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<div class="content" style="transform: none">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- left part start -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px; margin:0px; padding:0px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 0px;">
                    @include("frontend.pages.profile.patient.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9 rightSideSection">

                <div class="row">

                    <div class="col-md-12">
                        <h4 class="mb-4">                         
                            Patient Id : {{ $appoinment->patient->patient_id }}                            
                        </h4>
                    </div>

                    <div class="col-md-12">

                        <div class="appointment-tab"> 
                            @include("frontend.pages.profile.patient.pages.appoinment.includes.topbar")
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
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $prescription_report_list as $key => $prescription_report )
                                                     <tr>
                                                        <td>{{ $key + 1 }}</td>                                                        
                                                         <td>{{ $prescription_report->prescription->prescription_no }}</td>
                                                        <div>
                                                            <td ><a class="fancybox-buttons" data-fancybox-group="button"  href="{{ asset('images/report/'.$prescription_report->image) }}"><img src="{{ asset('images/report/'.$prescription_report->image) }}" id="image-preview" style="height: 50px;width:50px;"></a></td>
                                                        </div>
                                                         
                                                         <td>{{ $prescription_report->name }}</td>                                                         
                                                         <td>
                                                            <a class="dropdown-item" href="{{ route('patient.perscription.report.edit.page',['appoinment_no'=>$appoinment->appoinment_no,'prescription_report_id'=>$prescription_report->id] ) }}" >
                                                                
                                                               Edit Report
                                                            </a>
                                                         </td>
                                                     </tr>
                                                     @endforeach
                                                    </tbody>
                                                </table>
                                                    <!-- pagination div start -->
                                                    <div class="paginate-row">
                                                    {{ $prescription_report_list->links() }}
                                                    </div>
                                                    <!-- pagination div end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TAB ITEM END -->

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

@endsection


@section('per_page_js')

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
