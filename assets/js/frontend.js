jQuery(function($){

	function add_margin_to_body(){
		var getHelloBarHeight = $('.hello-bar-wp').height();
		$('body').css('margin-top', getHelloBarHeight);
	}
	add_margin_to_body();

	//Close Hello Bar
	$('.hello-bar-wp-close').on('click', function(e){
		e.preventDefault();
		$('.hello-bar-wp').hide();
		$('body').css('margin-top', 0);
	});

});