<?php
	define('SWITCH_CACHE', __DIR__.'/switches.json');

	require(__DIR__.'/orvfms/orvfms.php');

	$cmd = $argv[1];

	function getSwitches($refresh = false) {
		if ($refresh || !file_exists(SWITCH_CACHE)) {
			$switches = initS20Data();
	    // Convert names to utf-8 to allow json encoding
	    $switches = array_map(function($switch) {
	      $switch['name'] = mb_convert_encoding($switch['name'], 'UTF-8');
	      return $switch;
	    }, $switches);
			file_put_contents(SWITCH_CACHE, json_encode($switches));
		} else {
			$switches = json_decode(file_get_contents(SWITCH_CACHE), $assoc = true);
		}
		return $switches;
	}

	switch ($cmd) {
		case 'list':
			echo json_encode(getSwitches());
		break;
		case 'on':
			$switches = getSwitches();
			$switchId = count($argv) > 2 ? $argv[2] : array_keys($switches)[0];
			sendAction($switchId, 1, $switches);
		break;
		case 'off':
			$switches = getSwitches();
			$switchId = count($argv) > 2 ? $argv[2] : array_keys($switches)[0];
			sendAction($switchId, 0, $switches);
		break;
	}
?>
