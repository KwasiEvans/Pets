// Main Background Slider Document
jQuery(function($){
        
        $.supersized({
            // Functionality
            slideshow               :   1,			// Slideshow on/off
            autoplay				:	1,			// Slideshow starts playing automatically
            start_slide             :   1,			// Start slide (0 is random)
            stop_loop				:	0,			// Pauses slideshow on last slide
            random					: 	0,			// Randomize slide order (Ignores start slide)
            slide_interval          :   5000,		// Length between transitions
            transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
            transition_speed		:	1000,		// Speed of transition
            new_window				:	1,			// Image links open in new window/tab
            pause_hover             :   0,			// Pause slideshow on hover
            keyboard_nav            :   1,			// Keyboard navigation on/off
            performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
            image_protect			:	1,			// Disables image dragging and right click with Javascript
                                                       
            // Size & Position						   
            min_width		        :   0,			// Min width allowed (in pixels)
            min_height		        :   0,			// Min height allowed (in pixels)
            vertical_center         :   1,			// Vertically center background
            horizontal_center       :   1,			// Horizontally center background
            fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
            fit_portrait         	:   1,			// Portrait images will not exceed browser height
            fit_landscape			:   0,			// Landscape images will not exceed browser width
                                                       
            // Components							
            slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
            thumb_links				:	1,			// Individual thumb links for each slide
            thumbnail_navigation    :   0,			// Thumbnail navigation
            slides 					:  	[			// Slideshow Images
                                                {image : 'images/keychain.jpg', title : '<h1>Keychain Productions</h1><h2>Using for souvenir, commercial promotion, gifts, advertising.We can make items according to clients requests</h2><span> Php 25 </span></p>',},
                                                {image : 'images/mug.jpg', title : '<h1>Mugs Productions.</h1><h2>GOOD FOR SOUVENIRS/GIVEAWAYS FOR BDAYS,WEDDING,CHRISTENING, ETC.</h2> <span> Php 100 </span> </p>',},
												{image : 'images/assorted product.jpg', title : '<h1>Assorted Product</h1><h2>Hello everyone! Genesis Print Stuff and Trading is engaged in printing of personalized items with the below products and services to offer. So far, our products and services cover a wide range of satisfactions for election campaign, company souvenirs, birthdays, reunion, sports, retreats, etc</h2></p>',}
										],
                                        
            // Theme Options			   
            progress_bar			:	1,			// Timer for each slide							
            mouse_scrub				:	0
            
        });   
    });



//GLOBAL

var curr_li;
var prev_li;

//MENU CLICK EVENT
$('#sidebarmenu li a, .custom_page').live('click', function(e) {	
	e.preventDefault();	
	api.playToggle();
	
	$("#bgOverlay ").css("display", "block").stop(true,true).animate({opacity:.9}, 850, 'easeOutCubic');
	   //animate slide caption
	 $("#slidecaption_wrapper").css("position","absolute").stop(true,true).animate({marginRight:'-500px'}, 750, 'easeOutCubic');
	 
	  //spalsh page
	 $("#splash_page").stop(true,true).animate({top:'-1600px'}, 750, 'easeOutCubic');

	var href = $(this).attr("href");			
	
	$('#sidebarmenu li a').removeClass("active");
	if(href!="#") { $(this).addClass("active"); }
	
	
	if(href == location.hash) {
	  return;	
	} else {		  
	  
		  if(location.hash=="#"||location.hash.length==0){			
			$("li#"+href).css({display:'block'}).stop(true,true).delay(450).animate({left:'0px'}, 750, 'easeOutCubic');
			location.hash = href;
		  } else {
			prev_li = $("li#"+location.hash);
			curr_li = $("li#"+href);
			location.hash = href;
			animatePage();
			
		  }
		  
	}

});


$('a').live('click', function(e) {
							  
	if(($(this).parents("#sidebarmenu").length==0) && ($(this).parents("#logo").length==0))
	{	
	  
	  var href = $(this).attr("href");
	  if(href=="#") {
		e.preventDefault();
		return; 
	  }	 
	}
});


//PAGE CLOSE EVENT
$('a.page_close').live('click', function(e) {
	closePage();
	document.location.hash="";
	fredCarouselSlider();
});


//PAGE ANIMATE FN
function animatePage() {

	 if(curr_li){
			 curr_li.css({display:'block'}).stop(true,true).delay(450).animate({left:'0px'}, 750, 'easeOutCubic');
			 
     }
    
	 if(prev_li){ 
    		 prev_li.stop(true,true).animate({left:'-750px'}, 400, 'easeInSine', function(){ $(this).css({display:'none'})});
     }

     // pf_carouFredSel();
}

//PAGE CLOSE ANIMATE FN
function closePage() {
	$('#ulcontent > li').stop(true,true).animate({left:'-750px'}, 400, 'easeInSine', function(){ $('#bgOverlay').stop(true,true).animate({opacity:0}, 850, 'easeOutCubic').css({display:'none'})});
	$("#splash_page").stop(true,true).animate({top:'40px'}, 850, 'easeOutCubic');
	api.playToggle();
	$("#slidecaption_wrapper").css("position","absolute").stop(true,true).animate({marginRight:'500px'}, 750, 'easeOutCubic');
	$('#sidebarmenu li a').removeClass("active");
}


//PAGE LOAD
function WIN_LOAD(){  
	$('#dvLoading').fadeOut(2000);
	var all_li = $('#ulcontent > li');
	all_li.css({'display':'none', left:'-750px'});

	if(location.hash=="" || location.hash.length==0) {
     //spalsh page
	 $("#splash_page").stop(true,true).animate({top:'40px'}, 850, 'easeOutCubic');
	 
	 //animate slide caption
	 $("#slidecaption_wrapper").css("position","absolute").stop(true,true).animate({marginRight:'500px'}, 750, 'easeOutCubic');
	 
	} else {
		$("#bgOverlay ").css("display", "block").stop(true,true).animate({opacity:.9}, 850, 'easeOutCubic');
		api.playToggle();		
		$("li#"+location.hash).css({display:'block'}).stop(true,true).delay(450).animate({left:'0px'}, 750, 'easeOutCubic', function(){   
		     $('#sidebarmenu li a').removeClass("active");	        
			 $("a[href='"+location.hash+"']").addClass("active");
																														 
         });
		 
	}
		

}

//REGISTER LOAD EVENT
function listen(evnt, elem, func) {
    if (elem.addEventListener)  
        elem.addEventListener(evnt,func,false);
    else if (elem.attachEvent) { 
        var r = elem.attachEvent("on"+evnt, func);
    return r;
    }
}

listen("load", window, WIN_LOAD);



function pf_carouFredSel()
{




}


//Fancy Box Jquery
$(document).ready(function() {
$("a.example6").fancybox({
'titlePosition'		: 'inside',
'overlayColor'		: '#000',
'overlayOpacity'	: 0.9
});
});


// fred carousel slider
$(function fredCarouselSlider() {
	//	Responsive layout, resizing the items
	$('.list_carousel').carouFredSel({
	responsive: true,
	auto: true,
	width: '100%',
	prev: '#prev3',
	next: '#next3',
	scroll: 1,
	items: {
	//width: 400,
	//	height: '30%',	//	optionally resize item-height
	visible: {
	min:3,
	max: 3
	}
	}
	});
});


// Portfolio hover
function portfoliohover()
{
	jQuery('.portfolio_list li, .list_carousel li').hover(
	function() {
		jQuery(this).find('span.roll').stop().animate({opacity:1},500);
		jQuery(this).find('img').css({opacity:.2});		
	},
	function() {
		jQuery(this).find('span.roll').stop().animate({opacity:0},500);
		jQuery(this).find('img').css({opacity:1})
	});
}
$(document).ready(function(){
	portfoliohover();
	fredCarouselSlider();
});