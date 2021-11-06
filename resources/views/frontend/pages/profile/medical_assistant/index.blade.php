@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
<style>
    .paginate-row{
        padding-left: 15px;
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
<link rel="stylesheet" href="{{ asset('backend/css/loader.css') }}">
<div class="content" style="transform: none; min-height: 201px;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- left part start -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar"
                    style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 30px;">
                    @include("frontend.pages.profile.medical_assistant.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">Patient Appoinment</h4>
                        <div class="appointment-tab">

                            @include("frontend.pages.profile.medical_assistant.includes.topbar")
                           

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">

                                                <div class="float-right" style="padding: 5px;">
                                                    <input type="search" class="form-control" id="searchToDay" placeholder="Search Here...">
                                                </div>

                                                <table class="table table-hover table-center mb-0">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    <thead>
                                                        <tr>
                                                            <th>Sl No.</th>
                                                            <th>Appoinment No.</th>
                                                            <th>Appoinment Date</th>
                                                            <th>Patient Info</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody  id="dynamic-row">
                                                        @forelse( $appoinments as $key => $appoinment )
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
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
                                                                        <a class="dropdown-item" href="{{ route('medical.assistant.appoinment.details',$appoinment->appoinment_no) }}">
                                                                            <i class="fas fa-eye"></i>
                                                                            View
                                                                        </a>
                                                                        <a class="dropdown-item" href="#" data-content="{{ route('medical.assistant.appoinment.note.modal',$appoinment->id) }}" data-target="#myModal" data-toggle="modal">
                                                                            <i class="far fa-clipboard"></i>
                                                                            Note
                                                                        </a>
                                                                        @if( $appoinment->status == "Pending" || $appoinment->status == "Confirm" )
                                                                        <a class="dropdown-item" href="#" data-content="{{ route('medical.assistant.appoinment.cancel.modal',$appoinment->id) }}" data-target="#myModal" data-toggle="modal">
                                                                            <i class="fas fa-times"></i>
                                                                            Cancel
                                                                        </a>
                                                                        @endif
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
            <!-- right part end -->

        </div>
    </div>
</div>

@endsection


@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>
<script src="{{ asset('frontend/js/modal.js') }}"></script>
<script src="{{ asset('frontend/js/ajax-form-submit.js') }}"></script>
<script>
    $("#searchToDay").on('input', function(){
        $(".spinner-border").show()
        let $this = $(this);
        var searchRequest = $(this).val();
        
        
       $.ajax({
            "type" : 'GET',
            "url": '{{ route("medical_assistant.appointment.search_today") }}',
            data:{
                searchToDay : searchRequest,
            },
            success: function(response){
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
                        let view_appoinment_details_route = "{{ route('medical.assistant.appoinment.details',':id') }}";
                        view_appoinment_details_route = view_appoinment_details_route.replace(':id', val.appoinment_no);

                        let view_appoinment_note_route = "{{ route('medical.assistant.appoinment.note.modal',':id') }}";
                        view_appoinment_note_route = view_appoinment_note_route.replace(':id', val.id);

                        let view_appoinment_cancel_route = "{{ route('medical.assistant.appoinment.cancel.modal',':id') }}";
                        view_appoinment_cancel_route = view_appoinment_cancel_route.replace(':id', val.id);                    

                        
                        $("#dynamic-row").append(`
                        <tr>             
                            <td>${index+1}</td>
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
                                        <a class="dropdown-item" href="${view_appoinment_details_route}">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                        <a class="dropdown-item" href="#" data-content="${view_appoinment_note_route}" data-target="#myModal" data-toggle="modal">
                                            <i class="far fa-clipboard"></i>
                                            Note
                                        </a>
                                        ${ 
                                            ( val.status == "Pending" || val.status == "Confirm" ) ? 
                                            `<a class="dropdown-item" href="#" data-content="${view_appoinment_cancel_route}" data-target="#myModal" data-toggle="modal">
                                                <i class="fas fa-times"></i>
                                                Cancel
                                            </a>`
                                            : "" 
                                        }
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
            }
           
        });
    });
</script>
@endsection