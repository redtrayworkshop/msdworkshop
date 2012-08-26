<?php
/**
 * @file views-view-unformatted--ff-orbit-slider.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
$path = libraries_get_path('orbit');

drupal_add_js(drupal_get_path('theme', 'glossy') .'/js/orbit-slider.js', array('group' => JS_THEME));
drupal_add_js($path .'/jquery.orbit-1.3.0.js', array('group' => JS_THEME));
drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/orbit-slider.css', array('group' => CSS_THEME));

?>
<?php foreach ($rows as $id => $row): ?>
	<?php print $row; break; ?>		
<?php endforeach; ?>
