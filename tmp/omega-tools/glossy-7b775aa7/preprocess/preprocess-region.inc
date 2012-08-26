<?php

/**
 * Region preprocessing
 */
function glossy_alpha_preprocess_region(&$vars) {
	$vars['attributes_array']['class'][] = 'clearfix';
}