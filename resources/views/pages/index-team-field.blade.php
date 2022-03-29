<!-- team section start -->
<section class="team-area ptb-90" id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sec-title">
                    <h2>Meet Our Team<span class="sec-title-border"><span></span><span></span><span></span></span></h2>
                    
                </div>
            </div>
        </div>
        <div class="row">
            @if ( count($users) > 0)

           @foreach ($users as $user)
           <div class="col-lg-3 col-sm-6">
            <div class="single-team-member">
                <div class="team-member-img">
                    <img src="{{ asset('storage/'.$user->email.'/'.$user->img) }}" alt="team">
                    <div class="team-member-icon">
                        <div class="display-table">
                            <div class="display-tablecell">
                                <a href="{{$user->facebook}}"><i class="icofont icofont-social-facebook"></i></a>
                                <a href="{{$user->twitter}}"><i class="icofont icofont-social-twitter"></i></a>
                                <a href="{{$user->linkedin}}"><i class="icofont icofont-brand-linkedin"></i></a>
                                <a href="{{$user->instagram}}"><i class="icofont icofont-social-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member-info">
                    <a href="#"><h4>{{$user->name}}</h4></a>
                    <p>{{$user->profession}}</p>
                </div>
            </div>
        </div>
           @endforeach 

            @endif
            
            
        </div>
    </div>
</section><!-- team section end -->