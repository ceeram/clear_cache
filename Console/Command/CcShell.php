<?php
/**
 * CakePHP ClearCacheShell plugin
 *
 * Alias for ClearCacheShell
 * to shorten `Console/cake ClearCacheShell.clear_cache` to `Console/cake ClearCacheShell.cc`
 *
 * @copyright       Copyright © 2014 Oxicode
 * @link            http://Oxicode.io
 * @license         MIT License
 */
App::uses('ClearCacheShell', 'ClearCache.Console/Command');

class CCShell extends ClearCacheShell {
}
