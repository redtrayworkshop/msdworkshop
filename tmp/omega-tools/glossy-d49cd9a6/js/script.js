/**
 * @file script.js
 * 	Glossy main JS file
 */
 
(function ($) {
$(document).ready(function(){

/* 
 * Hover fade - opacity animation
 */
jQuery('a.hover_fade, .service-links a, a.follow-link').hover(function(){
		jQuery(this).stop().animate({opacity:0.4},400);
}, function(){
		jQuery(this).stop().animate({opacity:1},400);
});


/** Hover Fade effect **/
$("a.lightbox-processed").hover(function(){
	//$(this).animate({borderColor : '#ec7100'}, 300);
	$(this).find('.img-wrapper').stop().animate({opacity : '0.5'}, 300);
	$(this).append('<span class="zoom"></span>');
	$(this).find('.zoom').animate({opacity : '1'}, 300);
}, function(){
	//$(this).animate({borderColor : '#f5f5f5'}, 300);
	$(this).find('.img-wrapper').stop().animate({opacity : '1'}, 300);
	$(this).find('.zoom').animate({opacity : '0'}, 300 ,function(){ 
		$(this).remove(); 
	});
});


/* 
 * toggle functions 
 */
jQuery('#page .toggle:not(.active)').next('.toggle_content').hide();
jQuery('#page .toggle').toggle(function(){
		if ($(this).hasClass('active')) {
			jQuery(this).removeClass('active');
		}else {
			jQuery(this).addClass('active');
		}
	}, function () {
	jQuery(this).removeClass('active');
});

jQuery('#page .toggle').click(function(){
	jQuery(this).next('.toggle_content').slideToggle();
});
	
});
})(jQuery);