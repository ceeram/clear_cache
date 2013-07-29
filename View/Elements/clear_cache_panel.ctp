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

<div class="debug-info clear-cache-links"><?php echo $this->ClearLink->link($content, 'folders');?></div>
<div class="debug-info clear-cache-links"><?php echo $this->ClearLink->link($content, 'engines');?></div>
<div class="debug-info clear-cache-links"><?php echo $this->ClearLink->link($content, 'groups');?></div>

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
