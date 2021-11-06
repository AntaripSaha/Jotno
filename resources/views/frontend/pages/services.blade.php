@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection
<style>
    .service{
        padding: 40px 0px 40px 0px;
    }
    .custom-pagination{
          display: flex;
          text-align: center;
          width: 100%;
     }
     .custom-pagination nav{
          display: block;
          margin: 0 auto;
     }
</style>
@section('per_page_css')
@endsection

@section('body-content')

<section class="service section feature-list">
    <div class="container">
        <div class="section-header text-center">
            <h5>Services We Provide With Care</h5>
        </div>
        <div class="row">           
           @foreach ($servicesData  as $key => $service)
               <div class="col-12 col-md-6 col-lg-3 mt-3">
                <div class="feature-list-box">
                    <div class="number-col text-right">
                        <h5>{{ $key+1 }}</h5>
                    </div>
                    <div class="feature-icon">
                        <img src="{{ asset('images/service/'.$service->image) }}" alt="{{ $service->name }}" style="width:200px ;height:150px;">
                    </div>
                    <h4>{{ $service->name }}</h4>
                    <div class="plus-icon text-right"><i class="fas fa-plus-circle"></i></div>
                </div>
            </div>
           @endforeach                   
         
        </div>  
         
        <!-- Pagination start -->                    
        <div class="custon-pagination" style="text-align: center">
            {{ $servicesData->links() }}
        </div>                
        <!-- Pagination end -->     
              
    </div>
</section>
@endsection

@section('per_page_js')
@endsection
