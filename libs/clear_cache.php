<?php

App::import('Folder');
class ClearCache {

	function run() {
		clearCache();
		$return = array();
		$paths = array(
			TMP . 'cache' . DS . 'models',
			TMP . 'cache' . DS . 'persistent',
			TMP . 'cache' . DS . 'views',
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