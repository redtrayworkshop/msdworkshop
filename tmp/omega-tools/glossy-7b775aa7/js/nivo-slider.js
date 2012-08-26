/**
 * @file nivo-slider.js
 * 	nivo-slider slideshow settings
 */
 
(function ($) {
$(document).ready(function() {

    $(window).load(function() {
        $('#slider').nivoSlider({
				boxCols: 16, // For box animations
        boxRows: 8,
				captionOpacity : 1.0,
				});
    });
});
})(jQuery);