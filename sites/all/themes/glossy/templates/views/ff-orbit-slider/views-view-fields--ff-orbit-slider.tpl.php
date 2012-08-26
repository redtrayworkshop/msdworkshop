<?php
/**
 * @file views-view-fields--ff-orbit-slider.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
 //dpm($view->result[0]);
if (!isset($view->result) || !count($view->result)) {
	exit();
}

// caption array
$captions = array();
?>

<div id="responsive-orbit-slider" class="orbit-slider">
<?php foreach ($view->result as $id => $row): ?>
	<?php 
		$data = $row->field_field_portfolio_image;
		if (!count($data)) {
			continue;
		}
		
		$image = $data[0]['raw'];
		
		// add captions to an empty array
		if (isset($image['title'])) {
			$captions["caption-fid-" . $image['fid']] = $image['title'];
		}
		
		$file = $data[0]['rendered'];
		// assign iamge style
		$style = isset($file['#image_style']) && !empty($file['#image_style']) ? $file['#image_style'] :
		variable_get('glossy_style_ff_slideshow', 'front_featured_slideshow_image');
	?>
		<img src="<?php print image_style_url($style, $file['#item']['uri']); ?>" alt="<?php print $image['alt']; ?>" title="<?php print $image['title']; ?>" data-caption="#caption-fid-<?php print $image['fid']; ?>" />
<?php endforeach;?>
</div>

<!-- Captions for Orbit -->
<div id="orbit-captions">
	<?php foreach ($captions as $id => $caption): ?>
		<div id="<?php print $id; ?>" class="orbit-caption">
			 <a href="<?php print url('node/' . $row->nid); ?>"><?php print $caption; ?></a>
		</div>
	<?php endforeach;?>
</div>


