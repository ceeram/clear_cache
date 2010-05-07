<?php

class ClearCacheShell extends Shell {

	protected $_Cleaner;

	public function main()	{
		$this->files();
		$this->engines();
	}

	public function engines() {
		$output = $this->_Cleaner->engines($this->args);

		foreach ($output as $key => $result) {
			$this->out($key . ': ' . ($result ? 'cleared' : 'error'));
		}
	}

	public function files() {
		$output = $this->_Cleaner->files($this->args);

		foreach ($output as $result => $files) {
			foreach ($files as $file) {
				$this->out($result . ': ' . $file);
			}
		}
	}

	public function startup() {
		App::import('Libs', 'ClearCache.ClearCache');
		$this->_Cleaner = new ClearCache();
	}
}

?>