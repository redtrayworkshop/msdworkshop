<?php
/**
 * @file views-view-list--ff-slideshow--ff-flex-slider.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
$path = libraries_get_path('FlexSlider');

// add Cascading style sheet
drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/flexslider.css', array('group' => CSS_THEME));
drupal_add_js($path .'/jquery.flexslider-min.js', array('group' => JS_THEME));
drupal_add_js(drupal_get_path('theme', 'glossy') . '/js/flexslider.js', array('group' => JS_THEME));
drupal_add_css(drupal_get_path('theme', 'glossy') . '/css/flexslider.style.css', array('group' => CSS_THEME));

$image_assets = variable_get('glossy_img_assets', drupal_get_path('theme', 'glossy') . '/img');
?>
<div class='flexslider-wrapper'>
	<span class="img-wrapper preload flex_preloader clearfix" style="text-align:center;">
		<img src="<?php print url($image_assets);?>/transparent.gif" style="background-image: url('<?php print url($image_assets); ?>/preloader.png');" />
	</span>
	<div class='flexslider'>
		<ul class='slides'>
			<?php foreach ($rows as $id => $row): ?>
				<li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>