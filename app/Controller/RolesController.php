<?php
App::uses('AppController', 'Controller');
App::uses('PrivilegesController', 'Controller');


class RolesController extends AppController {
	
	function beforeFilter() {
        parent::beforeFilter();
		//$this->allowedActions[$this->roleId][]= 'assignPrivilege';
    }  
    
	public function index() {		
		
		$roles = $this->Role->find( 'all', array('conditions' => array('Role.status'=> 1), 'recursive' => 2) );
        //pr($roles);
		$title_for_layout = 'User Roles';
        $this->set( compact( 'roles', 'title_for_layout') );
	}
    
    public function add() {
		
        if( ! empty($this->request->data) ) {
            
			//Set value for common columns

            //get user's id from $userInfo array
            $this->request->data['Role']['created_by'] = $this->userInfo['id']; 

            //First time 'modified_by' is 0 (zero)
            $this->request->data['Role']['modified_by'] = 0; 

            //get IP address of user's pc. Method is available in AppController class
            $this->request->data['Role']['terminal'] = $this->getClientIp(); 

            //set status. By default 1
            $this->request->data['Role']['status'] = 1;

            if( $this->Role->save( $this->request->data ) ) {
                
                $this->Session->setFlash( 'Role has been saved.', 'default', array( 'class' => 'alert alert-success' ) );
                
                $this->redirect( array( 'action' => 'index') );
            } else {
                $this->Session->setFlash('The Role could not be saved. Please try again', 'default', array('class' => 'alert alert-danger'));
            }
        }
        
        $this->set( 'title_for_layout', 'Add Role' );
    }
    
    public function edit($id) {
        if (!$this->Role->exists($id)) {
            throw new NotFoundException(__('Invalid Role.'));
        }
        
        if( ! empty( $this->request->data ) ) { 

        	//Set value for common columns

            //First time 'modified_by' is 0 (zero)
            $this->request->data['Role']['modified_by'] = $this->userInfo['id']; 

            //get IP address of user's pc. Method is available in AppController class
            $this->request->data['Role']['terminal'] = $this->getClientIp(); 

            //set status. By default 1
            $this->request->data['Role']['status'] = 1;
            
            $this->Role->id = $id;

			if( $this->Role->save( $this->data ) ) {
                $this->Session->setFlash('The Role has been modified.', 'default', array( 'class' => 'alert alert-success' ) );

				$this->redirect( array( 'action' => 'index') );
            } else {
                $this->Session->setFlash('The Role could not be modified. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
			$this->request->data = $this->Role->find('first', $options);
        }
        
        $title_for_layout = 'Edit Role';
        $this->set(compact('title_for_layout'));
    }
    	
	public function changeStatus($id, $status)
	{
		if (!$this->Role->exists($id)) {
            throw new NotFoundException(__('Invalid Role.'));
        }

        $this->Role->id = $id;
        if($this->Role->saveField("status", $status)) {
            $this->redirect(array('action'=>'index'));
        }
	}
	
	public function assignPrivilege($role_id)
	{
		
		$this->loadModel('Privilege'); 
		if($this->request->is('post') && !empty($this->request->data)) {
			//pr($this->request->data);
			foreach ($this->request->data['Privilege'] as $key => $row) {
				
				$this->request->data['Privilege'][$key]['create'] = !empty($row['create']) ? $row['create'] : 0;
				$this->request->data['Privilege'][$key]['read'] = !empty($row['read']) ? $row['read'] : 0;
				$this->request->data['Privilege'][$key]['update'] = !empty($row['update']) ? $row['update'] : 0;
				$this->request->data['Privilege'][$key]['delete'] = !empty($row['delete']) ? $row['delete'] : 0;
				$this->request->data['Privilege'][$key]['status'] = !empty($row['status']) ? $row['status'] : 0;
			}
			
			if( $this->Privilege->saveAll( $this->request->data['Privilege'] ) ) {
                $this->Session->setFlash('Privilege has been updated successfully.', 'default', array( 'class' => 'alert alert-success' ) );
				$this->redirect( array( 'action' => 'assignPrivilege/'.$role_id) );
            } else {
                $this->Session->setFlash('Privilege could not be updated. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
		} else {
			$rolePrivileges = $this->Privilege->find('all',array('conditions'=>array('role_id'=>$role_id)));
			//pr($rolePrivileges);
			$this->loadModel('Module');
			$conditions = array('status'=>1);
			$modules = $this->Module->find('all', array('conditions' => $conditions));
			$title_for_layout = 'Assign Privileges';
			$this->set(compact('modules', 'rolePrivileges', 'role_id', 'title_for_layout'));
		}
	}
    
}