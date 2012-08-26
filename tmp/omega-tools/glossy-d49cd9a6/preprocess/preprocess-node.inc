<?php

/**
 * Node preprocessing
 */

function glossy_alpha_preprocess_node(&$vars) {
  $node_top_blocks = block_get_blocks_by_region('node_top');
  $node_bottom_blocks = block_get_blocks_by_region('node_bottom');
  $vars['node_top'] = $node_top_blocks ? $node_top_blocks : false; 
  $vars['node_bottom'] = $node_bottom_blocks ? $node_bottom_blocks : false; 
}