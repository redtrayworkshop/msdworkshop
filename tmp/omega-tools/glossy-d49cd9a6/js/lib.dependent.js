/** 
 * @file lib.dependent.js
 *	Library dependent JS file
 */

(function ($) {
$(document).ready(function() {
/**
 * Add labelify functionality
 */
$(".do-labelify label").hide();
if (jQuery().labelify) {
	$(".do-labelify input").labelify({
		text: "label"
	});
}

/**
 * Add Superfish to menus that has sf-menu class
 */
/**
 * Add Superfish to menus that has sf-menu class
 *	+ add Superfish effect to main menu
 */
// suerfish effecto on main navigation and superfished element
$('.navigation ul, .superfish ul').superfish({speed:'fast', autoArrows: false});

/**
 * Add autoResize textarea functionality
 */
$('textarea').autoResize({
    // On resize:
    onResize : function() {
        $(this).css({opacity:0.8});
    },
    // After resize:
    animateCallback : function() {
        $(this).css({opacity:1});
    },
    // Quite slow animation:
    animateDuration : 300,
    // More extra space:
    extraSpace : 40
});

/**
 * Add Custom Select Style functionality
 */
if (jQuery().customStyle) {
    // Target your .container, .wrapper, .post, etc.
   jQuery("select").customStyle();
}

/**
 * Add Fitvids functionality
 */
if (jQuery().fitVids) {
    // Target your .container, .wrapper, .post, etc.
   jQuery(".responsive, .responsive-video,.views-field-field-video").fitVids();
}

/**
 * Add Fittext functionality
 */
if (jQuery().fitText) {
	jQuery('h1').fitText(1, { minFontSize: '14px', maxFontSize: '31px' });
	jQuery('h2').fitText(1, { minFontSize: '12px', maxFontSize: '24px' });
}

/**
 * Add jAccordion functionality
 */
if (jQuery().jAccordion) {
    jQuery('.accordion-menu ul.menu').jAccordion({cookies:true});
}


/**
 * Add preloader functionality
 */

if (jQuery().preloader) {
	preload('.loader', 'large');
	jQuery(".preload").preloader({ delay: 20, imagedelay:200, mode: "parallel" });
}

/*
 * Preloader image
 */
function preload(img_class, type) {
	var i;
	var preLoader = null;
	var preLoaderCount = 0;
	var type = type ? type : 'medium';
	i=0;
	switch (type){
		case 'small':
			positionsSmall=[-16,-32,-48,-64,-80,-96,-112,-128,-144,-160,-176,0];
			positionsClass = 'bottom';
			break;

			case 'large':
			positions=[-35,-70,-105,-140,-175,-210,-245,-280,-315,-350,-385,0];
			positionsClass = 'top';
			break;
			
		case 'medium':
			positions=[-26,-52,-78,-104,-130,-156,-182,-208,-234,-260,-286,0];
			positionsClass = 'center';
			break;	
	}

	preLoader = setInterval(function(){
		jQuery(img_class).css('background-position',positions[i]+'px ' +positionsClass);
		i++;
		preLoaderCount++;
		if(preLoaderCount===200){clearInterval(preLoader);preLoaderCount = 0;}
		if(i===12){i=0;}
	},70);
}

/**
 * Add mobileMenu functionality
 */
if (jQuery().mobileMenu) {
	$(Drupal.settings.responsive_menu_options.selector + ' ul' ).mobileMenu({
		switchWidth: Drupal.settings.responsive_menu_options.switchWidth,	//width (in px to switch at)
		topOptionText: Drupal.settings.responsive_menu_options.title,	//first option text
		indentString: Drupal.settings.responsive_menu_options.indent	//string for indenting nested items
	});
}

});
})(jQuery);