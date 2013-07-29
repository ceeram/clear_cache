<?php
/**
 * Description of ClearLinkHelper
 *
 * @author David Yell <neon1024@gmail.com>
 */

App::uses('AppHelper', 'View/Helper');

class ClearLinkHelper extends AppHelper {
	
/**
 * Load other helpers
 * 
 * @var array
 */
	public $helpers = array('Html');
	
/**
 * Generate a link to clear a cache
 * 
 * @param array $content
 * @param str $key
 */
	public function link($content = array(), $cache) {
		if (empty($content[$cache])) {
			return $this->Html->tag('p', __d('clear_cache', 'No configured/allowed folder names.'), array('class' => 'info'));
		} else {
			$linkUrl = array('plugin' => 'clear_cache', 'controller' => 'clear_cache', 'prefix' => false);;
			
			$out = __d('clear_cache', ucfirst($cache)) . ': ';
			switch ($cache) {
				case 'folders':
					$linkUrl['action'] = 'files';
					break;
				case 'engines':
					$linkUrl['action'] = 'engines';
					break;
				case 'groups':
					$linkUrl['action'] = 'groups';
					break;
			}
			
			foreach (Configure::read('Routing.prefixes') as $prefix) {
				$linkUrl[$prefix] = false;
			}
			
			$last = count($content[$cache]) - 1;
			
			foreach ($content[$cache] as $key => $mask) {
				if (empty($mask) || $mask == '_all_') {
					$out .= $this->Html->link(__d('clear_cache', 'All Cached Files'), $linkUrl);
				} else {
					$out .= $this->Html->link($mask, $linkUrl + array($mask));
				}
				if ($key < $last) {
					$out .= '&nbsp;|&nbsp;';
				}
			}
			
			return $out;
		}
	}
	
}