/**
 * @file testimonials.js
 * 	Recent testimonials slider
 */
 
(function ($) {
$(document).ready(function() {
	var testimonialsEl = jQuery('#recent-testimonials'),
	testimonialsElChildren = testimonialsEl.children(':not(span)'),
	testimonialsCount = testimonialsElChildren.length;
	testimonialNext = jQuery('.testimonial_next', testimonialsEl),
	testimonialPrev = jQuery('.testimonial_prev', testimonialsEl),
	nextTestimonials = '',
	prevTestimonials = '';
	
	jQuery('div.item:not(.views-row-first)', testimonialsEl).hide();
	
	testimonialNext.click(function () {
		testimonialsElChildren.each(function(i) {
		if(jQuery(this).is(':visible')){
				nextTestimonials = jQuery(this).next();
			if(nextTestimonials.hasClass('testimonial_nav'))
				nextTestimonials = testimonialsElChildren.eq(0);
		}
		});
		testimonialsElChildren.hide();
		nextTestimonials.show();
	});
	
	testimonialPrev.click(function () {
		testimonialsElChildren.each(function(i) {
		if(jQuery(this).is(':visible')){
			prevTestimonials = jQuery(this).prev();
			if(prevTestimonials.length == 0)
				prevTestimonials = testimonialsElChildren.eq(testimonialsCount-1);
		}
		});
		testimonialsElChildren.hide();
		prevTestimonials.show();
	});

});
})(jQuery);