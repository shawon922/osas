<?php
App::uses('AppController', 'Controller');
App::uses('PrivilegesController', 'Controller');


class RolesController extends AppController {
	
	function beforeFilter() {
        parent::beforeFilter();
		$this->allowedActions[$this->roleId][]= 'assignPrivilege';
    }  
    
	public function index() {		
		
		$roles = $this->Role->find( 'all', array('conditions' => array('Role.id !='=>1), 'recursive' => 2) );
        //pr($roles);
		$title_for_layout = 'User Roles';
        $this->set( compact( 'roles', 'title_for_layout') );
	}
    
    function add() {
		
        if( ! empty($this->request->data) ) {
            
			$this->request->data['Role']['status'] = 1;
            if( $this->Role->save( $this->request->data ) ) {
                
                $this->Session->setFlash( ($this->lang ==1) ? 'তথ্যটি সংরক্ষিত হয়েছে।' : 'Data is saved', 'default', array( 'class' => 'alert alert-success' ) );
                //$this->redirect( array( 'action' => 'edit', $this->Role->id ) );
                $this->redirect( array( 'action' => 'index') );
            } else {
                $this->Session->setFlash(($this->lang ==1) ? 'অনুগ্রহ করে ইনপুট ফিল্ড চেক করুন, আবার চেষ্টা করুন।' : 'The Role could not be saved. Please try again', 'default', array('class' => 'alert alert-danger'));
            }
        }
        
        $this->set( 'title_for_layout', ($this->lang ==1) ? ' রোল যোগ করুন ' : 'Add Role' );
    }
    
    function edit( $id = null ) {
        if( ! $id || ! ($prev_data = $this->Role->read( null, $id )) ) {
            $this->Session->setFlash( 'Invalid Request!!', 'default', array( 'class' => 'alert alert-danger' ) );
            $this->redirect( array( 'action' => 'index' ) );
        }
        
        if( ! empty( $this->request->data ) ) {
            
            $this->Role->id = $id;
			if( $this->Role->save( $this->data ) ) {
                $this->Session->setFlash( ($this->lang ==1) ? 'তথ্যটি আপডেট হয়েছে।' :'The Role is updated.', 'default', array( 'class' => 'alert alert-success' ) );
                //$this->redirect( $this->referer() );
				$this->redirect( array( 'action' => 'index') );
            } else {
                $this->Session->setFlash( ($this->lang ==1) ? 'অনুগ্রহ করে ইনপুট ফিল্ড চেক করুন, আবার চেষ্টা করুন।' : 'The Role could not be updated. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            //$this->request->data = $prev_data;
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
			$this->request->data = $this->Role->find('first', $options);
        }
        
        $title_for_layout = ($this->lang ==1) ? ' রোল পরিবর্তন করুন' : 'Edit Role';
        $this->set(compact('title_for_layout'));
    }
    
    function delete($id = null) {
        if( ! $id || ! ($prev_data = $this->Role->read( null, $id )) ) {
            $this->Session->setFlash( 'Invalid Request!!', 'default', array( 'class' => 'alert alert-danger' ) );
            $this->redirect( array( 'action' => 'index' ) );
        }
        
        if( $this->Role->delete( $id ) ) {
            $this->Session->setFlash('The Role is deleted.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('The Role could not be deleted. Please try again later.', 'default', array('class' => 'alert alert-danger'));
        }
        $this->redirect( $this->referer() );
    }
	
	function changeStatus($id = 0 , $status = null)
	{
		
		if($id > 0 ) {
			$data['Role']['status'] = $status;
            $this->Role->id = $id;
			if( $this->Role->save( $data ) ) {
                $this->Session->setFlash( ($this->lang ==1) ? 'রোল স্ট্যাটাস পরিবর্তন করা হয়েছে।' : 'Role Status is changed.', 'default', array( 'class' => 'alert alert-success' ) );
				$this->redirect( array( 'action' => 'index') );
            } else {
                $this->Session->setFlash( ($this->lang ==1) ? 'অনুগ্রহ করে ইনপুট ফিল্ড চেক করুন, আবার চেষ্টা করুন।' : 'Role Status could not be changed. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
        } else {
			$this->Session->setFlash( ($this->lang ==1) ? 'অবৈধ অনুরোধ!!' : 'Invalid Request!!', 'default', array( 'class' => 'alert alert-danger' ) );
            $this->redirect( array( 'action' => 'index' ) );
		}
	}
	
	function assignPrivilege($role_id = 0)
	{
		/* 
		if($id > 0){
			$Privileges = new PrivilegesController;
			$Privileges->assign_privilege($id);
		} else {
			$this->Session->setFlash( 'Invalid Request!!', 'default', array( 'class' => 'alert alert-danger' ) );
            $this->redirect( array( 'action' => 'index' ) );
		}
		*/
		
		$this->loadModel('Privilege'); 
		if($this->request->is('post') && !empty($this->request->data)) {
			//pr($this->request->data);
			foreach($this->request->data['Privilege'] as $key => $row) {
				//$this->request->data['Privilege'][$key]['id'] = $row['id'];
				//$this->request->data['Privilege'][$key]['module_id'] = $row['module_id'];
				//$this->request->data['Privilege'][$key]['role_id'] = $row['role_id'];
				$this->request->data['Privilege'][$key]['create'] = !empty($row['create']) ? $row['create'] : 0;
				$this->request->data['Privilege'][$key]['read'] = !empty($row['read']) ? $row['read'] : 0;
				$this->request->data['Privilege'][$key]['update'] = !empty($row['update']) ? $row['update'] : 0;
				$this->request->data['Privilege'][$key]['delete'] = !empty($row['delete']) ? $row['delete'] : 0;
				$this->request->data['Privilege'][$key]['status'] = !empty($row['status']) ? $row['status'] : 0;
			}
			//pr($this->request->data);
			//die;
			if( $this->Privilege->saveAll( $this->request->data['Privilege'] ) ) {
                $this->Session->setFlash( ( $this->lang==1) ? 'প্রিভিলেজ হালনাগাদ সম্পন্ন হয়েছে।' : 'Privilege is updated successfully.', 'default', array( 'class' => 'alert alert-success' ) );
				$this->redirect( array( 'action' => 'assignPrivilege/'.$role_id) );
            } else {
                $this->Session->setFlash(( $this->lang==1) ? 'প্রিভিলেজ হালনাগাদ হতে পারে না, অনুগ্রহ করে আবার চেষ্টা করুন ।' : 'Privilege could not be updated. Please try again.', 'default', array('class' => 'alert alert-danger'));
            }
		} else {
			$rolePrivileges = $this->Privilege->find('all',array('conditions'=>array('role_id'=>$role_id)));
			//pr($rolePrivileges);
			$this->loadModel('Module');
			$conditions = array('status'=>1);
			$modules = $this->Module->find('all', array('conditions' => $conditions));
			$title_for_layout = ($this->lang ==1) ? ' আসাইন প্রিভিলেজ ' : 'Assign Privileges';
			$this->set(compact('modules', 'rolePrivileges', 'role_id', 'title_for_layout'));
		}
	}
    
}