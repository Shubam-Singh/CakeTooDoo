<?php
class TasksController extends AppController
{
    var $name = 'Tasks';
    var $helpers = array('Html', 'Form', 'Time');

    function index($status = null)
    {
        if ($status == 'done') {
            $tasks = $this->Task->findDoneTasks();
        } else if ($status == 'pending') {
            $tasks = $this->Task->findPendingTasks();
        } else
            $tasks = $this->Task->findAllTasks();

        $this->set('tasks', $tasks);
        $this->set('status', $status);
    }

    function add()
    {
        if (!empty($this->data)) {
            $this->Task->prepare();
            if ($this->Task->saveData($this->data)) {
                $this->Session->setFlash('The Task has been saved');
                $this->redirect(array(
                    'action' => 'index'
                ), null, true);
            } else {
                $this->Session->setFlash('Task not saved. Try again.');
            }
        }
    }

    function edit($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Invalid Task');
            $this->redirect(array(
                'action' => 'index'
            ), null, true);
        }
        if (empty($this->data)) {
            $this->data = $this->Task->findDataById($id);
        } else {
            if ($this->Task->saveData($this->data)) {
                $this->Session->setFlash('The Task has been saved');
                $this->redirect(array(
                    'action' => 'index'
                ), null, true);
            } else {
                $this->Session->setFlash('The Task could not be saved.Please, try again.');
            }

        }
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash('Invalid id for the task');
            $this->redirect(array(
                'action' => index
            ), null, true);
        }
        if ($this->Task->deleteDataById($id)) {
            $this->Session->setFlash('Task #' . $id . ' deleted');
            $this->redirect(array(
                'action' => 'index'
            ), null, true);
        }

    }
}
?>
