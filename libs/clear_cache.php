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
 * @param mixed any amount of strings - keys of configure cache engines
 * @return array associative array with cleanup results
 * @access public
 */
	function engines() {
		$result = array();

		if (method_exists('Cache', 'configured')) {
			$keys = Cache::configured();
		} else {
			if (PHP5) {
				$Cache = Cache::getInstance();
			} else {
				$Cache =& Cache::getInstance();
			}
			$keys = array_keys($Cache->__config);
		}

		if ($engines = func_get_args()) {
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
 * @param mixed any amount of strings - names of CACHE subfolders or '.' (dot) for CACHE folder itself
 * @return array associative array with cleanup results
 * @access public
 */
	function files() {
		$deleted = $error = array();

		$folders = func_get_args();
		if (empty($folders)) {
			$folders = array('.', '*');
		}

		if (count($folders) > 1) {
			$files = glob(CACHE . '{' . implode(',', $folders) . '}' . DS . '*', GLOB_BRACE);
		} else {
			$files = glob(CACHE . $folders[0] . DS . '*');
		}

		foreach ($files as $file) {
			if (is_file($file) && basename($file) !== 'empty') {
				if (unlink($file)) {
					$deleted[] = $file;
				} else {
					$error[] = $file;
				}
			} elseif(is_dir($file)) {
				$results = $this->files(substr($file, strlen(CACHE)));
				$deleted = am($deleted, $results['deleted']);
				$error = am($error, $results['error']);
				unset($results);
				if (!in_array($file, array(CACHE . './models', CACHE . './persistent', CACHE . './views'))) {
					rmdir($file);
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
	function run() {
		$files = $this->files();
		$engines = $this->engines();

		return compact('files', 'engines');
	}

}
?>