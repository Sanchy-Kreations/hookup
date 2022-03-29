@extends('layouts.app1')

@section('content')
  <!-- Page loader -->
  <div id="preloader"></div>
  @include('inc.header')
  
  
<!-- breadcrumb area start -->
<section class="hero-area breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-area-content">
                    <h1>Our Blog</h1>
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- blog section start -->
<section class="blog-area blog-page" id="blog">
    <div class="container">
        <div class="row">

            @if ( count($blogs) > 0)

            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="single-post">
                    <div class="post-thumbnail">
                        @if ($blog->blog_img != "")
                        <a href="{{ url('blog/'.$blog->id) }}"><img src="{{ asset('img/blog/'.$blog->blog_img) }}" alt="blog"></a>       
                        @endif
                        
                    </div>
                    <div class="post-details">
                        <div class="post-author">
                            <a href="blog-detail.html"><i class="icofont icofont-user"></i>{{$blog->poster_name}}</a>
                            
                            <a href="blog-detail.html"><i class="icofont icofont-calendar"></i>{{$blog->created_at}}</a>
                        </div>
                        <h4 class="post-title"><a href="#">{{$blog->title}}</a></h4>
                        {{$blog->cnt}}
                    </div>
                </div>
            </div>

            @endforeach 
                
            @else
            <h4>There're no blog contents create yet.</h4>    
            @endif

            
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                
            </div>
        </div>
    </div>
</section><!-- blog section end -->
  
  
  
  <!-- google map area end -->

  @include('inc.footer')
@endsection