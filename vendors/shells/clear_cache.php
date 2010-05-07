<?php
/**
 * ClearCache shell
 *
 * PHP versions 4 and 5
 *
 * Copyright 2010, Marc Ypes, The Netherlands
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @package       app
 * @subpackage    app.plugins.clear_cache.vendors.shells
 * @copyright     2010 Marc Ypes, The Netherlands
 * @author        Ceeram
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Helps clear content of CACHE subfolders as well as content in cache engines from console
 *
 * @package       app
 * @subpackage    app.plugins.clear_cache.vendors.shells
 * @property      ClearCache $_Cleaner
 */
class ClearCacheShell extends Shell {

/**
 * ClearCache instance
 *
 * @var ClearCache
 * @access protected
 */
	var $_Cleaner;

/**
 * Main shell method
 *
 * Clears content of CACHE subfolders and configured cache engines
 *
 * @return array associative array with cleanup results
 * @access public
 */
	function main()	{
		$this->files();
		$this->engines();
	}

/**
 * Clears content of cache engines
 *
 * @return void
 * @access public
 */
	function engines() {
		$output = call_user_func_array(array(&$this->_Cleaner, 'engines'), $this->args);

		foreach ($output as $key => $result) {
			$this->out($key . ': ' . ($result ? 'cleared' : 'error'));
		}
	}

/**
 * Clears content of CACHE subfolders
 *
 * @return void
 * @access public
 */
	function files() {
		$output = call_user_func_array(array(&$this->_Cleaner, 'files'), $this->args);

		foreach ($output as $result => $files) {
			foreach ($files as $file) {
				$this->out($result . ': ' . $file);
			}
		}
	}

/**
 * Shell startup
 *
 * Initializes $_Cleaner property
 *
 * @return void
 * @access public
 */
	function startup() {
		App::import('Libs', 'ClearCache.ClearCache');
		$this->_Cleaner = new ClearCache();
	}

}
?>