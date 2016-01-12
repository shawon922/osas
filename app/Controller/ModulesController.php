<?php
App::uses('AppController', 'Controller');

class ModulesController extends AppController {    
    
    function beforeFilter() {
        parent::beforeFilter();
    }  
    
    public function index() 
    {
        
        $modelName = 'Module';
        $conditions = array();
        $this->paginate = array(
            'limit' => 20,
            'order' => 'Module.id DESC',
            'conditions' => 'Module.status = 1'
        );
        
        $modules = $this->paginate($modelName);
        
        $modulesAll = $this->Module->find( 'all' , array('conditions' => $conditions));
        $modulesArr = array();
        foreach ($modulesAll as $mRow) {
            $modulesArr[$mRow['Module']['id']] = $mRow['Module']['name'];
        }

        $title_for_layout = 'List of Module of this Application';
        $this->set(compact( 'modules', 'modulesArr', 'title_for_layout'));
    }
    
    public function add() 
    {
        
        if( ! empty($this->request->data) ) {
            $this->request->data['Module']['parent_id'] = $this->request->data['Module']['parent_id'] !='' ? $this->request->data['Module']['parent_id'] : 0;

            //Set value for common columns

            //get user's id from $userInfo array
            $this->request->data['Module']['created_by'] = $this->userInfo['id']; 

            //First time 'modified_by' is 0 (zero)
            $this->request->data['Module']['modified_by'] = 0; 

            //get IP address of user's pc. Method is available in AppController class
            $this->request->data['Module']['terminal'] = $this->getClientIp(); 

            //set status. By default 1
            $this->request->data['Module']['status'] = 1;
            
            if( $this->Module->save( $this->request->data ) ) {
                
                $this->Session->setFlash('Data has been saved.', 'default', array( 'class' => 'alert alert-success' ) );
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash( 'The Module could not be saved. Please try again.' , 'default', array('class' => 'alert alert-danger'));
            }
        }

        $modules = $this->Module->find('list',array('fields' => array('id', 'name'),'conditions'=>array('parent_id' => 0, 'status' => 1)));
        $title_for_layout = 'Add New Module';
        $this->set(compact('modules','title_for_layout'));
    }
    
    public function edit($id) 
    {
        if (!$this->Module->exists($id)) {
            throw new NotFoundException(__('Invalid Module'));
        }

        if( ! empty( $this->request->data ) ) {
            
            $this->Module->id = $id;

            //Set value for common columns

            //First time 'modified_by' is 0 (zero)
            $this->request->data['Module']['modified_by'] = $this->userInfo['id']; 

            //get IP address of user's pc. Method is available in AppController class
            $this->request->data['Module']['terminal'] = $this->getClientIp(); 

            //set status. By default 1
            $this->request->data['Module']['status'] = 1;

            if( $this->Module->save( $this->request->data ) ) {
                $this->Session->setFlash('Moudule has been modified.', 'default', array( 'class' => 'alert alert-success' ) );
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Module could not be modified. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
            $this->request->data = $this->Module->find('first', $options);
        }
        $modules = $this->Module->find('list',array('fields' => array('id', 'name'),'conditions'=>array('parent_id'=>0, 'status'=>1)));

        $title_for_layout = 'Edit Module';
        $this->set(compact('modules', 'title_for_layout'));
    }
        
    function changeStatus($id, $status) 
    {
        $this->Module->id = $id;
        if($this->Module->saveField("status", $status)) {
            $this->redirect(array('action'=>'index'));
        }
    }
    
}