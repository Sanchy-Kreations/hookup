<div id="page">
    <div class="header-container">
      <header id="header">
                                                                
<div class="wrapper it_RPQYEMIUNCQX container">
<div class="stickUpTop" style="position: relative; top: 0px;"><div class="stickUpHolder container"><div class="row it_KGKWZGQUMCAH stick-up align-center lg-revers">
<div class="it_LJUDUOHSNWIO col-xs-12   col-lg-5 position-static">
<div class="module ">

          <div class="top_menu top-level tmmegamenu_item">
          <div class="menu-title tmmegamenu_item">Menu</div>
          <ul class="menu clearfix top-level-menu tmmegamenu_item" style="">
           
            <li class="top-level-menu-li tmmegamenu_item it_08757749">
              <a class="it_08757749 top-level-menu-li-a tmmegamenu_item" href="{{ url('male_escorts') }}">Male Escorts</a>
              </li> 
            
            
           
            <li class=" top-level-menu-li tmmegamenu_item it_78068715"><a class="it_78068715 top-level-menu-li-a tmmegamenu_item" href="{{ url('female_escorts') }}">Female Escorts</a></li>
            
             
             <li class=" top-level-menu-li tmmegamenu_item it_69158529"><a class="it_69158529 top-level-menu-li-a tmmegamenu_item" href="{{ url('verified_escorts') }}">All Verified Escorts</a></li>     
            
             
             
              <li class="top-level-menu-li tmmegamenu_item it_45513499"><a class="it_45513499 top-level-menu-li-a tmmegamenu_item" href="{{ url('escorts_on_travel') }}">Escorts On Travel</a></li>       
              
              
              
              
              

            <li class=" top-level-menu-li tmmegamenu_item it_91617735">
  <span class="menu-mobile-grover"></span>
  <a class="it_91617735 top-level-menu-li-a tmmegamenu_item" href="#">{{ config('app.name', 'Laravel') }} Extra</a>
  <div class="is-megamenu tmmegamenu_item first-level-menu it_91617735 menu-mobile clearfix">
  <div id="megamenu-row-1-1" class="megamenu-row row megamenu-row-1">
  <div id="column-1-1-1" class="megamenu-col megamenu-col-1-1 col-sm-3 ">
  <ul class="content">
  <li class="category"><span class="menu-mobile-grover"></span>
  <a href="#" title="Bra sets">Parties</a>
  <ul class="menu-mobile clearfix">
<li class="category"><a href="{{ url('extra/pool_party') }}" title="32A">Pool party</a></li>
<li class="category"><a href="{{ url('extra/beach_cruse') }}" title="32B">Beach cruse</a></li>

</ul>
</li>

</ul>
</div>


</div></div>
</li>
</ul>
  
          </div>
  </div>
<div class="module ">

  @auth

         @else
    
         <div id="header-login">
          <div class="current tm_header_user_info">
            <a href="#" onclick="return false;" class=" login ">
              <span>
                          Sign in
                      </span>
            </a>
          </div>
                </div>

         @endauth



         

</div></div>
<div class="it_UNENASNXHYME col-xs-12   col-lg-2 text-center">
<div class="header_logo">
@foreach ($settings as $setting)
  @if ($setting->logo != "")
  <a href="{{ url('')}}" title="Lingerie">
    <img class="logo img-responsive" src="{{ asset('storage/img/site_logo/'.$setting->logo)}}" alt="Lingerie" width="230" height="43">
  </a> 
  @endif
@endforeach
 

</div>
</div>
<div class="it_PFOHALAFVHBX col-xs-12   col-lg-5 icon-links">



<div class="module ">

<div id="tmsearch">
<span id="search-toggle"></span>
<form id="tmsearchbox" method="get" action="">
        <input type="hidden" name="fc" value="module">
    <input type="hidden" name="controller" value="tmsearch">
    <input type="hidden" name="module" value="tmsearch">
      <input type="hidden" name="orderby" value="position">
  <input type="hidden" name="orderway" value="desc">
  <div class="selector" style="width: 706px;"><span style="width: 683px; user-select: none;">All Categories</span>
    <select name="search_categories" class="form-control">
            <option value="" disabled selected>Select State</option>
            
        </select></div>
  <input class="tm_search_query form-control" type="text" id="tm_search_query" name="search_query" placeholder="Search" value="" autocomplete="off">
  <button type="submit" name="tm_submit_search" class="button-search"></button>
  <span class="search-close"></span>
</form>
</div></div>

<div class="module "><!-- MODULE Block cart -->


  @auth
  @include('inc.loggedin-navbar')
  @else
  
  @endauth




<!-- /MODULE Block cart --></div></div></div></div></div>



                                    
                            </header>
    
</div>
    

