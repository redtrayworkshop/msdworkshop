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
$items = $row->field_field_portfolio_image;

$class = 'single-item';
if (count($items) > 1) {
	$class = 'slider';
}


$_items = array();

foreach ($items as $id => $item) {

	if (!isset($item['raw']['fid'])) {
		continue;
	}
	
	$_items[] = '<article class="slide-item">' 
	. theme($item['rendered']['#theme'], $item['rendered']) 
	. '<div class="caption"><p>' . $item['raw']['title']. '</p></div>'
	. '</article>';
}
?>

<script>
(function ($) {
$(document).ready(function() {
	$('#items-<?php print $row->nid; ?> .slider').wmuSlider({
            animation: 'fade',
            slide: 'article',
						slideshow: false,
  });
});
})(jQuery);
</script>

<?php
print '<div id="items-' . $row->nid . '" class="portfolio-images"><div class="' . $class . '">' . implode('', $_items) . '</div></div>'; 
?>

