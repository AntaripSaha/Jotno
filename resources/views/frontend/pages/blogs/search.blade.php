@extends("frontend.template.layout")

@section('per_page_meta')
<title>Jotno - Medical Services</title>
@endsection

@section('per_page_css')
@endsection

@section('body-content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Gluten:wght@300;400&display=swap');
</style>
<style>
    .a {
        font-family: 'Gluten', cursive;
        margin: auto;
        width: 40%;
        padding: 10px;


    }
</style>

<body>

    <div class="main-wrapper">

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
                        <h2 class="breadcrumb-title">Blog List</h2>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="row blog-grid-row">


                            @forelse($blogs as $blog)
                            <div class="col-md-6 col-sm-12">
                                <div class="blog grid-blog">
                                    <div class="blog-image">
                                        <a href="{{route('blog.details', $blog->id)}}"><img class="img-fluid" src="{{asset('images/blogs/'.$blog->image)}}" alt="Post Image"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">

                                                    @if($blog->type == "user")
                                                    <img src="{{asset('images/profile/'.$blog->user->image)}}" alt="Post Author">{{$blog->user->name}}<span></span>
                                                    @elseif($blog->type == "super_admin")
                                                    <img src="{{asset('images/profile/'.$blog->super_admin->image)}}" alt="Post Author">{{$blog->super_admin->name}}<span></span>
                                                    @endif
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i>{{$blog->created_at->toDateString()}}</li>
                                        </ul>
                                        <h3 class="blog-title"><a href="{{route('blog.details', $blog->slug)}}">{{$blog->title}}</a></h3>
                                        <p class="mb-0">{{Str::limit($blog->description), 60}}</p>
                                    </div>
                                </div>
                            </div>
                            @empty

                            <div class="blog blog-single-post">
                                <div class="blog-image">
                                    <a href="" onclick="return false;"><img alt="" src="images/search.png" class="img-fluid"></a>
                                </div>

                                <h3 class="a">No Results Found!</h3>

                            </div>

                            @endforelse


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="blog-pagination">
                                    <nav>
                                        {{$blogs->links()}}
                                    </nav>
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
                                        <input type="text" placeholder="{{$var}}" class="form-control" name="data">
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
    </div>
</body>


@endsection

@section('per_page_js')
@endsection