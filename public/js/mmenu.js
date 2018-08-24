if($('.side-open').length > 0) {
	$('.side-open, .side-shadow').click(function() {
		if($('body').hasClass('open')) {
			$('body').removeClass('open');
		} else {
			$('body').addClass('open');
		}
	});

	$('.nav-first i').click(function() {
		$(this).height($('.nav-first').height());
		if($(this).parent('li').hasClass('mobile-active')) {
			$(this).parent('li').removeClass('mobile-active');
		} else {
			$('.nav-first').removeClass('mobile-active');
			$(this).parent('li').addClass('mobile-active');
		}
	});

	function side_func() {
		sidemargin = $('.side-box').height() - $('.side-foot').innerHeight() - $('.side-nav').height() - $('.side-search').height();
		sidemargin = sidemargin < 0 ? 0 : sidemargin;
		$('.side-nav').css('margin-bottom', sidemargin);
	}
	side_func();
	$(window).resize(function() {
		if(typeof(side_time) != 'undefined') clearTimeout(side_time);
		side_time = window.setTimeout(function() {
			side_func();
		}, 100);
	});
}