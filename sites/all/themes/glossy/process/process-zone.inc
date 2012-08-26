<?php

/**
 * Zone processing
 */
function glossy_alpha_process_zone(&$vars) {
	if ($vars['is_front'] && $vars['elements']['#zone'] == 'content') {
		$vars['theme_hook_suggestions'] = array('zone__content__front');
	}
	/** [--DEMO--] Warning Demo Only **/
	$pathato = explode('/', drupal_get_path_alias());
	if ($pathato[0] == 'features' && !empty($pathato[1]) && $vars['elements']['#zone'] == 'content') {
		$vars['theme_hook_suggestions'] = array('zone__content__' . $pathato[1]);
	}

}