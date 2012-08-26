/**
 * @file Isotope site feature in portfolio page settings
 */
(function ($) {
	$(document).ready(function() {

	// Iso container
	var $container = $('#iso-container');
	var $element = $('.element', $container).hover(function(){
			$(this).addClass('hovered');	
		},
		function(){
			$(this).removeClass('hovered');	
		}
	);
	
	var default_img_width = $('img', $element).width();
	
	// init 
	dynamicColWidth($container);

	// initialize isotope
	$container.isotope({
		itemSelector : '.element',
		layoutMode : 'fitRows',        
		resizable: false, // disable normal resizing
		// set columnWidth to a percentage of container width
		masonry: { columnWidth: dynamicColWidth($container)},
	});	
	
	// update columnWidth on window resize
	$(window).smartresize(function(){
		$container.isotope({
			masonry : {
				columnWidth : dynamicColWidth($container),
			},
		});
	});
	
	var $optionSets = $('#iso-options .option-set'),
		$optionLinks = $optionSets.find('a');

	$optionLinks.click(function(){
		var $li = $(this).parents('li:first');
		// don't proceed if already active
		if ( $li.hasClass('active') ) {
			return false;
		}
		var $optionSet = $li.parents('.option-set');
		$optionSet.find('.active').removeClass('active');
		$li.addClass('active');
		
		var selector = $li.find('a').attr('data-filter');
		$container.isotope({ filter: selector });
		return false;
	});
	
	/**
   * Dynamically change width of isotope columns and adjust nested elements
	 * @param $container
	 *	object of isotope container
	 */
	function dynamicColWidth($container) {
		var _colWidth = $container.width();
		var _colsInRow = 1;

		if (_colWidth >  default_img_width && _colWidth <= 550) {
			_colWidth = (_colWidth /2) -10;
			_colsInRow = 2;
		}if (_colWidth >  default_img_width && _colWidth <= 700) {
			_colWidth = (_colWidth / 3) -10;
			_colsInRow = 3;
		}else if (_colWidth > 700) {
			_colWidth = _colWidth / 4;
			_colsInRow = 4;	
		}

		$element.css({'width': _colWidth});
		adjustImg($container, _colWidth, _colsInRow);
		return _colWidth;
	}
	
	/**
   * Adjusting image max-width properties
	 * @param $container
	 *	object of isotope container
	 * @param _colWidth
	 *	calculated width of each isotope column
	 * @param _colsInRow
	 *	Number of columns in one row
	 */
	function adjustImg($container, _colWidth, _colsInRow) {
		var max_size;
		switch (_colsInRow) {
			case 1:
				// no margin assigning
				max_size = (_colWidth / default_img_width) * 100;
				break;
				
			case 2:
				// assign margin
				max_size = ((_colWidth - 14 /** padding **/ - 20 /** margin-right **/) / _colWidth) * 100;
				break;

			case 3:
				// assign margin
				max_size = ((_colWidth - 14 /** padding **/ - 20 /** margin-right **/) / _colWidth) * 100;
				break;
				
			case 4:
				// assign margin
				max_size = ((_colWidth - 14 /** padding **/ - 20 /** margin-right **/) / _colWidth) * 100;
				break;
		}

		$('.element img', $container).each(function(){
			$(this).css({'max-width': max_size + '%'});
		});
	}
	
});
})(jQuery);