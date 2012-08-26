/**
 * @file flexslider.script.js
 * 	flexslider slideshow settings
 */
(function ($) {
$(document).ready(function() {


$(window).bind('resize', function() {
	var timer = window.setTimeout( function() {
	window.clearTimeout( timer );
	adjustSlider();
	}, 30 );
});


function adjustSlider() {
	$this = $('.flexslider .slides');
	$('li.views-row', $this).css({'width' : $this.attr('width'),'height' : $this.attr('height')});
	timer = window.setTimeout( function() {
		window.clearTimeout( timer );
		$this.data('resize', null);
	}, 600 );
}

/**
 * Add preloader functionality
 */
if (jQuery().preloader) {
	// Custom selectors
	jQuery(".flexslider").preloader({ delay: 20,
	imagedelay:400,
	mode: "sequence",
	ondone:function(){
		$('.flexslider-wrapper .flex_preloader').remove();
		$('.flexslider').flexslider();
	},
	});
}

});
})(jQuery);