<?php
/**
 * @file views-view.tpl.php
 * Main view template
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
drupal_add_http_header('Content-Type', 'text/xml; charset=utf-8');
print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

$pid = glossy_helper_get_theme_setting('ff_piecemaker_pid');
$profile = (array) piecemaker_profile_load($pid);
$settings = $profile['settings'];
$transitions = $profile['transitions'];
?>

<Piecemaker>
  <Contents>
		<?php if ($rows): ?>
			<?php print $rows; ?>
		<?php endif;?>
  </Contents>
  <Settings <?php print drupal_attributes($settings); ?>></Settings>			
  <Transitions>
    <?php foreach($transitions as $transition):?>
    <Transition <?php print drupal_attributes($transition); ?>></Transition> 
    <?php endforeach;?>
  </Transitions>
</Piecemaker>

<?php exit();?>
