jQuery(document).ready(function($){

	if ( $('#masonry-container').length > 0 ) {
		var $container = $('#masonry-container');
		$container.imagesLoaded(function(){
			$container.masonry({
				itemSelector : '.masonry-post',
				columnWidth : 250,
				isFitWidth: true
			});
		});
	} // end if

	if ( $('.flexslider').length > 0 ) {
		$('.flexslider').flexslider({
			directionNav: false
		});
	}

});