      @extends('layouts.app1')

      @section('content')

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
	  <script src="{{ asset('js/tmhomepagecategorygallery.js') }}"></script>
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
	  <script src="{{ asset('js/slick.min.js') }}"></script>
	  <script src="{{ asset('js/arrive.min.js') }}"></script>
	  <script src="{{ asset('js/tmproductlistgallery.js') }}"></script>
	  <script src="{{ asset('js/themeconfiglink.js') }}"></script>
	  <script src="{{ asset('js/index.js') }}"></script>
	  

	  

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
		<!-- Page loader -->



		 <!-- END: Head -->
		 <body class="login">
			<div class="container sm:px-10">
				<div class="block xl:grid grid-cols-2 gap-4">
					<!-- BEGIN: Login Info -->
					<div class="hidden xl:flex flex-col min-h-screen">
						<a href="" class="-intro-x flex items-center pt-5">
							<img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
							<span class="text-white text-lg ml-3"> Mid<span class="font-medium">One</span> </span>
						</a>
						<div class="my-auto">
							<img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
							<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
								A few more clicks to 
								<br>
								sign in to your account.
							</div>
							<div class="-intro-x mt-5 text-lg text-white">Manage all your e-commerce accounts in one place</div>
						</div>
					</div>
					<!-- END: Login Info -->
					<!-- BEGIN: Login Form -->
					<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
						<div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
							<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
								Sign In
							</h2>
							<div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
							<div class="intro-x mt-8">
								<input type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email">
								<input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
							</div>
							<div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
								<div class="flex items-center mr-auto">
									<input type="checkbox" class="input border mr-2" id="remember-me">
									<label class="cursor-pointer select-none" for="remember-me">Remember me</label>
								</div>
								<a href="">Forgot Password?</a> 
							</div>
							<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
								<button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
								<button class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign up</button>
							</div>
							<div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
								By signin up, you agree to our 
								<br>
								<a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a> 
							</div>
						</div>
					</div>
					<!-- END: Login Form -->
				</div>
			</div>
			<!-- BEGIN: JS Assets-->
			<script src="dist/js/app.js"></script>

							
							

			
		
		@include('inc.footer1')
		@endsection