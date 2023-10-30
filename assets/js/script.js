
$(document).ready(function() {
	/* Mobile menu*/
	$('.toggle-mobile-menu').click(function () {
		$('#mobile-site-navigation, #wrapper, #mobile-menu-bg').toggleClass('mobile-menu-active');
	});	

	$('#mobile-menu-bg').click(function () {
		$('#mobile-site-navigation, #wrapper, #mobile-menu-bg').removeClass('mobile-menu-active');
	});


	$('#mobile-site-navigation ul li.menu-item-has-children span, #mobile-site-navigation ul li.menu-item-has-children a').click(function (e) {
		e.preventDefault();
		$(this).parent('.menu-item-has-children').toggleClass('submenu-open');
	});

	/*Scroll to top link*/
	$('a[href="#top"]').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});	

	/*Sticky header*/
	var $header_wrapper  = $('#header-wrapper'),
	$mobile_header = $('#mobile-site-header'),
	$site_header = $('#site-header'), headerOffset = $site_header.offset().top,
	$scrollTop = $('.scrollToTop');
	$(window).scroll(function() {
		var scrolled = $(this).scrollTop();

		if(scrolled > headerOffset) {
			$header_wrapper.addClass('header-sticky');
			$header_wrapper.css({ 'top' : '0px' });
		} else {
			$header_wrapper.removeClass('header-sticky');
			$header_wrapper.css({ 'top' : '' });
		}

		/*Mobile sticky header*/
		if (scrolled > 10) {
			$mobile_header.css({ 'position' : 'fixed', 'top' : '0px', 'width' : 'calc(100% - 30px)',  'z-index' : '9999' });
		} else {
			$mobile_header.css({ 'position' : 'relative', 'width' : '100%' });
		}
		/*Scroll to top*/
		//&& ! $scrollTop.hasClass('scrollactive')
		if (scrolled > 150 )
		{
			$scrollTop.addClass('scrollactive');
		}else{
			$scrollTop.removeClass('scrollactive');
		}

	});

	$('.header-share-popover').popover({
		html: true,
		trigger: 'focus',
		content: `<div class="social"><a href=""><i class="fa fa-facebook"></i></a><a href=""><i class="fa fa-google-plus"></i></a></div>`,
	});

});/*End ready*/