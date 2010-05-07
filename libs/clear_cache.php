<?php

class ClearCache {

	public function files($folders = array()) {
		$deleted = $error = array();

		if ($folders) {
			$files = glob(CACHE . '{' . implode(',', $folders) . '}' . DS . '*', GLOB_BRACE);
		} else {
			$files = glob(CACHE . '*' . DS . '*');
		}

		foreach ($files as $file) {
			if (is_file($file) && basename($file) !== 'empty') {
				if (unlink($file)) {
					$deleted[] = $file;
				} else {
					$error[] = $file;
				}
			}
		}

		return compact('deleted', 'error');
	}
}
?>