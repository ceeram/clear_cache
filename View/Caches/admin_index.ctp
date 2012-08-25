<h2><?php echo __('Configured Caches'); ?></h2>
<table>
<tr>
	<th><?php echo __('Name'); ?></th>
	<th><?php echo __('Action'); ?></th>
</tr>
<?php foreach ($caches as $cacheName): ?>
<tr>
	<td><?php echo h($cacheName); ?>&nbsp;</td>
	<td><?php echo $this->Form->postLink(__('Clear'), array('action' => 'clear', $cacheName)); ?></td>
</tr>
<?php endforeach; ?>
</table>
