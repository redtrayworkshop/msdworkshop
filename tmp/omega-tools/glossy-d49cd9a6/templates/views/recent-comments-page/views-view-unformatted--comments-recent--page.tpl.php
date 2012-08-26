<?php
/**
 * @file views-view-unformatted--comments-recent--page.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <article class="<?php print $classes_array[$id]; ?> comment">
		<?php print $row; ?>
  </article>
<?php endforeach; ?>