$(function (){
	var window_height = $(window).height();
	var footer_height = 0;
	var header_height = 0;
	var dev_mode = true;

	if( $.cookie('Tv2-footer_height') == undefined || dev_mode == true ){
		footer_height = Number($('#core-footer').height())+20;
		$.cookie('Tv2-footer_height', footer_height, { expires: 365, path: '/' });
	} else {
		footer_height = $.cookie('Tv2-footer_height');
	}

	if ( $.cookie('Tv2-header_height') == undefined || dev_mode == true ){
		header_height = $('#core-header').height();
		$.cookie('Tv2-header_height', header_height, { expires: 365, path: '/' });
	} else {
		header_height = $.cookie('Tv2-header_height');
	}

	if ( $.cookie('Tv2-thumbnail_size') == undefined && $(document).find($('#core-article > .article-list > .items.new'))['0'] != null ){
		thumbnail_height = $('#core-article > .article-list > .items.new').height();
		$.cookie('Tv2-thumbnail_height', thumbnail_height, { expires: 365, path: '/' });
	} else {
		thumbnail_height = $.cookie('Tv2-header_height');
	}

	if ( $.cookie('general-menueffect') != 'disable' ) {
		$('.core-sidebar').height(window_height);
		$('.core-sidebar > ul.core-menu').height(window_height - footer_height);
		$('.core-sidebar > ul.core-menu > li.myinfo').height(header_height);

		window.onresize = function(){
			window_height = $(window).height();
			$('.core-sidebar').height(window_height);
			$('.core-sidebar > ul.core-menu').height(window_height - footer_height);
		}
	}

	$('#sidebar_toggle').click(function(){
		$('.core-sidebar').toggleClass('active');
		$('.core-content').toggleClass('active');
		return false;
	});

	$('.core-sidebar > ul.core-menu').scrollTop($('.core-sidebar > ul.core-menu > li.active').offset().top);
	$('#submenu_toggle').click(function(){
		$(this).toggleClass('active');
		$('#submenu').toggleClass('active');
		return false;
	});
});