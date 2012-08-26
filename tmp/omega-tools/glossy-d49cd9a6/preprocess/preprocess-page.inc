<?php

/**
 * Page preprocessing
 */
function glossy_alpha_preprocess_page(&$vars) {
	
	/** Add mobileMenu JS settings**/
	$mobile_options = variable_get('responsive_menu_options', array('switchWidth' => 768, 'selector' => 'Navmenu', 'title' =>t('Select a page'), 'indent' => '>>'));
	// Add the mobileMenu options variables. 
	drupal_add_js(array(
		'responsive_menu_options' => array(
			'switchWidth' => $mobile_options['switchWidth'],
			'selector' => $mobile_options['selector'],
			'title' => $mobile_options['title'],
			'indent' => $mobile_options['indent'],
		),
	), array('type' => 'setting', 'scope' => JS_DEFAULT));
}
