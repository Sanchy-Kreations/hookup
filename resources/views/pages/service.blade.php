@extends('layouts.app1')

@section('content')
  <!-- Page loader -->
  <div id="preloader"></div>
  @include('inc.header')
  
  
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
                    @foreach ($services as $service)
                      <img src="{{ asset('storage/img/services/'.$service->tag) }}" alt="feature">
                      @endforeach
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
                      <h2>
                          @foreach ($services as $service)
                           {{$service->name}}
                          @endforeach
                          <span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                      <p></p>
                  </div>
              </div>
          </div>
          @if (count($subServices) > 0)
          @foreach ($subServices as $service)
          <div class="row flexbox-center">
              <div class="col-lg-6">
                  <div class="single-showcase-box">
                      <h4>{{$service->name}}</h4>
                      <p></p>
                      <a href="{{$service->url}}" class="appao-btn appao-btn2">Go to</a>
                  </div>
              </div>
              <div class="col-lg-6">
                  
              </div>
          </div>

@endforeach

       @else
       <div class="row flexbox-center">
        <div class="col-lg-6">
            <div class="single-showcase-box">
                
                <p>Sorry, no service list created under this service yet.</p>
                
            </div>
        </div>
        <div class="col-lg-6">
            
        </div>
    </div>
       

   @endif
 

          
      </div>
  </section><!-- showcase section end -->
  
  
  
  
  
  <!-- google map area end -->

  @include('inc.footer')
@endsection