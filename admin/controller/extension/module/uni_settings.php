<?php
	if(!defined('DIR_SYSTEM')) {
		die('Access denied');
	}

	ini_set('display_errors', 0);
	
	$unlink_files = [
		DIR_SYSTEM.'unishop2_admin.ocmod.xml',
		DIR_SYSTEM.'unishop2.news.ocmod.xml',
		DIR_SYSTEM.'unishop2.ocmod.xml'
	];
	
	foreach ($unlink_files as $file) {
		if (file_exists($file)) {
			unlink($file);
		}
	}
	
	$style = 'padding:10px;text-align:center;background:#f2766b;color:#fff';
	
	if((int)ini_get('max_input_vars') < 2000) {
		echo '<div class="uni-alert" style="'.$style.'">Attention! Increase the "max_input_vars" parameter in your hosting settings to 2000. Present value: '. (int)ini_get('max_input_vars') .'</div>';
	} else if ((int)ini_get('suhosin.post.max_vars') > 0 && (int)ini_get('suhosin.post.max_vars') < 2000) {
		echo '<div class="uni-alert" style="'.$style.'">Attention! Increase the "suhosin.post.max_vars" parameter in the hosting settings to 2000. Present value: '. (int)ini_get('suhosin.post.max_vars') .'</div>';
	}

	$version = explode('.', PHP_VERSION);
			
	if($version[0] == 5 && $version[1] >= 6) {
		include_once('uni_part1.php');
	} elseif ($version[0] == 7 && ($version[1] >= 1 && $version[1] <= 4)) {
		include_once('uni_part2.php');
	} else {
		echo 'Your version PHP ('.PHP_VERSION.') is not support';
		echo '<br /><br />';
		echo 'Supported version: 5.6, 7.1 - 7.4';
	}
?>