<?php

/**
 * Page processing
 */
function glossy_alpha_process_page(&$vars) {
	$default_skin = theme_get_setting('glossy_default_skin') ? theme_get_setting('glossy_default_skin') : 'black';
	if ($default_skin) {
		foreach(glossy_style_option() as $fname => $info) {
			if ($info->name == $default_skin) {
				drupal_add_css($info->uri);
				break;
			}
		}
	}
}
