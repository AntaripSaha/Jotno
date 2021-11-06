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

    @media( min-width : 320px ) and ( max-width : 500px ){
        .cart-change-box .main-row .col-md-2,
        .cart-change-box .main-row .col-md-4,
        .cart-change-box .main-row .col-md-12{
            margin-bottom: 5px!important;
        }

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
                    @include("frontend.pages.profile.doctor.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9 rightSideSection">

                <div class="row">

                    <div class="col-md-12">
                        <h4 class="mb-4">
                            Patient Appoinment No : {{ $appoinment->appoinment_no }}
                        </h4>
                    </div>

                    <div class="col-md-12">

                        <div class="appointment-tab">

                            @include("frontend.pages.profile.doctor.pages.appoinment.includes.topbar")

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <form
                                                action="{{ route('medical.assistant.perscription.edit',$prescription->prescription_no) }}"
                                                method="post" class="ajax-form">
                                                @csrf

                                                <div class="row">

                                                    <!-- left sidebar start -->
                                                    <div class="col-md-3 col-12">

                                                        <!-- test type item start -->
                                                        @foreach( $test_types as $test_type )
                                                        <div class="test-type-item form-group">
                                                            <label>
                                                                {{ $test_type->name }}
                                                            </label>
                                                            <select name="{{ $test_type->id }}_test_type_list_id[]"
                                                                multiple required class="form-control select2">
                                                                @foreach( $test_type->test_type_list as $test_type_list
                                                                )
                                                                <option 
                                                                
                                                                @foreach( $test_type->prescription_test_type->where("prescription_id",$prescription->id) as $prescription_test )
                                                                    @foreach( unserialize($prescription_test->test_type_list) as $test_type_list_id )
                                                                        @if( $test_type_list_id == $test_type_list->id )
                                                                        selected
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach

                                                                value="{{ $test_type_list->id }}">
                                                                    {{ $test_type_list->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @endforeach
                                                        <!-- test type item end -->

                                                    </div>
                                                    <!-- left sidebar end -->

                                                    <!-- right sidebar start -->
                                                    <div class="col-md-9 right-part">

                                                        <!-- add more button start -->
                                                        <div class="row add-more-row">
                                                            <div class="col-md-3 col-12">
                                                                <button type="button" class="add-more">
                                                                    Add More
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!-- add more button end -->


                                                        <!-- medicine box start -->
                                                        @foreach( $prescription->prescription_medicine as $key => $prescription_medicine )
                                                        <div class="row medicine-box" id="medicine-box" data-count="0">

                                                            <!-- medicine field start -->
                                                            <div class="col-md-12 mb-3 medicine_here">
                                                                <label>Select Medicine</label>
                                                                <select 

                                                                @if( $prescription_medicine->type == "Mark" )
                                                                name="medicine_id_mark[]" 
                                                                @elseif( $prescription_medicine->type == "OR" )
                                                                name="medicine_id_or[]" 
                                                                @elseif( $prescription_medicine->type == "Drop" )
                                                                name="medicine_id_drop[]" 
                                                                @endif

                                                                required
                                                                    class="form-control select2 ">
                                                                    <option value=""></option>
                                                                    @foreach( $medicines as $medicine )
                                                                    <option 
                                                                    @if( $prescription_medicine->medicine_id == $medicine->id )
                                                                    selected
                                                                    @endif
                                                                    value="{{ $medicine->id }}">
                                                                        {{ $medicine->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!-- medicine field end -->

                                                            <!-- card change part start -->
                                                            <div class="col-md-10 cart-change-box">

                                                                <!-- mark row start -->
                                                                @if( $prescription_medicine->type == "Mark" )
                                                                <div class="row main-row">

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="morning_mark[]" required
                                                                            class="form-control">
                                                                            <option disabled>Morning</option>
                                                                            @foreach(
                                                                            $timings->where("type","Morning")->where("group","Mark")
                                                                            as $timing )
                                                                            <option 

                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Morning") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach

                                                                            value="{{ $timing->id }}">
                                                                                {{ $timing->value }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="noon_mark[]" required
                                                                            class="form-control">
                                                                            <option disabled>Noon</option>
                                                                            @foreach(
                                                                            $timings->where("type","Noon")->where("group","Mark")
                                                                            as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Noon") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">
                                                                                {{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="night_mark[]" required
                                                                            class="form-control">
                                                                            <option disabled>Night</option>
                                                                            @foreach(
                                                                            $timings->where("type","Night")->where("group","Mark")
                                                                            as $timing )
                                                                            <option
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Night") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">
                                                                                {{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="time_mark[]" required
                                                                            class="form-control">
                                                                            <option disabled>Time</option>
                                                                            @foreach(
                                                                            $timings->where("type","Time")->where("group","Mark")
                                                                            as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Timming") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">
                                                                                {{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-4">
                                                                        <select name="running_mark[]" required
                                                                            class="form-control">
                                                                            <option disabled>Running</option>
                                                                            @foreach( $timings->where("type","Running")
                                                                            as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Morning") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">
                                                                                {{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item start -->

                                                                </div>
                                                                @endif
                                                                <!-- mark row end -->

                                                                <!-- or row start -->
                                                                @if( $prescription_medicine->type == "OR" )
                                                                <div class="row main-row">
                                                                    <div class="col-md-12">
                                                                        <input type="text" value="{{ $prescription_medicine->note }}" name="or[]" required class="form-control">
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <!-- or row end -->


                                                                <!-- drop row start -->
                                                                @if( $prescription_medicine->type == "Drop" )
                                                                <div class="row main-row">
                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="morning_drop[]" required class="form-control">
                                                                            <option disabled>Morning</option>
                                                                            @foreach( $timings->where("type","Morning")->where("group","Drop") as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Morning") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">{{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="noon_drop[]" required class="form-control">
                                                                            <option disabled>Noon</option>
                                                                            @foreach( $timings->where("type","Noon")->where("group","Drop") as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Noon") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">{{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="night_drop[]" required class="form-control">
                                                                            <option disabled>Night</option>
                                                                            @foreach( $timings->where("type","Night")->where("group","Drop") as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Night") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">{{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-2">
                                                                        <select name="time_drop[]" required class="form-control">
                                                                            <option disabled>Time</option>
                                                                            @foreach( $timings->where("type","Time")->where("group","Drop") as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Timming") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">{{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item end -->

                                                                    <!-- item start -->
                                                                    <div class="col-md-4">
                                                                        <select name="running_drop[]" required class="form-control">
                                                                            <option disabled>Running</option>
                                                                            @foreach( $timings->where("type","Running") as $timing )
                                                                            <option 
                                                                            @foreach( collect(unserialize($prescription_medicine->timing)[0])->where("value","Running") as $medicine_timing )
                                                                                @if( $medicine_timing['id'] == $timing->id )
                                                                                    selected
                                                                                @endif
                                                                            @endforeach
                                                                            value="{{ $timing->id }}">{{ $timing->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!-- item start -->
                                                                </div>
                                                                @endif
                                                                <!-- drop row end -->



                                                            </div>
                                                            <!-- card change part end -->

                                                            <!-- type choose card start -->
                                                            <div class="col-md-2 cart-type-choose">
                                                                <select name="type[]" required
                                                                    class="form-control type-change">
                                                                    <option @if( $prescription_medicine->type == "Mark" ) selected @endif value="Mark">Mark</option>
                                                                    <option @if( $prescription_medicine->type == "OR" ) selected @endif value="OR">OR</option>
                                                                    <option @if( $prescription_medicine->type == "Drop" ) selected @endif value="Dropper">Dropper</option>
                                                                </select>
                                                            </div>
                                                            <!-- type choose card end -->

                                                            <!-- remove card start -->
                                                            @if( $key != 0 )
                                                            <div class="col-md-2 offset-md-10 remove-card mt-3">
                                                                <button type="button" class="remove-card btn btn-danger">
                                                                    Remove
                                                                </button>
                                                            </div>
                                                            @endif
                                                            <!-- remove card end -->

                                                        </div>
                                                        @endforeach
                                                        <!-- medicine box end -->

                                                    </div>
                                                    <!--right sidebar end-->

                                                    <!-- advise start -->
                                                    <div class="col-md-12 form-group">
                                                        <label>Give Advice</label>
                                                        <textarea name="advice" rows="3" required class="form-control">
                                                            {{ $prescription->advice }}
                                                        </textarea>
                                                    </div>
                                                    <!-- advise end -->

                                                    <!-- button button box start -->
                                                    <div class="col-md-2 offset-md-10 col-12 text-right">
                                                        <button class="btn btn-primary">
                                                            Save
                                                        </button>
                                                    </div>
                                                    <!-- button button box end -->

                                                </div>

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

@endsection


@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/modal.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>

<script src="{{ asset('backend/js/select2/form-select2.min.js') }}"></script>
<script src="{{ asset('backend/js/select2/select2.full.min.js') }}"></script>

<script>
    function selectRefresh() {
        $(".card-body .select2").select2({
            dropdownAutoWidth: true,
            tags: true,
            allowClear: true,
            width: '100%'
        });
    }

</script>

<script>
    $(".add-more").click(function () {

        $(".right-part").append(`
        <!-- medicine box start -->
        <div class="row medicine-box" id="medicine-box">

            <!-- medicine field start -->
            <div class="col-md-12 mb-3 medicine_here">
                <label>Select Medicine</label>
                <select name="medicine_id_mark[]" required class="form-control select2 ">
                    <option value=""></option>
                    @foreach( $medicines as $medicine )
                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- medicine field end -->

            <!-- card change part start -->
            <div class="col-md-10 cart-change-box">

                <!-- mark row start -->
                <div class="row main-row">

                    <!-- item start -->
                    <div class="col-md-2">
                        <select name="morning_mark[]" required class="form-control">
                            <option disabled>Morning</option>
                            @foreach( $timings->where("type","Morning")->where("group","Mark") as $timing )
                            <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-2">
                        <select name="noon_mark[]" required class="form-control">
                            <option disabled>Noon</option>
                            @foreach( $timings->where("type","Noon")->where("group","Mark") as $timing )
                            <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-2">
                        <select name="night_mark[]" required class="form-control">
                            <option disabled>Night</option>
                            @foreach( $timings->where("type","Night")->where("group","Mark") as $timing )
                            <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-2">
                        <select name="time_mark[]" required class="form-control">
                            <option disabled>Time</option>
                            @foreach( $timings->where("type","Time")->where("group","Mark") as $timing )
                            <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- item end -->

                    <!-- item start -->
                    <div class="col-md-4">
                        <select name="running_mark[]" required class="form-control">
                            <option disabled>Running</option>
                            @foreach( $timings->where("type","Running") as $timing )
                            <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- item start -->

                </div>
                <!-- mark row end -->

            </div>
            <!-- card change part end -->

            <!-- type choose card start -->
            <div class="col-md-2 cart-type-choose">
                <select name="type[]" required class="form-control type-change">
                    <option value="Mark">Mark</option>
                    <option value="OR">OR</option>
                    <option value="Dropper">Dropper</option>
                </select>
            </div>
            <!-- type choose card end -->

            <!-- remove card start -->
            <div class="col-md-2 offset-md-10 remove-card mt-3">
                <button type="button" class="remove-card btn btn-danger">
                    Remove
                </button>
            </div>
            <!-- remove card end -->

        </div>
        <!-- medicine box end -->
        `);
        selectRefresh();
    })

    $(document).on("click", ".remove-card", function () {
        let $this = $(this)
        $this.closest(".medicine-box").remove()
    })

</script>

<script>
    $(document).ready(function () {
        selectRefresh();
    });
</script>


<script>
    $(document).on('change',".type-change",function(e){
        let $this = $(this)
        if( e.target.value == "Mark" ){


            $this.closest(".medicine-box").find(".medicine_here").find(".select2").removeAttr("name")
            $this.closest(".medicine-box").find(".medicine_here").find(".select2").attr("name","medicine_id_mark[]")

            $this.closest(".medicine-box").find(".cart-change-box").find(".main-row").remove()
            $this.closest(".medicine-box").find(".cart-change-box").append(`
            <div class="row main-row">

                <!-- item start -->
                <div class="col-md-2">
                    <select name="morning_mark[]" required class="form-control">
                        <option disabled>Morning</option>
                        @foreach( $timings->where("type","Morning")->where("group","Mark") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="noon_mark[]" required class="form-control">
                        <option disabled>Noon</option>
                        @foreach( $timings->where("type","Noon")->where("group","Mark") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="night_mark[]" required class="form-control">
                        <option disabled>Night</option>
                        @foreach( $timings->where("type","Night")->where("group","Mark") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="time_mark[]" required class="form-control">
                        <option disabled>Time</option>
                        @foreach( $timings->where("type","Time")->where("group","Mark") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-4">
                    <select name="running_mark[]" required class="form-control">
                        <option disabled>Running</option>
                        @foreach( $timings->where("type","Running") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item start -->

            </div>
            `);

        }
        else if( e.target.value == "OR" ){

            $this.closest(".medicine-box").find(".medicine_here").find(".select2").removeAttr("name")
            $this.closest(".medicine-box").find(".medicine_here").find(".select2").attr("name","medicine_id_or[]")

            $this.closest(".medicine-box").find(".cart-change-box").find(".main-row").remove()
            $this.closest(".medicine-box").find(".cart-change-box").append(`
            <div class="row main-row">
                <div class="col-md-12">
                    <input type="text" name="or[]" required class="form-control">
                </div>
            </div>
            `);

        }
        else if( e.target.value == "Dropper" ){

            $this.closest(".medicine-box").find(".medicine_here").find(".select2").removeAttr("name")
            $this.closest(".medicine-box").find(".medicine_here").find(".select2").attr("name","medicine_id_drop[]")

            $this.closest(".medicine-box").find(".cart-change-box").find(".main-row").remove()
            $this.closest(".medicine-box").find(".cart-change-box").append(`
            <div class="row main-row">
                <!-- item start -->
                <div class="col-md-2">
                    <select name="morning_drop[]" required class="form-control">
                        <option disabled>Morning</option>
                        @foreach( $timings->where("type","Morning")->where("group","Drop") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="noon_drop[]" required class="form-control">
                        <option disabled>Noon</option>
                        @foreach( $timings->where("type","Noon")->where("group","Drop") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="night_drop[]" required class="form-control">
                        <option disabled>Night</option>
                        @foreach( $timings->where("type","Night")->where("group","Drop") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-2">
                    <select name="time_drop[]" required class="form-control">
                        <option disabled>Time</option>
                        @foreach( $timings->where("type","Time")->where("group","Drop") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item end -->

                <!-- item start -->
                <div class="col-md-4">
                    <select name="running_drop[]" required class="form-control">
                        <option disabled>Running</option>
                        @foreach( $timings->where("type","Running") as $timing )
                        <option value="{{ $timing->id }}">{{ $timing->value }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- item start -->
            </div>
            `);

            
        }
    })
</script>

@endsection
