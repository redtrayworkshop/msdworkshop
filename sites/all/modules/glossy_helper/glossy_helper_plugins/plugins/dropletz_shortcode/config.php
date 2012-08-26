<?php
	// reversing directories untill we find authorize.php file
	$drupal_include = "../includes/bootstrap.inc";
	$i = 0;
	while (!file_exists($drupal_include) && $i++ < 20) {
		$drupal_include = "../" . $drupal_include;
	}
	
	if (file_exists($drupal_include)) {
		$main_dir = preg_replace('/includes\/bootstrap\.inc/i', '', $drupal_include);
		define('DRUPAL_ROOT', $main_dir);
		require_once $main_dir . 'includes/bootstrap.inc';
		drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
	}
?>