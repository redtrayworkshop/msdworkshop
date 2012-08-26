/**
 * @file admin.js
 *	Manipulate theme settings form
 */
(function ($) {
$(document).ready(function(){

/* 
 * Typography add style
 */
jQuery('.font-select select').each(function(){
	var $this = $(this);
	jQuery('.sample_text', $this.parents(".font-select:first")).css('font-family', "'" + $this.val() + "'");
	
	$this.change(function(){
		jQuery('.sample_text', $this.parents(".font-select:first")).css('font-family', "'" + $this.val() + "'");
	});
		
});


/* 
 * Skin Setting
 */
jQuery('.form-item-glossy-default-skin .form-type-radio').each(function(){
	$('input', this).hide();
	if ($('input', this).attr('checked') == true) {
		$('span.skin_thumb', this).addClass('default_item');
	}
	
	$('label', this).hover(function() {
			$(this).addClass('hovered');
	}, function() {
			$(this).removeClass('hovered');
	});

	$('label', this).click(function() {
			var thisContext = $(this).parents('.form-item-glossy-default-skin');

			$('span.skin_thumb.default_item', thisContext).removeClass('default_item');
			$(this).siblings('input').checked = true;
			$('span.skin_thumb', $(this)).addClass('default_item');
	});
});

});
})(jQuery);