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
<div class="content" style="transform: none; min-height: 201px;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <!-- left part start -->
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"
                style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 30px;">
                    @include("frontend.pages.profile.patient.includes.left_sidebar")
                </div>
            </div>
            <!-- left part end -->


            <!-- right part start -->
            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mb-4">Patient Appoinment</h4>
                        <div class="appointment-tab">

                            @include("frontend.pages.profile.patient.includes.topbar")

                            <div class="tab-content">

                                <!-- TAB ITEM START -->
                                <div class="tab-pane active" id="today-appointments">
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
                                                                {{ $appoinment->status }}
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="table-action">
                                                                    <a href="{{ route('patient.appoinment.details',$appoinment->appoinment_no) }}"
                                                                        class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> View
                                                                    </a>
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
<script>
    $("#get_appoinment").click(function(){
        const patient = "{{ auth('patient')->user()->id }}"
        
        $.ajax({
            type : "GET",
            url : "{{ route('get.appoinment') }}",
            data : {
                patient_id : patient,
            },
            success : function(response){
                if (response.success) {
                    swal("", `${response.success}`, "success");
                }
                if (response.warning) {
                    swal("", `${response.warning}`, "warning");
                }
                if (response.error) {
                    swal("", `${response.error}`, "error");
                }
            },
            error : function(response){
                if (response.error) {
                    swal("", `${response.error}`, "error");
                }
            }
        })

    })
</script>


<script>
    $(document).on("input","#search",function(){
        $(".spinner-border").show()
        let $this = $(this)
        const value = $this.val()
        const patient_id = "{{ auth('patient')->user()->id }}"
        $.ajax({
            "type" : "GET",
            "url" : "{{ route('patient.today.appoinment.search') }}",
            data : {
                search : value,
                patient : patient_id,
            },
            success : function(response){
                $(".spinner-border").hide()
                $("#dynamic-row tr").remove()

                if( response.searchResult.length == 0 ){
                    $("#dynamic-row").append(`
                        <tr>
                            <td colspan="6" class="text-center">
                                No Data Found
                            </td>
                        </tr>
                    `)
                }
                else{
                    $.each(response.searchResult, function(index, val) { 
                        let view_appoinment_route = "{{ route('patient.appoinment.details',':id') }}";
                        view_appoinment_route = view_appoinment_route.replace(':id', val.appoinment_no);


                        $("#dynamic-row").append(`
                        <tr>             
                            <td>${val.appoinment_no}</td>
                            <td>${val.appoinment_date ? val.appoinment_date : 'N/A' }</td>
                            <td>${val.status}</td>
                            
                            <td class="text-left">
                                <div class="table-action">
                                    <a href="${view_appoinment_route}"
                                        class="btn btn-sm bg-info-light">
                                        <i class="far fa-eye"></i> View
                                    </a>
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
