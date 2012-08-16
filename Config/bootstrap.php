<?php

if (class_exists('CroogoNav')) {
	CroogoNav::add('extensions.children.clear_cache', array(
		'title' => 'Clear Cache',
		'url' => array(
			'plugin' => 'clear_cache',
			'controller' => 'clear_cache',
			'action' => 'all',
		),
		'children' => array(
			'all' => array(
				'title' => __('All'),
				'url' => array(
					'plugin' => 'clear_cache',
					'controller' => 'clear_cache',
					'action' => 'all',
				),
			),
			'files' => array(
				'title' => __('Files'),
				'url' => array(
					'plugin' => 'clear_cache',
					'controller' => 'clear_cache',
					'action' => 'files',
				),
			),
			'engines' => array(
				'title' => __('Engines'),
				'url' => array(
					'plugin' => 'clear_cache',
					'controller' => 'clear_cache',
					'action' => 'engines',
				),
			),
		),
	));
}
