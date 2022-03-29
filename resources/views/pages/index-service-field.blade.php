<!-- feature section start -->
<section class="feature-area ptb-90" id="feature">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-4">
                <div class="single-feature-box text-lg-right text-center">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature-box text-center">
                    <img src="{{ asset('img/slider/erp1.jpg') }}" alt="feature">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-feature-box text-lg-left text-center">
                    
                </div>
            </div>
        </div>
    </div>
</section><!-- feature section end -->
<!-- showcase section start -->
<section class="showcase-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Services<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    <p>Check out the list of our services below.</p>
                </div>
            </div>
        </div>
        @foreach ($services as $service)
            
               @if ($service->id == 1)
               <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4>{{$service->name}}</h4>
                        <p>{{$service->content}} </p>
                        
                        <a href="{{ url('services/'.$service->id) }}" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
               @endif
            @if ($service->id == 2)
            
            <div class="row flexbox-center">
                <div class="col-lg-6">
                    
                </div>
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4>{{$service->name}}</h4>
                        <p>{{$service->content}} </p>
                        <a href="{{ url('services/'.$service->id) }}" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
            </div>

            @endif
            
            @if ($service->id == 3)

            <div class="row flexbox-center">
                <div class="col-lg-6">
                    <div class="single-showcase-box">
                        <h4>{{$service->name}}</h4>
                        <p>{{$service->content}} </p>
                        <a href="{{ url('services/'.$service->id) }}" class="appao-btn appao-btn2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
                
            @endif

        @endforeach
        
       
    </div>
</section><!-- showcase section end -->