<?php
/**
 * @file views-view-list--ff-AnythingSlider.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
$path = libraries_get_path('AnythingSlider');

// add Cascading style sheet
drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/anythingslider.css', array('group' => CSS_THEME));
drupal_add_js($path .'/js/jquery.anythingslider.js', array('group' => JS_THEME));
drupal_add_js($path .'/js/jquery.easing.1.2.js', array('group' => JS_THEME));
drupal_add_js($path .'/js/jquery.anythingslider.video.js', array('group' => JS_THEME));
drupal_add_js(drupal_get_path('theme', 'glossy') . '/js/AnythingSlider.js', array('group' => JS_THEME));
?>
<div id='slider'>
	<div class='play_control'>&nbsp;</div>
	<?php print $wrapper_prefix; ?>
		<?php print $list_type_prefix; ?>
			<?php foreach ($rows as $id => $row): ?>
				<li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
			<?php endforeach; ?>
		<?php print $list_type_suffix; ?>
	<?php print $wrapper_suffix; ?>
</div>