/**
 * @file AnythingSlider.script.js
 * 	AnythingSlider slideshow settings
 */
(function ($) {
$(document).ready(function() {

	slider = $('.view-display-id-ff_AnythingSlider .slider').anythingSlider({'appendStartStopTo' : '.view-display-id-ff_AnythingSlider .play_control',
	easing : 'easeInBounce', 
	buildArrows : false,
	expand : true});
	
	$('.view-display-id-ff_AnythingSlider .start-stop').live('hover', function(e) {
		if( e.type == 'mouseenter' )
			jQuery(this).stop().animate({opacity:1},400);

		if( e.type == 'mouseleave' )
			jQuery(this).stop().animate({opacity:.2},400);
	});
	
});
})(jQuery);