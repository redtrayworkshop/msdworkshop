<?php

/**
 * Region processing
 */
function glossy_alpha_process_region(&$vars) {

	$theme = alpha_get_theme();
	$vars['messages'] = $theme->settings['toggle']['messages'] ? $theme->page['messages'] : false;

	if (in_array($vars['elements']['#region'], array('menu', 'branding', 'content'))) {
    
    switch ($vars['elements']['#region']) {
      case 'content':
				$vars['breadcrumb'] = $theme->settings['toggle']['breadcrumb'] ? $theme->page['breadcrumb'] : false;
				$vars['columns'] = $vars['elements']['#grid']['columns'];
				// set the title var to false value to disable title rendering
				if (arg(0) == 'node' && is_numeric(arg(1))) {
					$node = node_load(arg(1));
					if ($node->comment == COMMENT_NODE_OPEN) {
						$vars['comment_display'] = isset($node->comment_count) ? $node->comment_count : 0;
						$vars['comment_count'] = isset($node->comment_count) ? $node->comment_count : 0;
					}
					$vars['title'] = false;
				}else	if (drupal_is_front_page()) {
					$vars['theme_hook_suggestions'] = array('region__content__front');
				}else	if (arg(0) == 'contact' && module_exists('contact')) {
					$vars['theme_hook_suggestions'] = array('region__content__contact');
				}
        break;
      
      case 'menu':
        break;
      
      case 'branding':
				$vars['main_menu'] = $theme->page['main_menu'];
        break;      
    }
  }
}
