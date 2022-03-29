<!-- blog section start -->
<section class="blog-area ptb-90" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Our Latest Blog<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row">
            @if ( count($blogs) > 0)

            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="single-post">
                    <div class="post-thumbnail">
                        <a href="{{ url('blog/'.$blog->id) }}"><img src="{{ asset('img/blog/'.$blog->blog_img) }}" alt="blog"></a>
                    </div>
                    <div class="post-details">
                        <div class="post-author">
                            <a href="#"><i class="icofont icofont-user"></i>{{$blog->poster_name}}</a>
                            
                            <a href="#"><i class="icofont icofont-calendar"></i>{{$blog->created_at}}</a>
                        </div>
                        <h4 class="post-title"><a href="blog.html">{{$blog->title}}</a></h4>
                    {{$blog->cnt}}
                    </div>
                </div>
            </div>
            
            @endforeach 

            @endif

        </div>
    </div>
</section><!-- blog section end -->