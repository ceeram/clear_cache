<?php
/**
 * ClearCache Panel Element
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
 * @package       ClearCache.View.Elements
 */
?>
<h2><?php echo __d('clear_cache', 'Clear Cache'); ?></h2>
<div class="debug-info clear-cache-links"><?php
	$linkUrl = array('plugin' => 'clear_cache', 'controller' => 'toolbar_access', 'prefix' => false);
	if (empty($content['folders'])) {
		echo '<p class="info">' . __d('clear_cache', 'No configured/allowed folder names.') . '</p>';
	} else {
		$linkUrl['action'] = 'files';
		$last = count($content['folders']) - 1;
		foreach ($content['folders'] as $key => $fileMask) {
			echo $this->Html->link(
				empty($fileMask) ? __d('clear_cache', 'All Cached Files') : $fileMask,
				empty($fileMask) ? $linkUrl : $linkUrl + array($fileMask)
			);
			if ($key < $last) {
				echo '&nbsp;|&nbsp;';
			}
		}
	}
?></div>
<div class="debug-info clear-cache-links"><?php
	if (empty($content['engines'])) {
		echo '<p class="info">' . __d('clear_cache', 'No configured/allowed cache engines.') . '</p>';
	} else {
		$linkUrl['action'] = 'engines';
		$last = count($content['engines']) - 1;
		foreach ($content['engines'] as $key => $engine) {
			echo $this->Html->link(
				empty($engine) ? __d('clear_cache', 'All Cache Engines') : $engine,
				empty($engine) ? $linkUrl : $linkUrl + array($engine)
			);
			if ($key < $last) {
				echo '&nbsp;|&nbsp;';
			}
		}
	}
?></div>

<h3><?php echo __d('clear_cache', 'Result'); ?></h3>
<div class="debug-info" id="clear-cache-output">
	<p class="info"><?php echo __d('clear_cache', 'Click on some link above.'); ?></p>
</div>

<script type="text/javascript">
//<![CDATA[
DEBUGKIT.module('clearCache');
DEBUGKIT.clearCache = function () {
	var $ = DEBUGKIT.$;
	return {
		init : function () {
			var cacheLinks = $('div.clear-cache-links').find('a');
			var cacheOutput = $('#clear-cache-output');
			var clearCache = function (event) {
				event.preventDefault();
				var request = $.ajax({
					url: this.href,
					success : function (response) {
						cacheOutput.html(response);
					},
					error : function () {
						cacheOutput.html('<p class="info"><?php echo __d('clear_cache', 'Could not fetch ClearCache output.'); ?></p>');
					}
				});
			};
			cacheLinks.on('click', clearCache);
		}
	};
}();
DEBUGKIT.loader.register(DEBUGKIT.clearCache);
//]]>
</script>
