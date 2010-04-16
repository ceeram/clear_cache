<?php

App::import('Libs', 'ClearCache.ClearCache');
class ClearCacheShell extends Shell {

	function main()	{
		$ClearCache = new ClearCache();
		$output = $ClearCache->run();
		foreach ($output as $out) {
			$this->out('Deleted ' . $out);
		}
	}
}

?>