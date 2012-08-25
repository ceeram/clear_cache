<?php
/**
 * ClearCacheCaches Controller
 *
 * List configured caches and provide an interface to clear one at a time
 *
 * PHP 5
 *
 * Copyright 2010-2012, Marc Ypes, The Netherlands
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     2010-2012 Marc Ypes, The Netherlands
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('ClearCacheAppController', 'ClearCache.Controller');
App::uses('ClearCache', 'ClearCache.Lib');

class CachesController extends ClearCacheAppController {

/**
 * no model is needed
 */
	public $uses = array();

/**
 * helpers
 */
	public $helpers = array(
		'Form',
	);

/**
 * admin_index
 */
	public function admin_index() {
		$this->set('caches', Cache::configured());
	}

/**
 * admin_clear
 */
	public function admin_clear() {
		if (isset($this->request->params['pass'][0])) {
			$config = $this->request->params['pass'][0];
			$cleared = Cache::clear(false, $config);
			$message = $cleared ? __('Cache %s has been cleared', $config) : __('Cache cannot be cleared. Check server logs');
			$this->Session->setFlash($message);
		}
		$this->redirect(array('action' => 'index'));
	}

}
