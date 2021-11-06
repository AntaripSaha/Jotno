@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
@endsection

@section('body-content')

<section class="section section-banner" style="background : url({{ asset('images/home/'.$homeDatas->image) }})">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
            </div>
            <div class="col-12 col-md-6">
                <div class="banner-wrapper">
                    <div class="banner-header">
                        <h5>{{ $homeDatas->title }}</h5>
                        <h1>{{ $homeDatas->sub_title }}</h1>
                        <p>{{ $homeDatas->description }}</p>
                        <div class="btn-col">
                            <ul>
                                <li><a href="{{ route('contact') }}" class="btn btn-notfill">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section aboutus-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="left">
                    <div class="section-header">
                        <h5>About US</h5>
                        <h2>{{ $homeDatas->about_title }}</h2>
                    </div>
                    <p>{{ $homeDatas->about_description }}</p>
                    <div class="feature-col row">
                        <div class="col-12 col-md-6">
                            <div class="feature-box">
                                <div class="corner-img"><img src="{{ asset('frontend/img/feature1.png') }}" alt="">
                                </div>
                                <h2>{{ $homeDatas->satisfied_patient }}+</h2>
                                <h6>Satisfied Patients</h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="feature-box">
                                <div class="corner-img"><img src="{{ asset('frontend/img/feature2.png') }}" alt="">
                                </div>
                                <h2>{{ $homeDatas->patient_per_year }}+</h2>
                                <h6>Patient/Year</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="right">
                    <img src="{{ asset('images/home/'.$homeDatas->about_image) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-list">
    <div class="container">
        <div class="row">
            
           @foreach ($qualities  as $key => $quality)
               <div class="col-12 col-md-6 col-lg-3">
                <div class="feature-list-box">
                    <div class="number-col text-right">
                        <h5>0{{ $key+1 }}</h5>
                    </div>
                    <div class="feature-icon">
                        <img src="{{ asset('images/home/'.$quality->image) }}" alt="">
                    </div>
                    <h4>{{ $quality->name }}</h4>
                    <div class="plus-icon text-right"><i class="fas fa-plus-circle"></i></div>
                </div>
            </div>
           @endforeach            

        </div>
    </div>
</section>

<section class="testimonials">
    <div class="container">
    </div>
</section>

@endsection

@section('per_page_js')
@endsection
