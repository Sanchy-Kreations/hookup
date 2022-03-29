<!-- about section start -->
<section class="about-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>About {{ config('app.name', 'Laravel') }}<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p>See a brief info about us and who we are.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ( $contents as $content)
            {{$content->value}}
            @endforeach
            
        </div>
    </div>
</section><!-- about section end -->