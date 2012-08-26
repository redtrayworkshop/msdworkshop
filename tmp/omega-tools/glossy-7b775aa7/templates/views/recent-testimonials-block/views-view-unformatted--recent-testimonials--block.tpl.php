<?php
/**
 * @file views-view-list--recent-testimonials--block.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
drupal_add_css(drupal_get_path('theme', 'glossy') .'/css/testimonials.css', array('group' => CSS_THEME));
drupal_add_js(drupal_get_path('theme', 'glossy') .'/js/lib.tinycarousel.js', array('group' => JS_THEME));
drupal_add_js(drupal_get_path('theme', 'glossy') .'/js/testimonials.js', array('group' => JS_THEME));

?>
<?php if (!empty($title)) : ?>
	<h3><?php print $title; ?></h3>
<?php endif; ?>
<div id="recent-testimonials">
    <?php foreach ($rows as $id => $row): ?>
      <div class="item <?php print $classes_array[$id]; ?>"><?php print $row; ?></div>
    <?php endforeach; ?>
	<span class="testimonial_nav"><span class="testimonial_prev"><?php print t('Prev'); ?></span><span class="testimonial_next"><?php print t('Next'); ?></span></span>
</div>
	