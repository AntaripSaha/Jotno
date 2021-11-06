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
                                All Banner 
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

                            <table class="table table-bordered table-striped dataTable dtr-inline banner-datatable"
                                id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
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

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>





<script>
    $(function () {
        $('.banner-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('messege.data') }}",
            order: [
                [0, 'Desc']
            ],
            columns: [
                
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'subject',
                    name: 'subject'
                },                
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });
</script>
@endsection