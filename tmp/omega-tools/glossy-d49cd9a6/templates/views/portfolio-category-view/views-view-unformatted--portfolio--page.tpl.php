<?php
/**
 * @file views-view-unformatted--portfolio--page.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
// add needed scripts and css files if isotope filter feature is enabled in theme settings.
if (glossy_helper_get_theme_setting('glossy_portfolio_isotope_enabled') == 1) {
	$path = libraries_get_path('isotope-site');
	drupal_add_js($path .'/jquery.isotope.min.js', array('group' => JS_THEME));
	drupal_add_js(drupal_get_path('theme', 'glossy') .'/js/portfolio-isotope.js', array('group' => JS_THEME));
	// add Cascading style sheet
	drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/portfolio-isotope.css', array('group' => CSS_THEME));
} else {
	drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/portfolio.css', array('group' => CSS_THEME));
}
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div id="iso-container" class='content hover_fade preload-container clearfix'>
<?php foreach ($rows as $id => $row): ?>
	<?php if (($id+1) % 2 == 0) {
		$init_class = 'even';
	}else {
		$init_class = 'odd';
	}
	?>
	
	<?php if (($id) % 4 == 0 || $id == 0): ?>
		<div class='element-outer alpha <?php print $init_class; ?>'>
	<?php elseif (($id+1) % 4 == 0): ?>
		<div class='element-outer omega <?php print $init_class; ?>'>
	<?php else: ?>
		<div class='element-outer <?php print $init_class; ?>'>
	<?php endif; ?>
			<?php print $row; ?>
		</div>
<?php endforeach; ?>
</div>