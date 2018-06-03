$ = jQuery;
(function() {
	"use strict";
	var BuzzstoreCore = {
		initialized: false,
		initialize: function() {
			if (this.initialized) return;
			this.initialized = true;
			this.build();
		},

		build: function() {
			// Owl Carousel
			this.initOwlCarousel();
			//Isotope Filter
			this.isotopeFilter();
			//Isotope Filter
			this.initBxSlider();
			//Setup WOW.js
			this.initWowSlider();			
			//Go to top animation
			this.goToTop();			
			//Fixed Header
			this.fixedHeader();			
		},

		initOwlCarousel: function(options) {			
			$(".enable-owl-carousel").each(function(i) {
				var $owl = $(this);				
				var navigationData = $owl.data('navigation');
				var paginationData = $owl.data('pagination');
				var singleItemData = $owl.data('single-item');
				var autoPlayData = $owl.data('auto-play');
				var transitionStyleData = $owl.data('transition-style');
				var mainSliderData = $owl.data('main-text-animation');
				var afterInitDelay = $owl.data('after-init-delay');
				var stopOnHoverData = $owl.data('stop-on-hover');
				var min600 = $owl.data('min600');
				var min800 = $owl.data('min800');
				var min1200 = $owl.data('min1200');
				
				$owl.owlCarousel({
					navigation : navigationData,
					pagination: paginationData,
					singleItem : singleItemData,
					autoPlay : autoPlayData,
					transitionStyle : transitionStyleData,
					stopOnHover: stopOnHoverData,
					navigationText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
					itemsCustom:[
						[0, 1],
						[600, min600],
						[800, min800],
						[1200, min1200]
					],
					afterInit: function(elem){
						if(mainSliderData){
							setTimeout(function(){
								$('.main-slider_zoomIn').css('visibility','visible').removeClass('zoomIn').addClass('zoomIn');
								$('.main-slider_fadeInLeft').css('visibility','visible').removeClass('fadeInLeft').addClass('fadeInLeft');
								$('.main-slider_fadeInLeftBig').css('visibility','visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
								$('.main-slider_fadeInRightBig').css('visibility','visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
							}, afterInitDelay);
						}
					},
					beforeMove: function(elem){
						if(mainSliderData){
							$('.main-slider_zoomIn').css('visibility','hidden').removeClass('zoomIn');
							$('.main-slider_slideInUp').css('visibility','hidden').removeClass('slideInUp');
							$('.main-slider_fadeInLeft').css('visibility','hidden').removeClass('fadeInLeft');
							$('.main-slider_fadeInRight').css('visibility','hidden').removeClass('fadeInRight');
							$('.main-slider_fadeInLeftBig').css('visibility','hidden').removeClass('fadeInLeftBig');
							$('.main-slider_fadeInRightBig').css('visibility','hidden').removeClass('fadeInRightBig');
						}
					},
					afterMove: sliderContentAnimate,
					afterUpdate: sliderContentAnimate,
				});
			});
			function sliderContentAnimate(elem){
				var $elem = elem;
				var afterMoveDelay = $elem.data('after-move-delay');
				var mainSliderData = $elem.data('main-text-animation');
				if(mainSliderData){
					setTimeout(function(){
						$('.main-slider_zoomIn').css('visibility','visible').addClass('zoomIn');
						$('.main-slider_slideInUp').css('visibility','visible').addClass('slideInUp');
						$('.main-slider_fadeInLeft').css('visibility','visible').addClass('fadeInLeft');
						$('.main-slider_fadeInRight').css('visibility','visible').addClass('fadeInRight');
						$('.main-slider_fadeInLeftBig').css('visibility','visible').addClass('fadeInLeftBig');
						$('.main-slider_fadeInRightBig').css('visibility','visible').addClass('fadeInRightBig');
					}, afterMoveDelay);
				}
			}
		},

		isotopeFilter: function(options) {
			var $container = $('.isotope-filter');
			$container.imagesLoaded(function() {				
				var current_filter = '*';
				if ( localStorage.getItem('isotop_filter')){
					current_filter = localStorage.getItem('isotop_filter');
				}
				$container.isotope({
					filter: current_filter,
					itemSelector: '.isotope-item'
				});				
				$("#filter").find("[data-filter='" + current_filter + "']").addClass('current');
			});
			// filter items when filter link is clicked
			$('#filter').on('click', 'a', function() {
				$('#filter  a').removeClass('current');
				$(this).addClass('current');
				var selector = $(this).attr('data-filter');
				var buzzlocal = localStorage.setItem('isotop_filter', selector);
				$container.isotope({
					filter: selector
				});
				return false;
			});
		},

		initBxSlider: function(options){
			$(".bxslider").each(function(i){
				var sliderMode = $(this).data("mode");
				var slideMargin = $(this).data("slide-margin");
				var minSlides = $(this).data("min-slides");
				var moveSlides = $(this).data("move-slides");
				var sliderPager = $(this).data("pager");
				var sliderPagerCustom = $(this).data("pager-custom");
				var sliderControls = $(this).data("controls");
				
				$(this).bxSlider({
					mode: sliderMode,
					slideMargin: slideMargin,
					minSlides: minSlides,
					moveSlides: moveSlides,
					pager: sliderPager,
					pagerCustom: sliderPagerCustom,
					controls: sliderControls,
					prevText:'<i class="fa fa-angle-left"></i>',
					nextText:'<i class="fa fa-angle-right"></i>'
				});
			});
		},

		initWowSlider: function(options){
			var scrollingAnimations = $('body').data("scrolling-animations");
			if(scrollingAnimations){
				new WOW().init();
			}
		},

		goToTop: function(options){
			$("#footer").on('click', '.goToTop', function(e){
				e.preventDefault();
				$('html,body').animate({
					scrollTop: 0,
				},'slow');
			});
			// Show/Hide Button on Window Scroll event.
			$(window).on('scroll', function(){
				var fromTop = $(this).scrollTop();
				var display = 'none';
				if(fromTop > 650){
					display = 'block';
				}
				$('#scrollTop').css({'display': display});
			});
		},

		fixedHeader: function(options){
			// Fixed Header
			var topOffset = $(window).scrollTop();
			if(topOffset > 0){
				$('body').addClass('fixed-header');
			}
			$(window).on('scroll', function(){
				var fromTop = $(this).scrollTop();
				if(fromTop > 0){
					$('body').addClass('fixed-header');
				}
				else{
					$('body').removeClass('fixed-header');
				}
				
			});
		},
		
	};

	BuzzstoreCore.initialize();

	/**
	 * Menu Toggle
	*/
	$('.buzz-toggle').click(function(){
	    $('.buzz-toggle').toggleClass('on');
	    $('#primary-menu').slideToggle();
	});

	/**
	 * Widget Sticky sidebar
	*/
	$('.content-area').theiaStickySidebar({
	    additionalMarginTop: 30
	});

	$('.widget-area').theiaStickySidebar({
	    additionalMarginTop: 30
	});

	/**
	 * Responsive Menu Toggle
	*/
	$('.buzz-menulink .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');
	$('.buzz-menulink .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-angle-down"></i> </span>');

	$('.buzz-menulink .sub-toggle').click(function() {
	    $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
	    $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
	    $(this).children('.fa-angle-down').first().toggleClass('fa-angle-up');
	});


})();

/**
 * Wishlist count ajax update 
*/
jQuery( document ).ready( function($){
    $('body').on( 'added_to_wishlist', function(){
        $('.top-wishlist .count').load( yith_wcwl_l10n.ajax_url + ' .top-wishlist .bigcounter', { action: 'yith_wcwl_update_single_product_list' } );
    });
});