@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
@endsection

@section('body-content')


<section class="section aboutus-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="left">
                    <div class="section-header">
                        <h5>About US</h5>
                        <h2>{{ $aboutDatas->about_title }}</h2>
                    </div>
                    <p>{{ $aboutDatas->about_description }}</p>
                    <div class="feature-col row">
                        <div class="col-12 col-md-6">
                            <div class="feature-box">
                                <div class="corner-img"><img src="{{ asset('frontend/img/feature1.png') }}" alt="">
                                </div>
                                <h2>{{ $aboutDatas->satisfied_patient }}+</h2>
                                <h6>Satisfied Patients</h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="feature-box">
                                <div class="corner-img"><img src="{{ asset('frontend/img/feature2.png') }}" alt="">
                                </div>
                                <h2>{{ $aboutDatas->patient_per_year }}+</h2>
                                <h6>Patient/Year</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="right">
                    <img src="{{ asset('images/home/'.$aboutDatas->about_image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('per_page_js')
@endsection
