jQuery(document).ready(function($){

	var $container = $('#masonry-container');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.masonry-post',
			columnWidth : 250,
			isFitWidth: true
		});
	});

});