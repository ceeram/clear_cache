<?php

class ClearCache {

	public function engines($engines = array()) {
		$result = array();

		$keys = Cache::configured();

		if ($engines) {
			$keys = array_intersect($keys, $engines);
		}

		foreach ($keys as $key) {
			$result[$key] = Cache::clear(false, $key);
		}

		return $result;
	}

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

	public function run() {
		$files = $this->files();
		$engines = $this->engines();

		return compact('files', 'engines');
	}

}
?>