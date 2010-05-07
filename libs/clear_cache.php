<?php
/**
 * ClearCache library class
 *
 * PHP versions 4 and 5
 *
 * Copyright 2010, Marc Ypes, The Netherlands
 * 
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @package       app
 * @subpackage    app.plugins.clear_cache.libs
 * @copyright     2010 Marc Ypes, The Netherlands
 * @author        Ceeram
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Helps clear content of CACHE subfolders as well as content in cache engines
 *
 * @package       app
 * @subpackage    app.plugins.clear_cache.libs
 */
class ClearCache {

/**
 * Clears content of cache engines
 *
 * @param array $engines keys of cache engines for cleanup
 * @return array associative array with cleanup results
 * @access public
 */
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

/**
 * Clears content of CACHE subfolders
 *
 * @param array $folders subfolders of CACHE folder
 * @return array associative array with cleanup results
 * @access public
 */
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

/**
 * Clears content of CACHE subfolders and configured cache engines
 *
 * @return array associative array with cleanup results
 * @access public
 */
	public function run() {
		$files = $this->files();
		$engines = $this->engines();

		return compact('files', 'engines');
	}

}
?>