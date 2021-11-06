@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
@endsection

@section('body-content')


<section class="feature-list mt-3">
    <div class="container">
    
        <div class="card">
                <div class="card-body">
                <h5 class="card-title text-center"><u>{{ $new_page_datas->name }}</u></h5>
                <p class="card-text">{!! $new_page_datas->description !!}</p>              
                </div>
            </div> 
</div>
</section>


@endsection

@section('per_page_js')
@endsection
