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

    .or-row {
        display: none;
    }

    .drop-row {
        display: none;
    }

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
                    
                    <p>Appointment No : {{ $appoinment->appoinment_no }}</p>

                    <div class="col-md-12">

                        <div class="appointment-tab">
                            @include("frontend.pages.profile.patient.pages.appoinment.includes.topbar")
                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <form class="ajax-form"  method="POST"  action={{ route('patient.perscription.report.add',$prescription->prescription_no) }} enctype="multipart/form-data">
                                                @csrf
                                                 <div class="add_item">
                         
                                                     <div class="form-row">
                                                             <div class="form-group col-md-4 col-sm-8">
                                                                 <label>Image</label>
                                                                 <input type="file" name="image[]" class="form-control">
                                                             </div> 
                         
                                                             <div class="form-group col-md-6 col-sm-8">
                                                                 <label>Report Name</label>
                                                                 <input type="text" name="name[]" class="form-control">
                                                             </div> 
                         
                                                             <div class="form-group col-md-2" style="padding-top: 30px;">
                                                                 <span class="btn btn-primary addeventmore"><i class="fa fa-plus-circle"></i>Add More</span>
                                                             </div>
                         
                                                     </div>
                                             </div>
                                             <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                             </form>
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

 <!--- add more event input fields start ----->
 <div style="visibility: hidden;">
    <div class="whole_extra_iten_add" id="whole_extra_iten_add">
        <div class="delete_whole_extra_iten_add" id="delete_whole_extra_iten_add">
            <div class="row">

                <div class="form-group col-md-4 col-sm-8">
                    <label>Image</label>
                    <input type="file" name="image[]" class="form-control">
                </div> 

                <div class="form-group col-md-6 col-sm-8">
                    <label>Report Name</label>
                    <input type="text" name="name[]" class="form-control">
                </div> 

                <div class="form-group col-md-2" style="padding-top: 30px;">
                    <div class="form-row">
                         <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                         <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                    </div>
                 </div>

            </div>
        </div>
    </div>        
</div>

@endsection


@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>


<!--- addeventmore ----->
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0 ;
        $(document).on("click" , ".addeventmore" ,function(){
            var whole_extra_iten_add = $("#whole_extra_iten_add").html();
            $(this).closest(".add_item").append(whole_extra_iten_add);
            counter++;
        });
        $(document).on("click" , ".removeeventmore" , function(event){
            $(this).closest(".delete_whole_extra_iten_add").remove();
            counter -=1 
        });
    });

</script>
<!--- addeventmore ----->
@endsection
