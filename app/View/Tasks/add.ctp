<?php echo $this->Form->create('Task');?>
<fieldset>
	<legend>Add New Task</legend>
	<?php
		 echo $this->Form->input('title');
		 echo $this->Form->input('done');
	 ?>
</fieldset>
<?php echo $this->Form->end('Add Task');?>
<?php echo $this->Html->link('List All Tasks', array('action'=>'index')); ?>
