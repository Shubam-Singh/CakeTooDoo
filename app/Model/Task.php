<?php
class Task extends AppModel
{
    var $name = 'Task';
    var $validate = array('title' => array('rule' => 'notEmpty', 'message' => 'Title of a task cannot be empty'));

    function findDoneTasks() {
        return $this->find('all', array(
            'conditions' => array(
                'Task.done' => '1'
            )
        ));
    }

    function findPendingTasks() {
        return $this->find('all', array(
            'conditions' => array(
                'Task.done' => '0'
            )
        ));
    }

    function findAllTasks() {
        return $this->find('all');
    }

    function prepare() {  // function to prepare the task model to add or edit data
        if($this->create()) {
            return true;
        }
        else
            throw new ErrorException;
    }

    function saveData($data = null) {
        if($data) {
            if ($this->save($data)) {
                return true;
            } else
                throw new InternalErrorException;
        } else {
            throw new InternalErrorException;
        }
    }

    function findDataById($id = null) {

        $title= $this->find('first', array(
            'conditions' => array(
                'id' => $id
            )
        ));

        if($title == null){
            throw new MethodNotAllowedException('No such Id');
        }
        else
            return $title;
    }
    function deleteDataById($id=null)
    {
        if ($id) {

            if ($this->delete($id)) {
                return true;
            } else {
                throw new MethodNotAllowedException('Record not found');
            }
        }
        else {
            throw new MethodNotAllowedException('No id found!');
        }
    }


}
?>
