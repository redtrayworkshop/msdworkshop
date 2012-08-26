<?php
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
// Print only video item
$data = $row->field_field_video;
if (!count($data)) {
	return;
}
$file = $data[0]['rendered'];

// assign iamge style
$style = isset($file['file']['#style_name']) && !empty($file['file']['#style_name']) ? $file['file']['#style_name'] :
 variable_get('glossy_ff_slideshow_style', 'front_featured_slideshow_image');
?>

<Image Source="<?php print image_style_url($style, $file['file']['#path']); ?>" Title="<?php print $row->node_title; ?>">
	<Text><p><?php print $row->node_title; ?></p></Text>
	<Hyperlink URL="<?php print url('node/' . $row->nid); ?>" Target="_self"/>
</Image>
