<?php
// uncomment following line for development
// drupal_flush_all_caches();
require_once dirname(__FILE__) . '/lib/theme-functions.php';

/** Define variables **/
variable_set('theme_version', '1.0');
variable_set('glossy_skin_dir', drupal_get_path('theme', 'glossy') . '/css/skins');
variable_set('glossy_fonts_dir', drupal_get_path('theme', 'glossy') . '/fonts');
variable_set('glossy_custom_typography_css', drupal_get_path('theme', 'glossy') . '/css/typography-custom.css');
variable_set('glossy_img_assets', drupal_get_path('theme', 'glossy') . '/img');
/**
 * Implements theme_links().
 */
function glossy_links($vars) {
	// Add superfish dropdowns effect to main menu
  if (array_key_exists('id', $vars['attributes']) && $vars['attributes']['id'] == 'main-menu' && variable_get('dh_display_menu_tree', true)) {
      $pid = variable_get('menu_main_links_source', 'main-menu');
			$tree = menu_tree($pid);
			$output = drupal_render($tree);
			$output = '<div class="superfish">' .$output. '</div>';
			return preg_replace('/<ul class="menu/i', '<ul class="main-menu clearfix', $output, 1);
  }
  return theme_links($vars);
}

/**
* Add unique class (mlid) to all menu items.
*/
function glossy_menu_link__main_menu($vars) {
  $element = $vars['element'];
  $sub_menu = '';
  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
	
	$depth = $element['#original_link']['depth'];

	if ($depth == 1 && isset($element['#localized_options']['attributes']['title']) && strlen($element['#localized_options']['attributes']['title']) > 0) {
		$element['#localized_options']['html'] = true;
		$element['#title'] .= '<span class="description">' . $element['#localized_options']['attributes']['title'] . '</span>';
		$element['#attributes']['class'][] = 'first-depth';
	}
	
  $output = l($element['#title'] , $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Overriding Theme function to output a list of links.
 *
 * @param $links
 *   An array of follow link objects.
 * @param $networks
 *   An array of network names, keys are machine names, values are visible titles.
 *
 * @ingroup themeable
 */
function glossy_follow_links($variables) {
  $links = $variables['links'];
  $networks = $variables['networks'];
  $output = '<div class="follow-links clearfix">';
	
	$items = array();
  foreach($links as $link) {
    $title = !empty($link->title) ? $link->title : $networks[$link->name]['title'];
    $items[] = theme('follow_link', array('link' => $link, 'title' => $title));
  }

	$vars['items'] = $items;
	$vars['type'] = 'ul';
	
	$output .= theme('item_list', $vars);
  $output .= '</div>';
  return $output;
}

/**
 * Implementaion of hook_css_alter()
 */
function glossy_css_alter(&$css) {
	
	if (module_exists('calendar')) {
		$module_path = drupal_get_path('module', 'calendar');
		$css[$module_path . '/css/calendar_multiday.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/calendar_multiday.css';
		if (isset($css[$module_path . '/css/calendar-overlap.css'])) {
			$css[$module_path . '/css/calendar-overlap.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/calendar-overlap.css';
		}
	}	
	
	if (module_exists('contextual')) {
		// alternate contextual.css file
		$module_path = drupal_get_path('module', 'contextual');
		if (isset($css[$module_path . '/contextual.css'])) {
			$css[$module_path . '/contextual.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/contextual.css';
		}	
	}
	
	
	if (module_exists('lightbox2')) {
		// alternate lightbox.css file
		$module_path = drupal_get_path('module', 'lightbox2');
		if (isset($css[$module_path . '/css/lightbox.css'])) {
			$css[$module_path . '/css/lightbox.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/lightbox.css';
		}
	}
	
	if (module_exists('geshifilter')) {
		// alternate geshifilter.css file
		$module_path = drupal_get_path('module', 'geshifilter');
		if (isset($css[$module_path . '/geshifilter.css'])) {
			$css[$module_path . '/geshifilter.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/geshifilter.css';
		}	
	}
	
	// alternate geshifilter.css file
	$theme_path = drupal_get_path('theme', 'omega');
	if (isset($css[$theme_path . '/css/formalize.css'])) {
		$css[$theme_path . '/css/formalize.css']['data'] = drupal_get_path('theme', 'glossy') . '/css/formalize.css';
	}
}

/**
 * Implementaion of hook_js_alter()
 */
function glossy_js_alter(&$javascript) {	
	if (module_exists('media_youtube')) {
		$path = drupal_get_path('theme', 'glossy');
		if (isset($javascript['sites/all/modules/media_youtube/js/media_youtube.js'])) {
			$javascript['sites/all/modules/media_youtube/js/media_youtube.js']['data'] = $path . '/js/media_youtube.js';
		}	
	}
		
	if (module_exists('media_vimeo')) {
		if (isset($javascript['sites/all/modules/media_vimeo/js/media_vimeo.js'])) {
			$javascript['sites/all/modules/media_vimeo/js/media_vimeo.js']['data'] = $path . '/js/media_vimeo.js';
		}	
	}
	
	if (module_exists('media_archive')) {
		if (isset($javascript['sites/all/modules/media_vimeo/js/media_archive.js'])) {
			$javascript['sites/all/modules/media_vimeo/js/media_archive.js']['data'] = $path . '/js/media_archive.js';
		}
	}
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return 
 *   a string containing the breadcrumb output.
 */
function glossy_breadcrumb($vars) {
	$breadcrumb = $vars['breadcrumb'];
	// removes breadcrumb from frontpage and styles it
  if (!empty($breadcrumb) && !drupal_is_front_page()) {
		if (isset($breadcrumb[0]) && $breadcrumb[0] == l(t('Home'), '<front>')) {
			$breadcrumb[0] = l(t('Home'), '<front>', array('attributes' => array('class' => 'front')));
		}
		
		$seperator = '<span class="arrow">' . theme_get_setting('glossy_breadcrumb_sep') . '</span>';
		return '<div class="breadcrumb">' . implode($seperator, $breadcrumb) . "</div>";
	}

}


/**
 * Returns HTML for a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results. Format a list
 * of nearby pages with additional query results.
 *
 * @param $variables
 *   An associative array containing:
 *   - tags: An array of labels for the controls in the pager.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *   - quantity: The number of pages in the list.
 *
 * @ingroup themeable
 */
function glossy_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }

    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => '<span>' . $i . '</span>',
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager', 'clearfix')),
    ));
  }
}

/**
 * Overriding feed icon theming
 */
function glossy_feed_icon($vars){
  $text = t('Subscribe to @feed-title', array('@feed-title' => $vars['title']));
  return l('<span>' . $text . '</span>', $vars['url'], array('html' => TRUE, 'attributes' => array('class' => array('feed-icon hover_fade'), 'title' => $text)));
}

/**
 * Overriding alendar links above the pager.
 */
function glossy_preprocess_date_views_pager(&$vars) {
  $view = $vars['plugin']->view;
  if ($view->plugin_name != 'calendar_style') {
    return;
  }
  $options = $view->style_options;

  // If we're not on a view with a path (a page), no links are needed.
  $current_path = !empty($view->display_handler->options['path']) ? $view->display_handler->options['path'] : '';
  if (empty($current_path)) {
    return;
  }
  // Find all the displays in this view that use the calendar style and have a path and create links to each.
  $calendar_links = array();
  $base = array('attributes' => array('rel' => 'nofollow'));
  foreach($view->display as $id => $display) {

    if ($display->display_options['style_plugin'] == 'calendar_style' && !empty($display->display_options['path'])) {
      $path = $display->display_options['path'];
      $title = $display->display_title;
      // @TODO Why is this sometimes empty for a style that uses the default value?
      $type = !empty($display->display_options['style_options']['calendar_type']) ? $display->display_options['style_options']['calendar_type'] : 'month';

      // Make sure the links to other calendar displays use the right path for that display.
      // Get rid of pager links when swapping between displays to force the base argument 
      // to be structured correctly for the type of display. This means you can't use
      // these links in a block or panel.
      $href = str_replace($current_path, $path, date_pager_url($view, $type, NULL, TRUE));

      // Once we have a path for the links to other displays, add it to our links array.
      $calendar_links['calendar calendar-'. $type] = array('title' => $title, 'href' => $href);
    }
  }

  // If an 'Add new ... link is provided, add it here.
  // the query will bring the user back here after adding the node.
  if (!empty($view->date_info->calendar_date_link) 
  && (user_access("administer nodes") || user_access('create '. $view->date_info->calendar_date_link .' content'))) {
    $name = node_type_get_name($view->date_info->calendar_date_link);
    $href = 'node/add/' . str_replace('_', '-', $view->date_info->calendar_date_link);
    $query = drupal_get_query_parameters(array('destination' => $view->date_info->url));    
    $calendar_links['calendar calendar-add'] = $base + array(
      'title' => t('Add+'), 
      'href' => $href, 
      'query' => $query,
      );
  }

  // Append the calendar links above the pager.
	$type = arg(1);
	$type = isset($type) && in_array($type, array('day', 'week', 'month', 'year')) ? $type : '';
  $links = array(
    'links' => $calendar_links, 
    'attributes' => array('class' => array('calendar-links', 'item-list', $type, 'clearfix')),
  );
  $vars['pager_prefix'] = theme('links', $links);
}

/**
 * Overriding Process variables for comment.tpl.php.
 *
 * @see comment.tpl.php
 */
function glossy_preprocess_comment(&$vars) {
  $comment = $vars['elements']['#comment'];
  $vars['created']   = format_date($comment->created, 'custom', variable_get('glossy_comment_date_format', 'M jS, Y'));
}

/**
 * Overriding theme_fieldset()
 */
function glossy_fieldset($variables) {
  $element = $variables['element'];
  element_set_attributes($element, array('id'));
  _form_set_class($element, array('form-wrapper'));
	
	// make all filter guidelines collapsible and collapsed by default
	if (in_array('filter-wrapper', $element['#attributes']['class'])) {
		array_push($element['#attributes']['class'], 'collapsible', 'collapsed');
	}

  $output = '<fieldset' . drupal_attributes($element['#attributes']) . '>';
  if (!empty($element['#title'])) {
    // Always wrap fieldset legends in a SPAN for CSS positioning.
    $output .= '<legend><span class="fieldset-legend">' . $element['#title'] . '</span></legend>';
  }
  $output .= '<div class="fieldset-wrapper">';
  if (!empty($element['#description'])) {
    $output .= '<div class="fieldset-description">' . $element['#description'] . '</div>';
  }
  $output .= $element['#children'];
  if (isset($element['#value'])) {
    $output .= $element['#value'];
  }
  $output .= '</div>';
  $output .= "</fieldset>\n";
  return $output;
}

function glossy_preprocess_simplenews_block(&$variables) {
  global $user;
  $tid = $variables['tid'];
  // @todo replace path
  $variables['newsletter_link'] = l(t('Previous issues'), 'taxonomy/term/' . $tid, array('attributes'=> array('class' => array('fancy_link', 'email_link'))));
}

/**
 * Preprocess function for theme('media_vimeo_video').
 */
function glossy_preprocess_media_vimeo_video(&$variables) {
  // Build the URL for display.
  $uri = $variables['uri'];
  $wrapper = file_stream_wrapper_get_instance_by_uri($uri);
  $parts = $wrapper->get_parameters();
  $variables['video_id'] = check_plain($parts['v']);

  $variables['width'] = isset($variables['width']) ? $variables['width'] : media_vimeo_variable_get('width');
  $variables['height'] = isset($variables['height']) ? $variables['height'] : media_vimeo_variable_get('height');
  $variables['autoplay'] = isset($variables['autoplay']) ? $variables['autoplay'] : media_vimeo_variable_get('autoplay');
  $variables['fullscreen'] = isset($variables['fullscreen']) ? $variables['fullscreen'] : media_vimeo_variable_get('fullscreen');
  $variables['autoplay'] = $variables['autoplay'] ? 1 : 0;
	
  $full_screen = $variables['fullscreen'] ? 'true' : 'false';
  $variables['wrapper_id'] = 'media_vimeo_' . $variables['video_id'] . '_' . $variables['id'];

	$full_screen = $variables['fullscreen'] ? ' allowFullScreen' : '';
	$variables['output'] = '<iframe frameborder="0" id="'.$variables['wrapper_id'].'" src="http://player.vimeo.com/video/'.$variables['video_id'].'?show_title=0&show_byline=0&show_portrait=0" width="'.$variables['width'].'" height="'.$variables['height'].'" '.$full_screen.'></iframe>';

  // Pass the settings to replace the object tag with an iframe.
  $settings = array(
    'media_vimeo' => array(
      $variables['wrapper_id'] => array(
        'width' => $variables['width'],
        'height' => $variables['height'],
        'video_id' => $variables['video_id'],
        'fullscreen' => $variables['fullscreen'],
        'id' => $variables['wrapper_id'] .'_iframe',
      ),
    ),
  );
  if ($variables['autoplay']) {
    $settings['media_vimeo'][$variables['wrapper_id']]['options'] = array(
      'autoplay' => $variables['autoplay'],
    );
  }
  drupal_add_js($settings, 'setting');
  drupal_add_js(drupal_get_path('module', 'media_vimeo') . '/js/media_vimeo.js');
  drupal_add_css(drupal_get_path('module', 'media_vimeo') . '/css/media_vimeo.css');
  drupal_add_js(drupal_get_path('module', 'media_vimeo') . '/js/flash_detect_min.js');
}


/**
 * Overriding HTML for an image.
 *
 * @param $variables
 *   An associative array containing:
 *   - path: Either the path of the image file (relative to base_path()) or a
 *     full URL.
 *   - width: The width of the image (if known).
 *   - height: The height of the image (if known).
 *   - alt: The alternative text for text-based browsers. HTML 4 and XHTML 1.0
 *     always require an alt attribute. The HTML 5 draft allows the alt
 *     attribute to be omitted in some cases. Therefore, this variable defaults
 *     to an empty string, but can be set to NULL for the attribute to be
 *     omitted. Usually, neither omission nor an empty string satisfies
 *     accessibility requirements, so it is strongly encouraged for code calling
 *     theme('image') to pass a meaningful value for this variable.
 *     - http://www.w3.org/TR/REC-html40/struct/objects.html#h-13.8
 *     - http://www.w3.org/TR/xhtml1/dtds.html
 *     - http://dev.w3.org/html5/spec/Overview.html#alt
 *   - title: The title text is displayed when the image is hovered in some
 *     popular browsers.
 *   - attributes: Associative array of attributes to be placed in the img tag.
 */
function glossy_image($variables) {
  $attributes = $variables['attributes'];
  $attributes['src'] = file_create_url($variables['path']);

  foreach (array('width', 'height', 'alt', 'title') as $key) {
    if (isset($variables[$key])) {
      $attributes[$key] = $variables[$key];
    }
  }

	$output = '<img' . drupal_attributes($attributes) . ' />';
	$class = '';
	if (isset($attributes['preload']) && $attributes['preload'] == TRUE) {
		$class = ' preload';
	}
	$output = '<span class="img-wrapper' .$class. '">' . $output . '</span>';
  return 	$output;
}

/**
 * Overriding HTML for an image field formatter.
 *
 * @param $variables
 *   An associative array containing:
 *   - item: An array of image data.
 *   - image_style: An optional image style.
 *   - path: An array containing the link 'path' and link 'options'.
 *
 * @ingroup themeable
 */
function glossy_image_formatter($variables) {
  $item = $variables['item'];
  $image = array(
    'path' => $item['uri'],
    'alt' => $item['alt'],
  );
	
  if (isset($item['width']) && isset($item['height'])) {
    $image['width'] = $item['width'];
    $image['height'] = $item['height'];
  }

  // Do not output an empty 'title' attribute.
  if (isset($item['title']) && drupal_strlen($item['title']) > 0) {
    $image['title'] = $item['title'];
  } 
	
	 if (isset($item['preload']) && $item['preload'] == TRUE) {
    $image['attributes']['preload'] = TRUE;
  }else {
		$image['attributes']['preload'] = TRUE;
	}
	
  if ($variables['image_style']) {
    $image['style_name'] = $variables['image_style'];
    $output = theme('image_style', $image);
  }else {
    $output = theme('image', $image);
  }

  if (!empty($variables['path']['path'])) {
		$variables['path']['options']['attributes']['class'][] = 'img-container';
    $path = $variables['path']['path'];
    $options = $variables['path']['options'];
    // When displaying an image inside a link, the html option must be TRUE.
    $options['html'] = TRUE;
    $output = l($output, $path, $options);
  }else{
		$options = array();
		$output  = '<div class="img-container">' .$output. '</div>';
	}

  return $output;
}

/**
* Override theme_image_style().
* Use the required image style as usual, except if a special
* imagestylename_themename style exists, in which case that style
* overrides the default.
*/
function glossy_image_style($variables) {
  global $theme;
  if (array_key_exists($variables['style_name'] . '_' . $theme, image_styles())) {
    $variables['style_name'] = $variables['style_name'] . '_' . $theme;
  }

  // Starting with Drupal 7.9, the width and height attributes are
  // added to the img tag. Adding the if clause to conserve
  // compatibility with Drupal < 7.9
  if (function_exists('image_style_transform_dimensions')) {
    // Determine the dimensions of the styled image.
    $dimensions = array(
      'width' => $variables['width'],
      'height' => $variables['height'],
    );

    image_style_transform_dimensions($variables['style_name'], $dimensions);

    $variables['width'] = $dimensions['width'];
    $variables['height'] = $dimensions['height'];
  }

  $variables['path'] = image_style_url($variables['style_name'], $variables['path']);
  return theme('image', $variables);
}

/**
 * Overriding HTML for a marker for required form elements.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *
 * @ingroup themeable
 */
function glossy_form_required_marker($variables) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();
  $attributes = array(
    'class' => 'form-required',
    'title' => $t('This field is required.'),
  );
  return '*';
}
