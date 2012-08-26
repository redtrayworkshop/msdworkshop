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
	
// Print only portfolio item
$data = $row->field_field_portfolio_image;
if (!count($data)) {
	return;
}

$file = $data[0]['rendered'];
// assign image style
$style = isset($file['#image_style']) && !empty($file['#image_style']) ? $file['#image_style'] :
 variable_get('glossy_style_ff_slideshow', 'front_featured_slideshow_image');
?>

<Image Source="<?php print image_style_url($style, $file['#item']['uri']); ?>" Title="<?php print $file['#item']['title']; ?>">
	<Text><h1><?php print $row->node_title; ?></h1><?php print array_shift($row->field_body[0]['rendered']); ?></Text>
	<Hyperlink URL="<?php print url('node/' . $row->nid); ?>" Target="_self"/>
</Image>

