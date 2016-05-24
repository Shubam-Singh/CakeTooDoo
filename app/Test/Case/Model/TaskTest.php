<?php
App::uses('Task','Model');

class TaskTest extends CakeTestCase {

    public $fixtures = array('app.task');

    public function setUp() {

      parent::setUp();
      $this->Task = ClassRegistry::init('Task');

    }
    public function testFindDoneTasks() {

        $result = $this->Task->findDoneTasks();
        $expected = array(
             array(

                'Task' => array(
                    'id'=>'17',
                    'title'=>'first task',
                    'done'=> 1,
                    'created'=>'2016-05-19 17:46:43',
                    'modified'=>'2016-05-19 17:48:16'
                )

            ),
             array(
                'Task' => array(
                    'id'=>'18',
                    'title'=>'second task',
                    'done' => 1,
                    'created'=>'2016-05-19 17:46:51',
                    'modified'=>'2016-05-19 17:53:07'
                )
            )
        );

        $this->assertEquals($expected,$result);

    }
    /**
     * @expectedException InternalErrorException
     */
    public function testNoSaveData(){

            $this->Task->saveData();

    }
//    public function testFalseSaveData()
//    {
//
//        $data = array(
//            array(
//            'Task' => array(
//                //'id' => '22',
//                'title' => '12345',
//                'done' => 0,
//               // 'created' => '2016-05-19 17:46:51',
//               // 'modified' => '2016-05-19 17:53:07'
//            )),array(
//            'Task' => array(
//              //  'id' => '23',
//                'title' => '$$$$$',
//                'done' => 0,
//               // 'created' => '2016-05-19 17:46:51',
//              //  'modified' => '2016-05-19 17:53:07'
//            )),array(
//            'Task' => array(
//              //  'id' => '24',
//                'title' => '#$#$#',
//                'done' => 0,
//               // 'created' => '2016-05-19 17:46:51',
//               // 'modified' => '2016-05-19 17:53:07'
//            ))
//        );
//        for($i=0; $i < count($data)-1; $i++) {
//
//            $result = $this->Task->saveData($data[$i]);
//            $this->assertFalse($result, 'Input to title should not be numbers and symbols');
//
//        }
//    }

    public function testTrueSaveData() {
        $data = array(
            array(
                'Task' => array(
                  //  'id' => '55',
                    'title' => 'Task one',
                    'done' => 0,
                 //   'created' => '2016-05-19 17:46:51',
                 //   'modified' => '2016-05-19 17:53:07'
                )),array(
                'Task' => array(
                 //   'id' => '56',
                    'title' => 'Test two',
                    'done' => 0,
                 //   'created' => '2016-05-19 17:46:51',
                 //   'modified' => '2016-05-19 17:53:07'
                )),array(
                'Task' => array(
                 //   'id' => '57',
                    'title' => 'Task three',
                    'done' => 0,
                 //   'created' => '2016-05-19 17:46:51',
                  //  'modified' => '2016-05-19 17:53:07'
                ))
        );
        for($i=0; $i < count($data)-1; $i++) {

            $result = $this->Task->saveData($data[$i]);
            $this->assertTrue($result);

        }

    }
    public function testFindAllTasks() {

        $result = $this->Task->findAllTasks();
        $expected = array(
            array(

                'Task' => array(
                    'id'=>'17',
                    'title'=>'first task',
                    'done'=> 1,
                    'created'=>'2016-05-19 17:46:43',
                    'modified'=>'2016-05-19 17:48:16'
                )

            ),
            array(
                'Task' => array(
                    'id'=>'18',
                    'title'=>'second task',
                    'done' => 1,
                    'created'=>'2016-05-19 17:46:51',
                    'modified'=>'2016-05-19 17:53:07'
                )
            ),
            array(
                'Task' => array(
                    'id'=>'19',
                    'title'=>'third task',
                    'done' => 0,
                    'created'=>'2016-05-19 17:53:52',
                    'modified'=>'2016-05-19 17:53:52'
                )
            ),
            array(
                'Task' => array(
                    'id'=>'20',
                    'title'=>'fourth task',
                    'done' => 0,
                    'created'=>'2016-05-20 11:56:07',
                    'modified'=>'2016-05-20 11:56:07'
                )
            )
        );

        $this->assertEquals($expected,$result);
    }

    function testFindPendingTasks(){
        $expected = array(
            array(
                'Task' => array(
                    'id'=>'19',
                    'title'=>'third task',
                    'done' => 0,
                    'created'=>'2016-05-19 17:53:52',
                    'modified'=>'2016-05-19 17:53:52'
                )
            ),
            array(
                'Task' => array(
                    'id'=>'20',
                    'title'=>'fourth task',
                    'done' => 0,
                    'created'=>'2016-05-20 11:56:07',
                    'modified'=>'2016-05-20 11:56:07'
                )
            )

        );

        $result = $this->Task->findPendingTasks();

        $this->assertEquals($expected,$result);
    }

    /**
     * @expectedException MethodNotAllowedException
     */


    function testFalseDeleteDataById(){
        $id = null;
        $result = $this->Task->deleteDataById($id);
        $this->expectException('MethodNotAllowedException','No id found!');
    }

    function testTrueDeleteDataById(){
        $id = 17;
        $result = $this->Task->deleteDataById($id);
        $expected = true;
        $this->assertEquals($expected,$result);
    }
    /**
     * @expectedException MethodNotAllowedException
     */

    function testDeleteDataById(){
        $id = 'aa';
        $result = $this->Task->deleteDataById($id);
        $this->expectException('MethodNotAllowedException','Record Not found');
    }

    /**
     * @expectedException MethodNotAllowedException
     */
    
    function testFalseFindDataById() {
        $id = array(null,'@@@','aaa');
        for($i=0; $i< count($id)-1; $i++) {
        $result = $this->Task->findDataById($id[$i]);
        $this->expectException('MethodNotAllowedException','No such Id');
        }
    }

    function testTrueFindDataById() {
        $id = 17;
        $result = $this->Task->findDataById($id);
        $expected = array(

                'Task' => array(
                    'id'=>'17',
                    'title'=>'first task',
                    'done'=> 1,
                    'created'=>'2016-05-19 17:46:43',
                    'modified'=>'2016-05-19 17:48:16'
                )

        );
        $this->assertEquals($expected,$result);

    }

    /**
     * @expectedException ErrorException
     */

    function testPrepare(){

        $result = $this->Task->prepare();
        $this->assertTrue($result);
    }

}
?>
