<?php

App::import('Folder');
class ClearCache {

	function run() {
		clearCache();
		$return = array();

		$paths = array(
			CACHE . 'models',
			CACHE . 'persistent',
			CACHE . 'views',
		);
		$folder = new Folder();

		foreach ($paths as $path) {
			$folder->cd($path);
			$files = $folder->read();
			foreach ($files[1] as $file) {
				if ($file == 'empty') {
					continue;
				}
				$return[] = $path . DS . $file;
				unlink($path . DS . $file);
			}
		}
		return $return;
	}
}
?>