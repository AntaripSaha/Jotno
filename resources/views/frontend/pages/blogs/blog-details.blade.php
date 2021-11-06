@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
@endsection

@section('body-content')




<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Blog Details</h2>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-view">


                    <div class="blog blog-single-post">
                        <div class="blog-image">
                            <a href="javascript:void(0);"><img alt="" src="{{asset('images/blogs/'.$blogs->image)}}" class="img-fluid"></a>
                        </div>
                        <h3 class="blog-title">{{$blogs->title}}</h3>
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <ul>
                                    <li>
                                        <div class="post-author">
                                            @if($blogs->type == 'user')
                                            <img src="{{asset('images/profile/'.$blogs->user->image)}}" alt="Post Author"> <span>{{$blogs->user->name}}</span>
                                            @elseif($blogs->type == 'super_admin')
                                            <img src="{{asset('images/profile/'.$blogs->super_admin->image)}}" alt="Post Author"> <span>{{$blogs->super_admin->name}}</span>
                                            @endif
                                        </div>
                                    </li>
                                    <li><i class="far fa-calendar"></i>{{$blogs->created_at->toDateString()}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-content">
                            <p>{{$blogs->description}}</p>
                        </div>
                    </div>





                </div>
            </div>

            <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
                <div class="card search-widget">
                    <div class="card-body">

                        <form action="{{route('blog.search')}}" class="search-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" placeholder="Search..." class="form-control" name="data">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card post-widget">
                    <div class="card-header">
                        <h4 class="card-title">Latest Posts</h4>
                    </div>

                    @foreach($latest_blog as $blog )
                    <div class="card-body">
                        <ul class="latest-posts">
                            <li>
                                <div class="post-thumb">
                                    <a href="{{route('blog.details', $blog->slug)}}">
                                        <img class="img-fluid" src="{{asset('/images/blogs/'. $blog->image)}}" alt="">
                                    </a>
                                </div>
                                <div class="post-info">
                                    <h4>
                                        <a href="{{route('blog.details', $blog->slug)}}">{{$blog->title}}</a>
                                    </h4>
                                    <p>{{$blog->created_at->toDateString()}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</div>




@endsection

@section('per_page_js')
@endsection