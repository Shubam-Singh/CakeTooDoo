<h2>Tasks</h2>
<?php if(empty($tasks)): ?>
	There are no tasks in this list
<?php else: ?>
	 <table>
	            <tr>
		<th>Title</th>
		<th>Status</th>
		<th>Created</th>
		<th>Modified</th>
		<th>Actions</th>
	           </tr>
 <?php foreach ($tasks as $task): ?>
 <tr>
	<td>
		<?php echo $task['Task']['title'] ?>
	</td>
	<td>
		<?php
			if($task['Task']['done']) echo "Done";
			else echo "Pending";
		 ?>
	 </td>
	 <td>
		<?php echo $this->Time->niceShort($task['Task']['created']) ?>
	</td>
	<td>
		<?php echo $this->Time->niceShort($task['Task']['modified']) ?>
 	</td>
	 <td>
		 <?php echo $this->Html->link('Edit',array('action'=>'edit',$task['Task']['id'])) ?>
		 <?php echo $this->Html->link('Delete',array('action'=>'delete',$task['Task']['id'])) ?>
	</td>

 </tr>
 <?php endforeach; ?>
</table>
<?php endif; ?>
<?php echo $this->Html->link('Add Task', array('action'=>'add')) ?><br />
<?php if($status): ?>
        <?php echo $this->Html->link('List All Tasks', array('action'=>'index')); ?><br />
<?php endif;?>
<?php if($status != 'done'): ?>
       <?php echo $this->Html->link('List Done Tasks', array('action'=>'index', 'done')); ?>
<br />
<?php endif;?>
<?php if($status != 'pending'): ?>
	 <?php echo $this->Html->link('List Pending Tasks', array('action'=>
				'index', 'pending')); ?><br />
<?php endif;?>
