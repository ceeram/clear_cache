<?php
/**
 * CakePHP ClearCacheShell plugin
 *
 * Alias for ComposerShell
 * to shorten `Console/cake ClearCacheShell.composer` to `Console/cake ClearCacheShell.cc`
 *
 * @copyright       Copyright © 2014 Oxicode (http://Oxicode.io)
 * @link            http://opauth.org
 * @license         MIT License
 */
App::uses('ClearCacheShell', 'ClearCache.Console/Command');

class CCShell extends ClearCacheShell {
}
