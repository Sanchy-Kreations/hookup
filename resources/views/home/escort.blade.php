@extends('layouts.app1')

@section('content')
<style >
#about-editor{
  width: 100%;
  border: solid 1px rgb(160, 157, 159) !important;
  height: 200px;
}

span.labeled{
  font-weight: bold;
  color: #000000;
}

</style>


<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
            <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
            <script src="{{ asset('js/jquery.easing.js') }}"></script>
            <script src="{{ asset('js/tools.js') }}"></script>
            <script src="{{ asset('js/global.js') }}"></script>
            <script src="{{ asset('js/10-bootstrap.min.js') }}"></script>
            <script src="{{ asset('js/14-device.min.js') }}"></script>
            <script src="{{ asset('js/15-jquery.total-storage.min.js') }}"></script>
            <script src="{{ asset('js/15-jquery.uniform-modified.js') }}"></script>
            <script src="{{ asset('js/16-jquery.scrollmagic.min.js') }}"></script>
            <script src="{{ asset('js/17-jquery.scrollmagic.debug.js') }}"></script>
            <script src="{{ asset('js/18-TimelineMax.min.js') }}"></script>
            <script src="{{ asset('js/19-TweenMax.min.js') }}"></script>
            <script src="{{ asset('js/20-jquery.bxslider.js') }}"></script>
            <script src="{{ asset('js/21-jquery.uitotop.js') }}"></script>
            <script src="{{ asset('js/22-jquery.wow.js') }}"></script>
            <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
            <script src="{{ asset('js/products-comparison.js') }}"></script>
            <script src="{{ asset('js/jquery.idTabs.js') }}"></script>
            <script src="{{ asset('js/jquery.scrollTo.js') }}"></script>
            <script src="{{ asset('js/jquery.serialScroll.js') }}"></script>
            <script src="{{ asset('js/jquery.bxslider.js') }}"></script>
            <script src="{{ asset('js/product.js') }}"></script>
            <script src="{{ asset('js/socialsharing.js') }}"></script>
            <script src="{{ asset('js/ajax-cart.js') }}"></script>
            
            <script src="{{ asset('js/treeManagement.js') }}"></script>
            <script src="{{ asset('js/blockfacebook.js') }}"></script>
            <script src="{{ asset('js/blocknewsletter.js') }}"></script>

            <script src="{{ asset('js/jquery.rating.pack.js') }}"></script>
            <script src="{{ asset('js/sendtoafriend.js') }}"></script>
            <script src="{{ asset('js/productscategory.js') }}"></script>
            <script src="{{ asset('js/crossselling.js') }}"></script>
           
            <script src="{{ asset('js/tmrelatedproducts.js') }}"></script>

            <script src="{{ asset('js/homeslider.js') }}"></script>
            <script src="{{ asset('js/ajax-wishlist.js') }}"></script>
            <script src="{{ asset('js/validate.js') }}"></script>
            <script src="{{ asset('js/tmnewsletter.js') }}"></script>
            <script src="{{ asset('js/hoverIntent.js') }}"></script>
            <script src="{{ asset('js/superfish.js') }}"></script>
            <script src="{{ asset('js/tmmegamenu.js') }}"></script>
            <script src="{{ asset('js/jquery.rd-parallax.min.js') }}"></script>
            <script src="{{ asset('js/jquery.youtubebackground.js') }}"></script>
            <script src="{{ asset('js/jquery.vide.min.js') }}"></script>
            <script src="{{ asset('js/tmmediaparallax.js') }}"></script>
            <script src="{{ asset('js/vendor.js') }}"></script>
            <script src="{{ asset('js/motoslider.js') }}"></script>
            
            <script src="{{ asset('js/tmmanufacturerblock.js') }}"></script>
            <script src="{{ asset('js/jquery.autocomplete.js') }}"></script>
            <script src="{{ asset('js/tmsearch.js') }}"></script>
            <script src="{{ asset('js/tmheaderaccount.js') }}"></script>
            <script src="{{ asset('js/jQuery.hotSpot.js') }}"></script>
            <script src="{{ asset('js/tmlookbook.js') }}"></script>
            <script src="{{ asset('js/front.js') }}"></script>
            <script src="{{ asset('js/jssor.slider.min.js') }}"></script>
            <script src="{{ asset('js/jssor.slider.mini.js') }}"></script>
            <script src="{{ asset('js/tmmosaicproducts.js') }}"></script>
            <script src="{{ asset('js/video_2.js') }}"></script>
            <script src="{{ asset('js/tmmegalayout.js') }}"></script>
            <script src="{{ asset('js/ajax-collections.js') }}"></script>
            <script src="{{ asset('js/tmcl_row_1.js') }}"></script>
            <script src="{{ asset('js/tmcl_row_2.js') }}"></script>
            <script src="{{ asset('js/tmcl_row_3.js') }}"></script>
            <script src="{{ asset('js/tmcl_row_4.js') }}"></script>
            <script src="{{ asset('js/video.js') }}"></script>
            <script src="{{ asset('js/jquery.countdown.js') }}"></script>
            <script src="{{ asset('js/tmdaydeal.js') }}"></script>

            <script src="{{ asset('js/tmproductzoomer.js') }}"></script>
            <script src="{{ asset('js/jquery.ez-plus.js') }}"></script>

            <script src="{{ asset('js/slick.min.js') }}"></script>
            <script src="{{ asset('js/arrive.min.js') }}"></script>
            <script src="{{ asset('js/tmproductlistgallery.js') }}"></script>
            <script src="{{ asset('js/themeconfiglink.js') }}"></script>
            <script src="{{ asset('js/jquery.textareaCounter.plugin.js') }}"></script>
            <script src="{{ asset('js/productcomments.js') }}"></script>
            
            
  
            

            <script type="text/javascript">
              $(document).ready(function(){
              
                    $total_record = {{count($users)}};
                   $record_per_page = 9;
                   $numer_of_page = ($total_record / $record_per_page);
                   $current_page = 1;
                   $start = Math.ceil($current_page * $record_per_page) - $record_per_page;
                   
                   firstColum($record_per_page, $start);
                   
                   loadSuscribers();

                   firstColumMaleEscorts($record_per_page, $start);

                   firstColumFemaleEscorts($record_per_page, $start);

                   firstColumVerifiedEscorts($record_per_page, $start);

                   firstColumEscortsOnTravel($record_per_page, $start);

                   function loadSuscribers(){
                    $action = "loadSubEscorts";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_index_subescorts') }}",
                     data: {"action": $action},
                     beforeSend:function(){
                         //$("#index-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     //$("#index-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i] == 0 && data.data[i].img != null){
                          //$("#subscribers-loaders").append("\r\n<div class=\'slide-inner\'><div u=\'thumb\'> <img src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><div class=\'thumb-info\'><p class=\'thumb-name\'>"+data.data[i].name+"<\/p><span class=\'thumb-price\'>"+data.data[i].phone+"<\/span><\/div><\/div><div class=\'slide-image col-xs-12\'><div class=\'slide-image-wrap\'><div id=\'inner-slider-10\' style=\'width: 1920px;\' class=\'sliders-inner\'><div u=\'slides\' class=\'inner-slides\'> <div> <img u=\'image\' class=\'img-responsive\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><img class=\'js-inner-thumbnail-buttons\' u=\'thumb\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' /><\/div><\/div><div class=\'slide-info\'><h3><a href=\'{{ url('escort') }}/"+data.data[i].id+"\'>"+data.data[i].name+"<\/a><\/h3> <p class=\'slide-description\'>"+data.data[i].about+"<\/p><div class=\'button_wrap clearfix\'><div class=\'product-price-wrap\'><div class=\'product-price\'><span class=\'product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/div><div u=\'thumbnavigator\' class=\'inner-thumbnail-buttons\'><div u=\'slides\'><div u=\'prototype\' class=\'p\'><div class=\w\><div u=\'thumbnailtemplate\' class=\'t\'><\/div><\/div><div class=\c\><\/div><\/div><\/div><\/div><\/div> <\/div><\/div><\/div>\r\n");
                         }
                         if(data.data[i] == 1 && data.data[i].img != null){
                          //$("#subscribers-loaders").append("\r\n<div class=\'slide-inner\'><div u=\'thumb\'> <img src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><div class=\'thumb-info\'><p class=\'thumb-name\'>"+data.data[i].name+"<\/p><span class=\'thumb-price\'>"+data.data[i].phone+"<\/span><\/div><\/div><div class=\'slide-image col-xs-12\'><div class=\'slide-image-wrap\'><div id=\'inner-slider-18\' style=\'width: 1920px;\' class=\'sliders-inner\'><div u=\'slides\' class=\'inner-slides\'> <div> <img u=\'image\' class=\'img-responsive\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><img class=\'js-inner-thumbnail-buttons\' u=\'thumb\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' /><\/div><\/div><div class=\'slide-info\'><h3><a href=\'{{ url('escort') }}/"+data.data[i].id+"\'>"+data.data[i].name+"<\/a><\/h3> <p class=\'slide-description\'>"+data.data[i].about+"<\/p><div class=\'button_wrap clearfix\'><div class=\'product-price-wrap\'><div class=\'product-price\'><span class=\'product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/div><div u=\'thumbnavigator\' class=\'inner-thumbnail-buttons\'><div u=\'slides\'><div u=\'prototype\' class=\'p\'><div class=\w\><div u=\'thumbnailtemplate\' class=\'t\'><\/div><\/div><div class=\c\><\/div><\/div><\/div><\/div><\/div> <\/div><\/div><\/div>\r\n");
                         }
                         if(data.data[i] == 2 && data.data[i].img != null){
                          //$("#subscribers-loaders").append("\r\n<div class=\'slide-inner\'><div u=\'thumb\'> <img src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><div class=\'thumb-info\'><p class=\'thumb-name\'>"+data.data[i].name+"<\/p><span class=\'thumb-price\'>"+data.data[i].phone+"<\/span><\/div><\/div><div class=\'slide-image col-xs-12\'><div class=\'slide-image-wrap\'><div id=\'inner-slider-22\' style=\'width: 1920px;\' class=\'sliders-inner\'><div u=\'slides\' class=\'inner-slides\'> <div> <img u=\'image\' class=\'img-responsive\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' /><img class=\'js-inner-thumbnail-buttons\' u=\'thumb\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' /><\/div><\/div><div class=\'slide-info\'><h3><a href=\'{{ url('escort') }}/"+data.data[i].id+"\'>"+data.data[i].name+"<\/a><\/h3> <p class=\'slide-description\'>"+data.data[i].about+"<\/p><div class=\'button_wrap clearfix\'><div class=\'product-price-wrap\'><div class=\'product-price\'><span class=\'product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/div><div u=\'thumbnavigator\' class=\'inner-thumbnail-buttons\'><div u=\'slides\'><div u=\'prototype\' class=\'p\'><div class=\w\><div u=\'thumbnailtemplate\' class=\'t\'><\/div><\/div><div class=\c\><\/div><\/div><\/div><\/div><\/div> <\/div><\/div><\/div>\r\n");
                         }
                        }   
                          
                        }else if(data.success == false){
                          //$("#subscribers-loaders").append(data.message);
                        }else{
                          //$("#subscribers-loaders").append(data);
                        }
                          
                     }
                     });
                   }


                     function firstColum($record_per_page, $start){
                      $action = "loadEscorts";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_index_page_escorts') }}",
                     data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
                     beforeSend:function(){
                         $("#index-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     $("#index-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i].img != null){
                          $("#index-loader").append("\r\n<li class=\'ajax_block_product col-xs-6 col-sm-6 col-md-4 last-in-line first-item-of-tablet-line first-item-of-mobile-line\'><div class=\'product-container\'><div class=\'left-block\'><div class=\'product-image-container\'><div class=\'tmproductlistgallery rollover\'><div class=\'tmproductlistgallery-images\'> <a class=\'product_img_link cover-image link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' itemprop=\'url\' style=\'opacity: 1;\' title=\'"+data.data[i].name+"\' ><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a> <a class=\'product_img_link rollover-hover link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\' style=\'opacity: 0;\'><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a>  <\/div><\/div><a class=\'sale-box\' href=\'{{ url('escort') }}/"+data.data[i].id+"\'><span class=\'sale-label "+data.data[i].verified+"\'>"+data.data[i].verified+"<\/span> <\/a><\/div><\/div><div class=\'right-block\'><h5 itemprop=\'name\'><a class=\'product-name\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\'><span class=\'list-name\'>"+data.data[i].name+"<\/span><span class=\'grid-name\'>"+data.data[i].name+"<\/span><\/a></h5><div class=\'content_price\'><span class=\'price product-price product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/li>\r\n");
                         }   
                        }   
                          
                        }else if(data.success == false){
                          $("#index-loader").append(data.message);
                        }else{
                          $("#index-loader").append(data);
                        }
                          
                     }
                     });
                     
                   }
                   



                   function firstColumMaleEscorts($record_per_page, $start){
                      $action = "loadMaleEscorts";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_male_escorts_page') }}",
                     data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
                     beforeSend:function(){
                         $(".male-escorts-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     $(".male-escorts-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i].img != null){
                          $(".male-escorts-loader").append("\r\n<li class=\'ajax_block_product col-xs-6 col-sm-6 col-md-4 last-in-line first-item-of-tablet-line first-item-of-mobile-line\'><div class=\'product-container\'><div class=\'left-block\'><div class=\'product-image-container\'><div class=\'tmproductlistgallery rollover\'><div class=\'tmproductlistgallery-images\'> <a class=\'product_img_link cover-image link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' itemprop=\'url\' style=\'opacity: 1;\' title=\'"+data.data[i].name+"\' ><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a> <a class=\'product_img_link rollover-hover link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\' style=\'opacity: 0;\'><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a>  <\/div><\/div><a class=\'sale-box\' href=\'{{ url('escort') }}/"+data.data[i].id+"\'><span class=\'sale-label "+data.data[i].verified+"\'>"+data.data[i].verified+"<\/span> <\/a><\/div><\/div><div class=\'right-block\'><h5 itemprop=\'name\'><a class=\'product-name\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\'><span class=\'list-name\'>"+data.data[i].name+"<\/span><span class=\'grid-name\'>"+data.data[i].name+"<\/span><\/a></h5><div class=\'content_price\'><span class=\'price product-price product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/li>\r\n");
                         }   
                        }   
                          
                        }else if(data.success == false){
                          $(".male-escorts-loader").append(data.message);
                        }else{
                          $(".male-escorts-loader").append(data);
                        }
                          
                     }
                     });
                     
                   }

                   function firstColumFemaleEscorts($record_per_page, $start){
                      $action = "loadFemaleEscorts";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_female_escorts_page') }}",
                     data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
                     beforeSend:function(){
                         $(".female-escorts-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     $(".female-escorts-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i].img != null){
                          $(".female-escorts-loader").append("\r\n<li class=\'ajax_block_product col-xs-6 col-sm-6 col-md-4 last-in-line first-item-of-tablet-line first-item-of-mobile-line\'><div class=\'product-container\'><div class=\'left-block\'><div class=\'product-image-container\'><div class=\'tmproductlistgallery rollover\'><div class=\'tmproductlistgallery-images\'> <a class=\'product_img_link cover-image link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' itemprop=\'url\' style=\'opacity: 1;\' title=\'"+data.data[i].name+"\' ><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a> <a class=\'product_img_link rollover-hover link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\' style=\'opacity: 0;\'><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a>  <\/div><\/div><a class=\'sale-box\' href=\'{{ url('escort') }}/"+data.data[i].id+"\'><span class=\'sale-label "+data.data[i].verified+"\'>"+data.data[i].verified+"<\/span> <\/a><\/div><\/div><div class=\'right-block\'><h5 itemprop=\'name\'><a class=\'product-name\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\'><span class=\'list-name\'>"+data.data[i].name+"<\/span><span class=\'grid-name\'>"+data.data[i].name+"<\/span><\/a></h5><div class=\'content_price\'><span class=\'price product-price product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/li>\r\n");
                         }   
                        }   
                          
                        }else if(data.success == false){
                          $(".female-escorts-loader").append(data.message);
                        }else{
                          $(".female-escorts-loader").append(data);
                        }
                          
                     }
                     });
                     
                   }

                   function firstColumVerifiedEscorts($record_per_page, $start){
                      $action = "loadVerifiedEscorts";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_verified_escorts_page') }}",
                     data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
                     beforeSend:function(){
                         $(".verified-escorts-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     $(".verified-escorts-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i].img != null){
                          $(".verified-escorts-loader").append("\r\n<li class=\'ajax_block_product col-xs-6 col-sm-6 col-md-4 last-in-line first-item-of-tablet-line first-item-of-mobile-line\'><div class=\'product-container\'><div class=\'left-block\'><div class=\'product-image-container\'><div class=\'tmproductlistgallery rollover\'><div class=\'tmproductlistgallery-images\'> <a class=\'product_img_link cover-image link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' itemprop=\'url\' style=\'opacity: 1;\' title=\'"+data.data[i].name+"\' ><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a> <a class=\'product_img_link rollover-hover link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\' style=\'opacity: 0;\'><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a>  <\/div><\/div><a class=\'sale-box\' href=\'{{ url('escort') }}/"+data.data[i].id+"\'><span class=\'sale-label "+data.data[i].verified+"\'>"+data.data[i].verified+"<\/span> <\/a><\/div><\/div><div class=\'right-block\'><h5 itemprop=\'name\'><a class=\'product-name\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\'><span class=\'list-name\'>"+data.data[i].name+"<\/span><span class=\'grid-name\'>"+data.data[i].name+"<\/span><\/a></h5><div class=\'content_price\'><span class=\'price product-price product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/li>\r\n");
                         }   
                        }   
                          
                        }else if(data.success == false){
                          $(".verified-escorts-loader").append(data.message);
                        }else{
                          $(".verified-escorts-loader").append(data);
                        }
                          
                     }
                     });
                     
                   }



                   function firstColumEscortsOnTravel($record_per_page, $start){
                      $action = "loadEscortsOnTravel";
                     $.ajax({
                      headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                       type: "POST",
                     dataType: "json",
                     url: "{{ action('App\Http\Controllers\AjaxRequestController@load_escorts_on_travel_page') }}",
                     data: {"record_per_page": $record_per_page, "start": $start, "action": $action},
                     beforeSend:function(){
                         $(".escorts-on-travel-loader").append("<div class='load'><img src='{{ asset('loaders/bx_loader.gif')}}'/ > Loading...</div>");
                     },
                     complete:function(){
                         $(".load").remove();
                     },
                     error:function(){
                     $(".escorts-on-travel-loader").append("<div class='errLoading'><img src='{{asset('icons/ic_connections.png')}}'/ > Please check your internet connection</div>");
                     },
                     success:function(data){
                      var profile_img = '';
                      var profile_verify_img = '';
                        if(data.success == true){
            
                         for(i = 0; i < data.data.length; i++){
                           if(data.data[i].img != null){
                          $(".escorts-on-travel-loader").append("\r\n<li class=\'ajax_block_product col-xs-6 col-sm-6 col-md-4 last-in-line first-item-of-tablet-line first-item-of-mobile-line\'><div class=\'product-container\'><div class=\'left-block\'><div class=\'product-image-container\'><div class=\'tmproductlistgallery rollover\'><div class=\'tmproductlistgallery-images\'> <a class=\'product_img_link cover-image link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' itemprop=\'url\' style=\'opacity: 1;\' title=\'"+data.data[i].name+"\' ><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a> <a class=\'product_img_link rollover-hover link-id-"+data.data[i].id+"\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\' style=\'opacity: 0;\'><img class=\'img-responsive img-id-"+data.data[i].id+"\' src=\'{{ asset('storage/img/users') }}/"+data.data[i].id+"/profile/"+data.data[i].verify_img+"\' alt=\'"+data.data[i].name+"\' title=\'"+data.data[i].name+"\'><\/a>  <\/div><\/div><a class=\'sale-box\' href=\'{{ url('escort') }}/"+data.data[i].id+"\'><span class=\'sale-label "+data.data[i].verified+"\'>"+data.data[i].verified+"<\/span> <\/a><\/div><\/div><div class=\'right-block\'><h5 itemprop=\'name\'><a class=\'product-name\' href=\'{{ url('escort') }}/"+data.data[i].id+"\' title=\'"+data.data[i].name+"\' itemprop=\'url\'><span class=\'list-name\'>"+data.data[i].name+"<\/span><span class=\'grid-name\'>"+data.data[i].name+"<\/span><\/a></h5><div class=\'content_price\'><span class=\'price product-price product-price-new\'>"+data.data[i].phone+"<\/span><\/div><\/div><\/div><\/li>\r\n");
                         }else{
                          $(".escorts-on-travel-loader").html("<li><h4>There's no data available for this category</h4></li>");
                         }  
                        }   
                          
                        }else if(data.success == false){
                          $(".escorts-on-travel-loader").append(data.message);
                        }else{
                          $(".escorts-on-travel-loader").append(data);
                        }
                          
                     }
                     });
                     
                   }
                   
                   
                   $current_page = 2;
                   $(window).scroll(function(){
                   if($(window).scrollTop()+window.innerHeight == $(document).height()){
                   $start = ($current_page * $record_per_page) - $record_per_page;
                    if($current_page <= $numer_of_page){
                     firstColum($record_per_page, $start);
                     
                    }
                   }
                   });
                   
                   
                   setInterval(function(){
                   
                   },130000);
                   
                   setInterval(function(){
                   
                   },120000);
            
            
                   $(".open-location-form").click(function(e){
                        $('.location-info').show();
                        $(this).hide();
                       
                   });
            
                  $(".open-info-form").click(function(e){
                       $(".hide-statistics-field").show();
                       $(this).hide();
                  });
                  $(".open-charges-form").click(function(e){
                      $('.hide-charges-field').show();
                      $(this).hide();
                  });
                  $("#travel").on('change', function(e){
                      if($(this).val() == 1){
                      $("#travel-charge").show();
                      }else{
                      $("#travel-charge").val("");
                      $("#travel-charge").hide();
                      }
                  });
                   
              });
              </script>
            
            <script>
              $(document).ready(function(){
                var elem = $('.home-parallax-2 div');
                if (elem.length) {
                  $('body').append('    <div class=\"rd-parallax rd-parallax-1\">\r\n                                                              <div class=\"rd-parallax-layer top-z-index\" data-offset=\"0\" data-speed=\"0.1\" data-type=\"media\" data-fade=\"false\" data-direction=\"normal\"><div class=\"text-layout text-left\"><h3>The world\'s sexiest selection!<\/h3>\r\n<h2>Turn your fantasies into reality<\/h2>\r\n<p class=\"btn-wrap\"><a class=\"btn btn-default btn-md\" href=\"index.php?id_category=93&amp;controller=category\">Shop now<\/a><\/p><\/div><\/div>\r\n                                                            <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"/prestashop_62339_v1/img/cms/home-parallax-2.jpg\" data-direction=\"normal\"><\/div>\r\n                        <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"normal\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n    <\/div>\r\n  ');
                  var wrapper = $('.rd-parallax-1');
                  elem.before(wrapper);
                  $('.rd-parallax-1 .parallax-main-layout').replaceWith(elem);
                  win = $(window);
                          }
              });
            </script>
            <script>
              $(document).ready(function(){
                var elem = $('.home-parallax-1 div');
                if (elem.length) {
                  $('body').append('    <div class=\"rd-parallax rd-parallax-2\">\r\n                                                              <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"/prestashop_62339_v1/img/cms/parallax-home-1.jpg\" data-direction=\"normal\"><\/div>\r\n                                                            <div class=\"rd-parallax-layer top-z-index\" data-offset=\"0\" data-speed=\"0.1\" data-type=\"media\" data-fade=\"false\" data-direction=\"normal\"><div class=\"text-layout center\"><h3>A Variety of glamorous lingerie<\/h3>\r\n<h2>Choose from an exclusive collection of intimate apparel<\/h2>\r\n<p class=\"btn-wrap\"><a class=\"btn btn-secondary-3 btn-md\" href=\"index.php?id_category=91&amp;controller=category\">Shop now<\/a><\/p><\/div><\/div>\r\n                        <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"normal\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n    <\/div>\r\n  ');
                  var wrapper = $('.rd-parallax-2');
                  elem.before(wrapper);
                  $('.rd-parallax-2 .parallax-main-layout').replaceWith(elem);
                  win = $(window);
                          }
              });
            
              
            </script>
            <script>
              $(document).ready(function(){
                $(window).on('load', function(){
                  jQuery.RDParallax();
                  $('.rd-parallax-layer video').each(function(){
                    $(this)[0].play();
                  });
                });
              });
            </script>

<script type="text/javascript">
  var PS_DISPLAY_JQZOOM = false;
  var TMPRODUCTZOOMER_LIVE_MODE = 1;
  var TMPRODUCTZOOMER_FANCY_BOX = 1;
  var TMPRODUCTZOOMER_EXTENDED_SETTINGS = 1;
  var TMPRODUCTZOOMER_IMAGE_CHANGE_EVENT = false;
  var TMPRODUCTZOOMER_ZOOM_LEVEL = 1;
  var TMPRODUCTZOOMER_ZOOM_SCROLL = false;
  var TMPRODUCTZOOMER_ZOOM_SCROLL_INCREMENT = 0.1;
  var TMPRODUCTZOOMER_ZOOM_MIN_LEVEL = false;
  var TMPRODUCTZOOMER_ZOOM_MAX_LEVEL = false;
  var TMPRODUCTZOOMER_ZOOM_EASING = 1;
  var TMPRODUCTZOOMER_ZOOM_EASING_AMOUNT = 12;
  var TMPRODUCTZOOMER_ZOOM_LENS_SIZE = 200;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_WIDTH = 400;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_HEIGHT = 400;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_OFFSET_X = false;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_OFFSET_Y = false;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_POSITION = 1;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_BG_COLOUR = '#ffffff';
  var TMPRODUCTZOOMER_ZOOM_FADE_IN = 200;
  var TMPRODUCTZOOMER_ZOOM_FADE_OUT = 200;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_FADE_IN = 200;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_FADE_OUT = 200;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_TINT_FADE_IN = 200;
  var TMPRODUCTZOOMER_ZOOM_WINDOW_TINT_FADE_OUT = 200;
  var TMPRODUCTZOOMER_ZOOM_BORDER_SIZE = 4;
  var TMPRODUCTZOOMER_ZOOM_SHOW_LENS = 1;
  var TMPRODUCTZOOMER_ZOOM_BORDER_COLOR = '#888888';
  var TMPRODUCTZOOMER_ZOOM_LENS_BORDER_SIZE = 1;
  var TMPRODUCTZOOMER_ZOOM_LENS_BORDER_COLOR = '#000000';
  var TMPRODUCTZOOMER_ZOOM_LENS_SHAPE = 'round';
  var TMPRODUCTZOOMER_ZOOM_TYPE = 'lens';
  var TMPRODUCTZOOMER_ZOOM_CONTAIN_LENS_ZOOM = 1;
  var TMPRODUCTZOOMER_ZOOM_LENS_COLOUR = '#ffffff';
  var TMPRODUCTZOOMER_ZOOM_LENS_OPACITY = 0.4;
  var TMPRODUCTZOOMER_ZOOM_TINT = false;
  var TMPRODUCTZOOMER_ZOOM_TINT_COLOUR = '#333333';
  var TMPRODUCTZOOMER_ZOOM_TINT_OPACITY = 0.4;
  var TMPRODUCTZOOMER_ZOOM_CURSOR = 'default';
  var TMPRODUCTZOOMER_ZOOM_RESPONSIVE = 1;
var TMPRODUCTZOOMER_IS_MOBILE = false;
</script>
<script type="text/javascript">
  var TM_PLG_TYPE = 'rollover';
  var TM_PLG_ROLLOVER_ANIMATION = 'opacity';
  var TM_PLG_DISPLAY_ITEMS = 20;
  var TM_PLG_INFINITE = 1;
  var TM_PLG_USE_PAGER = false;
  var TM_PLG_USE_CONTROLS = false;
  var TM_PLG_USE_THUMBNAILS = 1;
  var TM_PLG_USE_CAROUSEL = 1;
  var TM_PLG_USE_CONTROLS_THUMBNAILS = false;
  var TM_PLG_USE_PAGER_THUMBNAILS = false;
  var TM_PLG_CENTERING_THUMBNAILS = 1;
  var TM_PLG_POSITION_THUMBNAILS = 'horizontal';
  var TM_PLG_NB_THUMBNAILS = 3;
  var TM_PLG_NB_SCROLL_THUMBNAILS = 1;
</script>

<script src="{{ asset('js/app/login-ajax.js') }}"></script>

<!-- MOTOSLIDER HEADER -->
    <style type="text/css">
        .mpsl-layer.mpsl-btn-blue, #footer .mpsl-layer.mpsl-btn-blue{background-color:#20b9d5;color:#ffffff;font-size:18px;font-family:Open Sans;text-shadow:0px 1px 0px #06879f;padding-top:12px;padding-right:28px;padding-bottom:13px;padding-left:28px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;text-decoration: none;-webkit-box-shadow: 0px 2px 0px 0px #06879f;-moz-box-shadow: 0px 2px 0px 0px #06879f;box-shadow: 0px 2px 0px 0px #06879f;}.mpsl-layer.mpsl-btn-blue, #footer .mpsl-layer.mpsl-btn-blue:hover{}.mpsl-layer.mpsl-btn-green, #footer .mpsl-layer.mpsl-btn-green{background-color:#58cf6e;color:#ffffff;font-size:18px;font-family:Open Sans;text-shadow:0px 1px 0px #17872d;padding-top:12px;padding-right:28px;padding-bottom:13px;padding-left:28px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;text-decoration: none;-webkit-box-shadow: 0px 2px 0px 0px #2ea044;-moz-box-shadow: 0px 2px 0px 0px #2ea044;box-shadow: 0px 2px 0px 0px #2ea044;}.mpsl-layer.mpsl-btn-green, #footer .mpsl-layer.mpsl-btn-green:hover{}.mpsl-layer.mpsl-btn-red, #footer .mpsl-layer.mpsl-btn-red{background-color:#e75d4a;color:#ffffff;font-size:18px;font-family:Open Sans;text-shadow:0px 1px 0px #c03826;padding-top:12px;padding-right:28px;padding-bottom:13px;padding-left:28px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;text-decoration: none;-webkit-box-shadow: 0px 2px 0px 0px #cd3f2b;-moz-box-shadow: 0px 2px 0px 0px #cd3f2b;box-shadow: 0px 2px 0px 0px #cd3f2b;}.mpsl-layer.mpsl-btn-red, #footer .mpsl-layer.mpsl-btn-red:hover{}.mpsl-layer.mpsl-txt-header-dark, #footer .mpsl-layer.mpsl-txt-header-dark{color:#000000;font-size:48px;font-family:Open Sans;font-weight:300;letter-spacing: -0.025em;}.mpsl-layer.mpsl-txt-header-dark, #footer .mpsl-layer.mpsl-txt-header-dark:hover{}.mpsl-layer.mpsl-txt-header-white, #footer .mpsl-layer.mpsl-txt-header-white{color:#ffffff;font-size:48px;font-family:Open Sans;font-weight:300;letter-spacing: -0.025em;}.mpsl-layer.mpsl-txt-header-white, #footer .mpsl-layer.mpsl-txt-header-white:hover{}.mpsl-layer.mpsl-txt-sub-header-dark, #footer .mpsl-layer.mpsl-txt-sub-header-dark{background-color:rgba(0, 0, 0, 0.6);color:#ffffff;font-size:26px;font-family:Open Sans;font-weight:300;padding-top:14px;padding-right:14px;padding-bottom:14px;padding-left:14px;}.mpsl-layer.mpsl-txt-sub-header-dark, #footer .mpsl-layer.mpsl-txt-sub-header-dark:hover{}.mpsl-layer.mpsl-txt-sub-header-white, #footer .mpsl-layer.mpsl-txt-sub-header-white{background-color:rgba(255, 255, 255, 0.6);color:#000000;font-size:26px;font-family:Open Sans;font-weight:300;padding-top:14px;padding-right:14px;padding-bottom:14px;padding-left:14px;}.mpsl-layer.mpsl-txt-sub-header-white, #footer .mpsl-layer.mpsl-txt-sub-header-white:hover{}.mpsl-layer.mpsl-txt-dark, #footer .mpsl-layer.mpsl-txt-dark{color:#000000;font-size:18px;font-family:Open Sans;font-weight:normal;line-height:30px;text-shadow:0px 1px 0px rgba(255, 255, 255, 0.45);}.mpsl-layer.mpsl-txt-dark, #footer .mpsl-layer.mpsl-txt-dark:hover{}.mpsl-layer.mpsl-txt-white, #footer .mpsl-layer.mpsl-txt-white{color:#ffffff;font-size:18px;font-family:Open Sans;font-weight:normal;line-height:30px;text-shadow:0px 1px 0px rgba(0, 0, 0, 0.45);}.mpsl-layer.mpsl-txt-white, #footer .mpsl-layer.mpsl-txt-white:hover{}.mpsl-layer.mpsl-preset-1, #footer .mpsl-layer.mpsl-preset-1{font-size:15px;font-family:Raleway;font-weight:normal;letter-spacing:5.2px;line-height:22px;text-align:left;text-transform: uppercase;}.mpsl-layer.mpsl-preset-1, #footer .mpsl-layer.mpsl-preset-1:hover{}.mpsl-layer.mpsl-preset-2, #footer .mpsl-layer.mpsl-preset-2{color:rgb(34, 34, 34);font-size:72px;font-family:Playfair Display;font-weight:normal;letter-spacing:-2.4px;line-height:80px;text-transform: none;}.mpsl-layer.mpsl-preset-2, #footer .mpsl-layer.mpsl-preset-2:hover{}.mpsl-layer.mpsl-preset-3, #footer .mpsl-layer.mpsl-preset-3{color:rgb(255, 255, 255);font-size:14px;font-family:Arimo;font-weight:700;letter-spacing:1.4px;line-height:16px;text-align:center;border-style:solid;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-color:rgb(255, 255, 255);padding-top:20px;padding-right:50px;padding-bottom:20px;padding-left:50px;-webkit-border-radius:35px;-moz-border-radius:35px;border-radius:35px;text-transform: uppercase;}.mpsl-layer.mpsl-preset-3, #footer .mpsl-layer.mpsl-preset-3:hover{border-style:solid;}.mpsl-layer.mpsl-preset-4, #footer .mpsl-layer.mpsl-preset-4{background-color:rgb(255, 255, 255);font-size:14px;font-family:Arimo;font-weight:700;letter-spacing:1.4px;line-height:16px;text-align:center;border-style:none;border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;border-color:rgb(255, 255, 255);padding-top:22px;padding-right:50px;padding-bottom:22px;padding-left:50px;-webkit-border-radius:32px;-moz-border-radius:32px;border-radius:32px;text-transform: uppercase;}.mpsl-layer.mpsl-preset-4, #footer .mpsl-layer.mpsl-preset-4:hover{}.mpsl-layer.mpsl-private-preset-12, #footer .mpsl-layer.mpsl-private-preset-12{padding-top:20px;padding-right:58px;padding-bottom:20px;padding-left:58px;}.mpsl-layer.mpsl-private-preset-12, #footer .mpsl-layer.mpsl-private-preset-12:hover{}.mpsl-layer.mpsl-private-preset-23, #footer .mpsl-layer.mpsl-private-preset-23{color:rgb(130, 121, 118);font-size:16px;font-family:Raleway;font-weight:normal;line-height:26px;text-align:left;}.mpsl-layer.mpsl-private-preset-23, #footer .mpsl-layer.mpsl-private-preset-23:hover{}.mpsl-layer.mpsl-private-preset-16, #footer .mpsl-layer.mpsl-private-preset-16{padding-top:20px;padding-right:58px;padding-bottom:20px;padding-left:58px;}.mpsl-layer.mpsl-private-preset-16, #footer .mpsl-layer.mpsl-private-preset-16:hover{}.mpsl-layer.mpsl-private-preset-18, #footer .mpsl-layer.mpsl-private-preset-18{padding-top:20px;padding-right:58px;padding-bottom:20px;padding-left:58px;}.mpsl-layer.mpsl-private-preset-18, #footer .mpsl-layer.mpsl-private-preset-18:hover{}.mpsl-layer.mpsl-private-preset-24, #footer .mpsl-layer.mpsl-private-preset-24{color:rgb(130, 121, 118);font-size:16px;font-family:Raleway;font-weight:normal;line-height:26px;text-align:left;}.mpsl-layer.mpsl-private-preset-24, #footer .mpsl-layer.mpsl-private-preset-24:hover{}.mpsl-layer.mpsl-private-preset-25, #footer .mpsl-layer.mpsl-private-preset-25{font-size:16px;font-family:Raleway;font-weight:normal;line-height:26px;text-align:left;}.mpsl-layer.mpsl-private-preset-25, #footer .mpsl-layer.mpsl-private-preset-25:hover{}
    </style>

<link id="mpsl-core-css" href="{{ asset('css/motoslider.css') }}" rel="stylesheet" type="text/css" media="all">
<!-- END OF MOTOSLIDER HEADER -->

<style data-olark="true" type="text/css">.olark-key,#hbl_code,#olark-data{display: none !important;}</style><style data-olark="true" type="text/css">@media print {#habla_beta_container_do_not_rely_on_div_classes_or_names {display: none !important}}</style><link data-olark="true" rel="stylesheet" href="{{ asset('css/theme(1).css') }}" type="text/css">
<script src="{{ asset('js/motoslider.js') }}"></script>

<style type="text/css">.fancybox-margin{margin-right:17px;}</style><link rel="stylesheet" href="data:text/css;charset=utf-8;base64,Y2xvdWRmbGFyZS1hcHBbYXBwLWlkPSJhLWJldHRlci1icm93c2VyIl0gewogIGRpc3BsYXk6IGJsb2NrOwogIGJhY2tncm91bmQ6ICM0NTQ4NGQ7CiAgY29sb3I6ICNmZmY7CiAgbGluZS1oZWlnaHQ6IDEuNDU7CiAgcG9zaXRpb246IGZpeGVkOwogIHotaW5kZXg6IDkwMDAwMDAwOwogIHRvcDogMDsKICBsZWZ0OiAwOwogIHJpZ2h0OiAwOwogIHBhZGRpbmc6IC41ZW0gMWVtOwogIHRleHQtYWxpZ246IGNlbnRlcjsKICAtd2Via2l0LXVzZXItc2VsZWN0OiBub25lOwogICAgIC1tb3otdXNlci1zZWxlY3Q6IG5vbmU7CiAgICAgIC1tcy11c2VyLXNlbGVjdDogbm9uZTsKICAgICAgICAgIHVzZXItc2VsZWN0OiBub25lOwp9CgpjbG91ZGZsYXJlLWFwcFthcHAtaWQ9ImEtYmV0dGVyLWJyb3dzZXIiXVtkYXRhLXZpc2liaWxpdHk9ImhpZGRlbiJdIHsKICBkaXNwbGF5OiBub25lOwp9CgpjbG91ZGZsYXJlLWFwcFthcHAtaWQ9ImEtYmV0dGVyLWJyb3dzZXIiXSBjbG91ZGZsYXJlLWFwcC1tZXNzYWdlIHsKICBkaXNwbGF5OiBibG9jazsKfQoKY2xvdWRmbGFyZS1hcHBbYXBwLWlkPSJhLWJldHRlci1icm93c2VyIl0gYSB7CiAgdGV4dC1kZWNvcmF0aW9uOiB1bmRlcmxpbmU7CiAgY29sb3I6ICNlYmViZjQ7Cn0KCmNsb3VkZmxhcmUtYXBwW2FwcC1pZD0iYS1iZXR0ZXItYnJvd3NlciJdIGE6aG92ZXIsCmNsb3VkZmxhcmUtYXBwW2FwcC1pZD0iYS1iZXR0ZXItYnJvd3NlciJdIGE6YWN0aXZlIHsKICBjb2xvcjogI2RiZGJlYjsKfQoKY2xvdWRmbGFyZS1hcHBbYXBwLWlkPSJhLWJldHRlci1icm93c2VyIl0gY2xvdWRmbGFyZS1hcHAtY2xvc2UgewogIGRpc3BsYXk6IGJsb2NrOwogIGN1cnNvcjogcG9pbnRlcjsKICBmb250LXNpemU6IDEuNWVtOwogIHBvc2l0aW9uOiBhYnNvbHV0ZTsKICByaWdodDogLjRlbTsKICB0b3A6IC4zNWVtOwogIGhlaWdodDogMWVtOwogIHdpZHRoOiAxZW07CiAgbGluZS1oZWlnaHQ6IDE7Cn0KCmNsb3VkZmxhcmUtYXBwW2FwcC1pZD0iYS1iZXR0ZXItYnJvd3NlciJdIGNsb3VkZmxhcmUtYXBwLWNsb3NlOmFjdGl2ZSB7CiAgLXdlYmtpdC10cmFuc2Zvcm06IHRyYW5zbGF0ZVkoMXB4KTsKICAgICAgICAgIHRyYW5zZm9ybTogdHJhbnNsYXRlWSgxcHgpOwp9CgpjbG91ZGZsYXJlLWFwcFthcHAtaWQ9ImEtYmV0dGVyLWJyb3dzZXIiXSBjbG91ZGZsYXJlLWFwcC1jbG9zZTpob3ZlciB7CiAgb3BhY2l0eTogLjllbTsKICBjb2xvcjogI2ZmZjsKfQo="><style data-olark="true" type="text/css">.olark-key,#hbl_code,#olark-data{display: none !important;}</style><style data-olark="true" type="text/css">@media print {#habla_beta_container_do_not_rely_on_div_classes_or_names {display: none !important}}</style><link data-olark="true" rel="stylesheet" href="{{ asset('css/theme(1).css') }}" type="text/css"></head>
  
  </head>
  <body id="product" class="product product-8 product-begonia-slip category-2 category-home hide-left-column hide-right-column lang_en  one-column">

  @include('inc.header1')


  <div class="columns-container">
    <div id="columns">
                  <!-- Breadcrumb -->



<!-- /Breadcrumb -->
                <div id="slider_row">
        <div id="top_column" class="center_column">
                                    </div>
        
      </div>
      <div class="container">
        <div class="row">
          <div class="large-left col-sm-12">
            <div class="row">
              <div id="center_column" class="center_column col-xs-12 col-sm-12 accordionBox">

<!--Replaced theme 1 -->



            <div itemscope="" itemtype="https://schema.org/Product">
    
        
   
<meta itemprop="url" content="{{ url('escort/'.$users[0]->id)}}">
<meta itemprop="name" content="{{ $users[0]->name }}">

<div class="primary_block row">    
  
        <!-- left infos-->
  <div class="pb-left-column col-sm-6 col-md-6 col-lg-6">
    <span id="prev-img"></span>
    <span id="next-img"></span>
    <!-- product img-->
    @if ($users[0]->img != "")    
    <div id="image-block" class="clearfix is_caroucel">
          
          <span id="view_full_size">
    <img id="bigpic" itemprop="image" src="{{ asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img) }}" title="{{ $users[0]->name }}" alt="{{ $users[0]->name }}" width="800" height="800">
                              <span class="span_link no-print">View larger</span>
                                      </span>
              </div> <!-- end image-block -->
                 
             @else
             
             <div id="image-block" class="clearfix is_caroucel">
          
              <span id="view_full_size">
        <img id="bigpic" itemprop="image" src="{{ asset('storage/img/users/default.png') }}" title="{{ $users[0]->name }}" alt="{{ $users[0]->name }}" width="800" height="800">
                                  <span class="span_link no-print">View larger</span>
                                          <form id="profile-picture-upload" action="" method="POST" enctype="multipart/form-data">
                                           <input type="file" id="picture" name="picture" title="Browse for your profile photo" />
                                           <button type="submit" title="Upload profile picture">Upload</button> 
                                          </form>
                                          </span>
                  </div> <!-- end image-block -->
             
             @endif

              <!-- thumbnails -->


      <div id="views_block-1" class="clearfix">
                      <a id="view_scroll_left" class="disabled" title="Other views" href="javascript:{}">
            Previous
          </a>
                    <div id="thumbs_list" style="height: 282.333px;">
          <ul id="thumbs_list_frame" style="width: 62.8333px; height: 436px;">
              @if ($users[0]->img != "") 
            <li id="thumbnail_151">
                  <a href="{{ asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img) }}" data-fancybox-group="other-views" class="" title="Bustiers Heritage Corset">
                    <img class="img-responsive" id="thumb_151" src="{{ asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img) }}" alt="Bustiers Heritage Corset" title="Bustiers Heritage Corset" height="122" width="122" itemprop="image">
                  </a>
                </li>
                @endif
                @if ($users[0]->verify_img != "")   
                <li id="thumbnail_150">
                  <a href="{{ asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->verify_img) }}" data-fancybox-group="other-views" class="" title="Bustiers Heritage Corset">
                    <img class="img-responsive" id="thumb_150" src="{{ asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->verify_img) }}" alt="Bustiers Heritage Corset" title="Bustiers Heritage Corset" height="122" width="122" itemprop="image">
                  </a>
                </li>
                @endif
                  
                                            </ul>
        </div> <!-- end thumbs_list -->
                      <a id="view_scroll_right" title="Other views" href="javascript:{}">
            Next
          </a>
                  </div>
      <!-- end views-block -->


      <!-- end thumbnails -->
                      <p class="resetimg clear no-print">
        <span id="wrapResetImages" style="display: none;">
          
        </span>
      </p>
          </div>
  <!-- center infos -->
  <div class="pb-right-column col-sm-6 col-md-6 col-lg-6">
    <div class="product-info-line">
                
                  <p id="product_condition">
            <span class="editable" style="font-size: 20px !important;"><a href="phone:{{$users[0]->phone}}">{{$users[0]->phone}}</a></span>
                      </p>
                            <!-- number of item in stock -->
              </div>
                        
    <h1 itemprop="name">{{ $users[0]->name }}</h1>
    <!-- availability or doesntExist -->
    <div>
      <p id="availability_statut">
        
        <span id="availability_value" class="label label-danger">Escort Location</span>
      </p>
      @if(Auth::user())
<form id="location-form" action="" method="POST">
      <ul>

        <li>
         <span class="entry-label labeled">Location:</span><span class="display-location">{{$users[0]->location}}</span>
         <span class="location-info" style="display: none">
        <input type="text" id="location" name="location" class="form-control" placeholder="Enter your location" />

        <button type="submit">Update<i class="fa fa-upload"></i></button>
         </span><span id="location-update-status"></span>
         @if ($users[0]->id == Auth::user()->id)
         <a data-toggle="tab" href="#" class="open-location-form" title="Add location"><i class="fa fa-edit"></i>Edit</a> 
         @endif
         
        </li>
      
       </ul>
</form>    
 @else
 <ul>

  <li>
   <span class="entry-label labeled">Location:</span><span class="display-location">{{$users[0]->location}}</span>
   <span class="location-info" style="display: none"> 
  </li>

 </ul> 
 @endif
 <p id="availability_statut">
        
  <span id="availability_value" class="label label-danger">Additional Information Bar</span>
</p>


@if(Auth::user())
<form id="statistic-form" action="" method="POST">
<ul>
  @if ($users[0]->id == Auth::user()->id)
      <li class="statistic-editor-link"><a data-toggle="tab" href="#" class="open-info-form" title="Add info">Add info<i class="fa fa-edit"></i></a></li>
  @endif  
      <li>
         <span class="entry-label labeled">Body Type:</span> <span class="body-type-element"> </span><span class="hide-statistics-field" style="display: none;">
           <select id="body-type" name="body-type">
           <option selected disabled value="">Select your body type</option>
           <option value="Chubby">Chubby</option>
           <option value="Curvy">Curvy</option>
           <option value="Slim">Slim</option>
           </select></span>
        </li>
      
        <li>
          <span class="entry-label labeled">Height:</span> <span class="height-element"> </span><span class="hide-statistics-field" style="display: none;"><input type="text" id="height" name="height" class="form-control" value="" placeholder="Height(5.9ft)" /></span>
         </li>
      
         <li>
          <span class="entry-label labeled">Sexual Orientation:</span><span class="sexual-element"> </span><span class="hide-statistics-field" style="display: none;">
            <select id="sexual" name="sexual">
            <option selected disabled value="">Sexual Orientation</option>
            <option value="Straight">Straight</option>
            <option value="Bisexual">Bisexual</option>
            <option value="Same Sex">Same Sex</option>
            </select></span>
         </li>
      
         <li>
          <span class="entry-label labeled">Ethnicity:</span><span class="ethnic-element"> </span><span class="hide-statistics-field" style="display: none;">
            <select id="ethnic" name="ethnic">
            <option selected disabled value="">Your ethnicity</option>
            <option value="White">White</option>
            <option value="Asian">Asian</option>
            <option value="African">African</option>
            </select></span>
         </li>
      
         <li><span class="hide-statistics-field" style="display: none;"><button type="submit">Submit<i class="fa fa-upload"></i></button></span><span id="statistic-update-status"></span></li>
      
       </ul>
</form>   
@else

<ul>
    
      <li>
         <span class="entry-label labeled">Body Type:</span> <span class="body-type-element"> </span>
        
        </li>
      
        <li>
          <span class="entry-label labeled">Height:</span> <span class="height-element"> </span>
         
        </li>
      
         <li>
          <span class="entry-label labeled">Sexual Orientation:</span><span class="sexual-element"> </span>
          
         </li>
      
         <li>
          <span class="entry-label labeled">Ethnicity:</span><span class="ethnic-element"> </span>
          
         </li>
      
         
      
       </ul>

@endif
    </div>

              <!-- add to cart form-->

 <div>
  <p id="availability_statut">
    
    <span id="availability_value" class="label label-danger">Cost Charges</span>
  </p>
  @if(Auth::user())
<form id="charges-form" action="" method="POST">
  
   <ul>
    @if ($users[0]->id == Auth::user()->id)
<li><a data-toggle="tab" href="#" class="open-charges-form">Add Info<i class="fa fa-edit"></i></a></li>
@endif    
<li>
     <span class="labeled">Short time:</span><span class="short-time-element"> </span><span class="hide-charges-field" style="display: none"><input type="number" id="short-time" name="short-time" class="form-control" value="" placeholder="Shorttime Charges" /></span>
    </li>
  
    <li>
      <span class="labeled">Over night:</span><span class="over-night-element"> </span><span class="hide-charges-field" style="display: none"><input type="number" id="over-night" name="over-night" class="form-control" value="" placeholder="Over Night Charges" /></span>
     </li>
  
     <li>
      <span class="labeled">Weekend:</span><span class="weekend-element"> </span><span class="hide-charges-field" style="display: none"><input type="number" id="weekend" name="weekend" class="form-control" value="" placeholder="Weekend Charges" /></span>
     </li>
  
     <li>
      <span class="labeled">Travel:</span><span class="travel-element"> </span><span class="hide-charges-field" style="display: none">
      <select id="travel">
      <option selected disabled>Ready to travel?</option>
      <option value="1">Yes</option>
      <option value="0">No</option> 
      </select> <input type="number" id="travel-charge" name="travel-charge" class="form-control" style="display: none" value="" placeholder="Travelling charges" /> </span>
     </li>
    
     <li><span class="hide-charges-field" style="display: none"><button type="submit">Submit<i class="fa fa-upload"></i></button></span><span id="charges-update-status"></span></li>
  
   </ul>
</form>    
@else
<ul>
    
<li>
   <span class="labeled">Short time:</span><span class="short-time-element"> </span>
  </li>

  <li>
    <span class="labeled">Over night:</span><span class="over-night-element"> </span>
   </li>

   <li>
    <span class="labeled">Weekend:</span><span class="weekend-element"> </span>
   </li>

   <li>
    <span class="labeled">Travel:</span><span class="travel-element"> </span>
   </li>
  
   

 </ul> 
@endif
</div>
  
    <div class="extra-right">  

</div>      </div>
  <!-- end center infos-->
</div> <!-- end primary_block -->
      <div class="product-info-container">
              <div class="clearfix product-information">
        <ul class="product-info-tabs nav nav-stacked">
                          <li class="product-description-tab active"><a data-toggle="tab" href="{{ url('escort/'.$users[0]->id) }}?id_product=9&amp;controller=product&amp;id_lang=1#product-description-tab-content">About info</a></li>
                                                      <li class="product-features-tab"><a data-toggle="tab" href="{{ url('escort/'.$users[0]->id) }}?id_product=9&amp;controller=product&amp;id_lang=1#product-features-tab-content">Media Files</a></li>
                                        

        </ul>
        <div class="tab-content">
                          <h3 class="page-product-heading active">About info</h3>
            <div id="product-description-tab-content" class="product-description-tab-content tab-pane active">
              <div id="show-info" class="rte">

                {{$users[0]->about}}

                @if(Auth::user())

                @if ($users[0]->id == Auth::user()->id)
<a data-toggle="tab" href="#" class="open-about-form">Add Info<i class="fa fa-edit"></i></a>
@endif    

                @endif

</div>
<form id="about-form" style="display: none">
  <h4>In (300) words max describe yourself.</h4>
<textarea id="about-editor" placeholder="Write a brief info about yourself in 300 characters max" maxlength="300"> {{$users[0]->about}}</textarea>
 
<button id="submitNewMessage" type="submit" class="btn btn-default btn-sm">
  <span>Submit</span>
</button> <span class="alert alert-danger error-check" style="display: none"></span> <span class="alert alert-success success-check" style="display: none"></span>     
</form> 
</div>
                        <!-- quantity discount -->
                                        <!-- Data sheet -->
            <h3 class="page-product-heading">Media Files</h3>
            <div id="product-features-tab-content" class="product-features-tab-content tab-pane">
             All the media file here!
            </div>
            <!--end Data sheet -->
                                        
        
            
    <!--HOOK_PRODUCT_TAB -->
    <section class="page-product-box">
      <h3 id="#idTab5" class="idTabHrefShort page-product-heading">Reviews</h3>
        
<div id="idTab5">
<div id="product_comments_block_tab">
                        <div class="comment row" itemprop="review" itemscope="" itemtype="https://schema.org/Review">
        <div class="comment_author col-sm-3">
          <span>Grade&nbsp;</span>
          <div class="star_content clearfix" itemprop="reviewRating" itemscope="" itemtype="https://schema.org/Rating">
                                                  <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star star_on"></div>
                                                                    <div class="star"></div>
                                              <meta itemprop="worstRating" content="0">
            <meta itemprop="ratingValue" content="4">
            <meta itemprop="bestRating" content="5">
          </div>
          <div class="comment_author_infos">
            <strong itemprop="author">Test T</strong>
            <em>2015-05-12 10:39:08</em>
          </div>
        </div> <!-- .comment_author -->

        <div class="comment_details col-sm-9">
          <h6 class="title_block">Guys, you rock!</h6>
          <p itemprop="reviewBody">I wanted to say thank you for the amazing product and for the fast processing and delivery. It was impressive, you weren't kidding. I was surprised with such an excellent quality...My family is very happy. I would definitely use this site again and again and recommend it to others.</p>
          <ul>
                                          </ul>
        </div><!-- .comment_details -->
      </div> <!-- .comment -->
                      </div> <!-- #product_comments_block_tab -->
</div>

<!-- Fancybox -->
<div style="display: block;">
<div id="new_comment_form">
<form id="id_new_comment_form" action="https://ld-prestashop.template-help.com/prestashop_62339_v1/index.php?id_product=9&amp;controller=product&amp;id_lang=1#">
  <h2 class="page-subheading">
    Write a review
  </h2>
  <div class="row">
              <div class="product clearfix col-xs-12 col-sm-6">
        
        <div class="product_desc">
          <p class="product_name">
            <strong>
              @foreach ($settings as $setting)
                  {{ $setting->site_name }}
              @endforeach

            </strong>
          </p>
          @foreach ($contents as $content)
              @if ($content->name == "escort-comment-field")
                  {{$content->value}}
              @endif
          @endforeach
</div>
      </div>
            <div class="new_comment_form_content col-xs-12 col-sm-6">
      <div id="new_comment_form_error" class="error alert alert-danger" style="display: none; padding: 15px 25px">
        <ul></ul>
      </div>
                  <ul id="criterions_list">
                          <li>
              <label>Quality:</label>
              <div class="star_content">
                <input type="hidden" name="criterion[1]" value="3"><div class="cancel"><a title="Cancel Rating"></a></div><div class="star star_on"><a title="1">1</a></div>
                <div class="star star_on"><a title="2">2</a></div>
                <div class="star star_on"><a title="3">3</a></div>
                <div class="star"><a title="4">4</a></div>
                <div class="star"><a title="5">5</a></div>
              </div>
              <div class="clearfix"></div>
            </li>
                      </ul>
                <label for="comment_title">
        Title: <sup class="required">*</sup>
      </label>
      <input id="comment_title" class="form-control" name="title" type="text" value="">
      <label for="content">
        Comment: <sup class="required">*</sup>
      </label>
      <textarea id="content" class="form-control" name="content"></textarea>
                <div id="new_comment_form_footer">
        <input id="id_product_comment_send" class="form-control" name="id_product" type="hidden" value="9">
        <p class="fl required"><sup>*</sup> Required fields</p>
        <p class="fr">
          <button id="submitNewMessage" name="submitMessage" type="submit" class="btn btn-default btn-sm">
            <span>Submit</span>
          </button>&nbsp;
          or&nbsp;
          <a class="closefb" href="https://ld-prestashop.template-help.com/prestashop_62339_v1/index.php?id_product=9&amp;controller=product&amp;id_lang=1#" title="Cancel">
            Cancel
          </a>
        </p>
        <div class="clearfix"></div>
      </div> <!-- #new_comment_form_footer -->
    </div>
  </div>
</form><!-- /end new_comment_form_content -->
</div>
</div>
<!-- End fancybox -->
    </section>
    <!--end HOOK_PRODUCT_TAB -->
  </div>

     
                          



              </div>

   

        </div> <!-- itemscope product wrapper -->



            </div><!-- #center_column -->
                        </div><!--.row-->
        </div><!--.large-left-->
                    </div><!-- .row -->
      </div><!-- .container -->
    </div><!-- #columns -->
                  </div><!-- .columns-container -->
<!-- Bootstrap WYSIHTML5 -->



                      @include('inc.footer1')
                      @endsection