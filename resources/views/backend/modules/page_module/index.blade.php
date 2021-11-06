@extends("backend.template.layout")

@section('per_page_css')
<link rel="stylesheet" href="{{ asset('backend/css/dropify.min.css') }}">
@endsection
<style>
    #datatable_filter{
        float: right;
    }
</style>
@section('body-content')
<div class="content-wrapper" style="min-height: 147px;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">
                                Home Page
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
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#home" data-toggle="tab">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#about_us" data-toggle="tab">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#quality" data-toggle="tab">
                                        Quality
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- TAB PANEL START -->
                                <div class="row tab-pane active" id="home">
                                    <form action="{{ route('home.page.update', $homeDatas->id) }}"  class="ajax-form" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <!-- title -->
                                        <div class="col-auto form-group">
                                            <label>
                                                    Title
                                            </label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="title" class="form-control" placeholder="Name" value="{{ $homeDatas->title }}"
                                                
                                                >
                                            </div>
                                        </div>
                                        <!-- sub title -->
                                        <div class="col-auto form-group">
                                            <label>
                                                   Sub Title
                                            </label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="sub_title" class="form-control" placeholder="Name" value="{{ $homeDatas->sub_title }}"
                                                
                                                >
                                            </div>
                                        </div>

                                        <!-- description -->
                                        <div class="col-auto form-group">
                                            <label>
                                                   Description 
                                            </label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                </div>
                                                <textarea name="description" id=""  class="form-control" placeholder="Description">{{ $homeDatas->description }}</textarea>
                                            
                                            </div>
                                        </div>                                       

                                        <!-- image -->
                                        <div class="col-auto form-group">
                                            <div class="dropify-wrapper">
                                                <div class="dropify-message"><span
                                                        class="file-icon"></span>
                                                    <p>
                                                        Image
                                                    </p>
                                                    <p class="dropify-error">Ooops,
                                                        something wrong appended.</p>
                                                </div>
                                                <div class="dropify-loader"
                                                    style="display: none;"></div>
                                                <div class="dropify-errors-container">
                                                    <ul></ul>
                                                </div><input type="file" id="input-file-now"
                                                    class="dropify" name="image"
                                                    data-default-file=""><button
                                                    type="button"
                                                    class="dropify-clear">Remove</button>
                                                <div class="dropify-preview"
                                                    style="display: none;"><span
                                                        class="dropify-render"></span>
                                                    <div class="dropify-infos">
                                                        <div class="dropify-infos-inner">
                                                            <p class="dropify-filename">
                                                                <span
                                                                    class="file-icon"></span>
                                                                <span
                                                                    class="dropify-filename-inner">1618054231jLxKfola9cDg.jpg</span>
                                                            </p>
                                                            <p
                                                                class="dropify-infos-message">
                                                                Drag and drop or click to
                                                                replace</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-auto form-group text-right">
                                            <button type="submit" class="btn btn-outline-dark">
                                                Update Home Page
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- TAB PANEL END -->

                                <!--ABOUT US TAB PANEL START -->
                                <div class="tab-pane" id="about_us">
                                    <form action="{{ route('about.page.update', $homeDatas->id) }}"  class="ajax-form" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <!-- about_title -->
                                            <div class="col-auto form-group">
                                                <label>
                                                       About Title
                                                </label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" name="about_title" class="form-control" placeholder="Name" value="{{ $homeDatas->about_title }}">
                                                </div>
                                            </div>    
                                            <!-- about_description -->
                                            <div class="col-auto form-group">
                                                <label>
                                                      About Description 
                                                </label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                    </div>
                                                    <textarea name="about_description" id=""  class="form-control" placeholder="Description">{{ $homeDatas->about_description }}</textarea>
                                                
                                                </div>
                                            </div>  

                                            
                                            <!-- satisfied_patient -->
                                            <div class="col-auto form-group">
                                                <label>
                                                      Satisfied Patient 
                                                </label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="satisfied_patient" class="form-control" placeholder="Satisfied Patient" value="{{ $homeDatas->satisfied_patient }}">
                                                
                                                </div>
                                            </div>  

                                            <!-- patient_per_year -->
                                            <div class="col-auto form-group">
                                                <label>
                                                      Patient Per Year  
                                                </label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-users"></i>
                                                        </div>
                                                    </div>
                                                    <input type="number" name="patient_per_year" class="form-control" placeholder="Patient Per Year" value="{{ $homeDatas->patient_per_year }}">
                                                
                                                </div>
                                            </div>   
                                     
    
                                            <!-- about_image -->
                                            <div class="col-auto form-group">
                                                <div class="dropify-wrapper">
                                                    <div class="dropify-message"><span
                                                            class="file-icon"></span>
                                                        <p>
                                                            Image
                                                        </p>
                                                        <p class="dropify-error">Ooops,
                                                            something wrong appended.</p>
                                                    </div>
                                                    <div class="dropify-loader"
                                                        style="display: none;"></div>
                                                    <div class="dropify-errors-container">
                                                        <ul></ul>
                                                    </div><input type="file" id="input-file-now"
                                                        class="dropify" name="about_image"
                                                        data-default-file=""><button
                                                        type="button"
                                                        class="dropify-clear">Remove</button>
                                                    <div class="dropify-preview"
                                                        style="display: none;"><span
                                                            class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename">
                                                                    <span
                                                                        class="file-icon"></span>
                                                                    <span
                                                                        class="dropify-filename-inner">1618054231jLxKfola9cDg.jpg</span>
                                                                </p>
                                                                <p
                                                                    class="dropify-infos-message">
                                                                    Drag and drop or click to
                                                                    replace</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-auto form-group text-right">
                                                <button type="submit" class="btn btn-outline-dark">
                                                    Update About Us
                                                </button>
                                            </div>
                                        </form>
                                </div>
                                <!--ABOUT US  TAB PANEL END -->

                                <!--QUALITY TAB PANEL START -->
                                <div class="tab-pane" id="quality">  
                                    <div class="card-header text-right">

                                        @if( can("quality_page") )
                                        <button type="button" data-content="{{ route('quality.add.modal') }}" data-target="#largeModal"
                                            class="btn btn-outline-dark" data-toggle="modal">
                                            Add
                                        </button>
                                        @endif
            
                                    </div>
                                    <div class="card-body">
            
                                        <table class="table table-bordered table-striped dataTable dtr-inline quality-datatable" style="width: 100%;"
                                            id="datatable" >
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Position</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <!--QUALITY  TAB PANEL END -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection

@section('per_page_js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('backend/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/js/form-file-uploads.min.js') }}"></script>

<script src="{{ asset('backend/js/custom-script.min.js') }}"></script>

<script src="{{ asset('backend/js/datatable/jquery.validate.js') }}"></script>
<script src="{{ asset('backend/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/js/datatable/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{  asset('backend/js/ajax_form_submit.js') }}"></script>


<script>
    $(function () {
        $('.quality-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('quality.all.data') }}",
            order: [
                [0, 'Desc']
            ],
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'position',
                    name: 'position'
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

