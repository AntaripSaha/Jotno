@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<style>
    .paginate-row {
        padding-left: 15px;
    }
    .select2-container{
        z-index: 9999!important;
    }
    .spinner-border{
        position: absolute;
        left: 50%;
        top: 50%;
        background: #ee344e;
        display: none;
    }
</style>
@endsection

@section('body-content')
<div class="content" style="transform: none; min-height: 201px;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- LEFT SIDEBAR START -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">

                    @include('frontend.pages.profile.doctor.includes.left_sidebar')

                </div>
            </div>
            <!-- LEFT SIDEBAR END -->

            <!-- RIGHT SIDEBAR START -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <!-- INFORMATION CARD START -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card dash-card">
                            <div class="card-body">
                                <div class="row">

                                    <!-- ITEM START -->
                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget dct-border-rht">
                                            <div class="circle-bar circle-bar1">
                                                <div class="circle-graph1" data-percent="75"><canvas width="400"
                                                        height="400"></canvas>
                                                    <img src="{{ asset('frontend/img/icon-01.png') }}" class="img-fluid"
                                                        alt="patient">
                                                </div>
                                            </div>
                                            <div class="dash-widget-info">
                                                <h6>Total Patient</h6>
                                                <h3>{{ $patient }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ITEM END -->

                                    <!-- ITEM START -->
                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget dct-border-rht">
                                            <div class="circle-bar circle-bar2">
                                                <div class="circle-graph2" data-percent="65"><canvas width="400"
                                                        height="400"></canvas>
                                                    <img src="{{ asset('frontend/img/icon-02.png') }}" class="img-fluid"
                                                        alt="Patient">
                                                </div>
                                            </div>
                                            <div class="dash-widget-info">
                                                <h6>Today Appoinment</h6>
                                                <h3>{{ $todays_appoinments }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ITEM END -->

                                    <!-- ITEM START -->
                                    <div class="col-md-12 col-lg-4">
                                        <div class="dash-widget">
                                            <div class="circle-bar circle-bar3">
                                                <div class="circle-graph3" data-percent="50"><canvas width="400"
                                                        height="400"></canvas>
                                                    <img src="{{ asset('frontend/img/icon-03.png') }}" class="img-fluid"
                                                        alt="Patient">
                                                </div>
                                            </div>
                                            <div class="dash-widget-info">
                                                <h6>Total Appoinments</h6>
                                                <h3>{{ $total_appoinment }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ITEM END -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- INFORMATION CARD END -->

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">Patient Appoinment</h4>
                        <div class="appointment-tab">

                            @include('frontend.pages.profile.doctor.includes.topbar')


                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane show active" id="all-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="float-right" style="padding: 5px;">
                                                    <input type="search" class="form-control" id="search" placeholder="Search Here...">
                                                </div>
                                                <table class="table table-hover table-center mb-0">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <thead>
                                                        <tr>
                                                            <th>Appoinment No.</th>
                                                            <th>Appoinment Date</th>
                                                            <th>Patient Info</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dynamic-row">
                                                        @forelse( $appoinments as $appoinment )
                                                        <tr>
                                                            <td>
                                                                {{ $appoinment->appoinment_no }}
                                                            </td>
                                                            <td>
                                                                {{ $appoinment->appoinment_date ?? "N/A" }}
                                                            </td>
                                                            <td>
                                                                <p style="margin-bottom: 0;">
                                                                    {{ $appoinment->patient->name }}
                                                                </p>
                                                                <p style="margin-bottom: 0;">
                                                                    {{ $appoinment->patient->phone }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                {{ $appoinment->status }}
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton_{{ $appoinment->id }}"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $appoinment->id }}">
                                                                        <a class="dropdown-item" href="{{ route('doctor.appoinment.details',$appoinment->appoinment_no) }}">
                                                                            <i class="fas fa-eye"></i>
                                                                            View
                                                                        </a>
                                                                        <a class="dropdown-item" href="#" data-content="{{ route('doctor.appoinment.note.modal',$appoinment->id) }}" data-target="#myModal" data-toggle="modal">
                                                                            <i class="far fa-clipboard"></i>
                                                                            Note
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                No Data Found
                                                            </td>
                                                        </tr>
                                                        @endforelse

                                                    </tbody>
                                                </table>
                                                <div class="paginate-row">
                                                    {{ $appoinments->links() }}
                                                </div>
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
            <!-- RIGHT SIDEBAR END -->

        </div>
    </div>
</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('frontend/js/modal.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>

<script>
    $(document).on("input","#search",function(){
        $(".spinner-border").show()
        let $this = $(this)
        const value = $this.val()
        const doctor_id = "{{ auth('doctor')->user()->id }}"
        $.ajax({
            "type" : "GET",
            "url" : "{{ route('doctor.today.appoinment.search') }}",
            data : {
                search : value,
                doctor : doctor_id,
            },
            success : function(response){
                $(".spinner-border").hide()

                $("#dynamic-row tr").remove()

                if( response.searchResult.data.length == 0 ){
                    $("#dynamic-row").append(`
                        <tr>
                            <td colspan="6" class="text-center">
                                No Data Found
                            </td>
                        </tr>
                    `)
                }
                else{
                    $.each(response.searchResult.data , function(index, val) { 
                        let view_prescription_route = "{{ route('doctor.appoinment.details',':id') }}";
                        view_prescription_route = view_prescription_route.replace(':id', val.appoinment_no);

                        let view_modal = "{{ route('doctor.appoinment.note.modal',':id') }}";
                        view_modal = view_modal.replace(':id', val.id);


                        $("#dynamic-row").append(`
                        <tr>             
                            <td>${val.appoinment_no}</td>
                            <td>${val.appoinment_date ? val.appoinment_date : 'N/A' }</td>
                            <td>
                                <p style="margin-bottom: 0;">
                                    ${val.patient.name}
                                </p>
                                <p style="margin-bottom: 0;">
                                    ${val.patient.phone}
                                </p>
                            </td>
                            <td>${val.status}</td>
                            
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
                                            View
                                        </a>
                                        <a class="dropdown-item" href="#" data-content="${view_modal}" data-target="#myModal" data-toggle="modal">
                                            <i class="far fa-clipboard"></i>
                                            Note
                                        </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        `)
                    });
                }

            },
            error : function(response){
                $(".spinner-border").hide()

            },
        })
    })
</script>
@endsection
