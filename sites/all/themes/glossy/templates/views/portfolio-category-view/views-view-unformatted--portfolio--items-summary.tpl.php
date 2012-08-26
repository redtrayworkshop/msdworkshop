<?php
/**
 * @file views-view-unformatted--portfolio--items-summary.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<section id='iso-options' class='clearfix'>
	<?php if (!empty($title)): ?>
		<h3><?php print $title; ?></h3>
	<?php endif; ?>
	<ul data-option-key="filter" class="option-set clearfix" id="iso-filters">
		<li class="active" ><a data-filter="*" href="#iso-filters"><?php print t('show all') ;?></a></li>
	<?php foreach ($rows as $id => $row): ?>
		<?php print $row; ?>
	<?php endforeach; ?>
	</ul>
</section>