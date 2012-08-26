<?php
/**
 * @file views-view-fields--ff-nivo-slider.tpl.php
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
$captions = array();
?>

<div id='slider' class="nivoSlider">
<?php foreach ($view->result as $id => $row): ?>
	<?php 
		$data = $row->field_field_portfolio_image;
		if (!count($data)) {
			continue;
		}
		
		$image = $row->field_field_portfolio_image[0]['raw'];
		// add captions to an empty array
		if (isset($image['title'])) {
			$captions["caption-fid-" . $image['fid']] = '<div class="header"><h3>' 
			.	l($row->node_title, 'node/' . $row->nid) . '</h3></div><div class="body">'  
			.	drupal_render($row->field_body)
			. '</div>'
			. l(t('read more'), 'node/' . $row->nid, array('attributes' => array('class' => array('button_link'))));
		}
		
		$file = $data[0]['rendered'];
		// assign iamge style
		$style = isset($file['#image_style']) && !empty($file['#image_style']) ? $file['#image_style'] :
		variable_get('glossy_style_ff_slideshow', 'front_featured_slideshow_image');
	?>
  <a href="<?php print url('node/' . $row->nid); ?>"><img src="<?php print image_style_url($style, $file['#item']['uri']); ?>" alt="<?php print $image['alt']; ?>" title="#caption-fid-<?php print $image['fid']; ?>"/></a>
<?php endforeach;?>
</div>

<div id="nivo-htmlcaptions">
	<?php foreach ($captions as $id => $caption): ?>
		<div id="<?php print $id; ?>" class="nivo-html-caption">
				<div class="nivo-caption-inner"><?php print $caption; ?></div>
		</div>
	<?php endforeach;?>
</div>