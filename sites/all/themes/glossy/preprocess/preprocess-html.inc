<?php

/**
 * Page preprocessing
 */
function glossy_alpha_preprocess_html(&$vars) {
	// add IE specific styles
	drupal_add_css(drupal_get_path('theme', 'glossy') . '/css/ie8-and-down.css', array('weight' => 999, 'browsers' => array('!IE' => FALSE, 'IE' => '(lt IE 9)&(!IEMobile)'), 'group' => CSS_THEME));
}