<?php
App::uses('AppController', 'Controller');


class ModulesController extends AppController {
	
	
	public function beforeFilter() {
        parent::beforeFilter();
    }  
    
	public function index() 
	{		
		$modules = $this->Module->find( 'all' , array('conditions' => array('Module.status' => 1)));

		$title_for_layout = 'User Modules';
        $this->set( compact( 'modules', 'title_for_layout' ) );
	}
    
    function add() 
	{
		
        if( ! empty($this->request->data) ) {

            $this->request->data['Module']['parent_id'] = $this->request->data['Module']['parent_id'] !='' ? $this->request->data['Module']['parent_id'] : 0;
			
            if( $this->Module->save( $this->request->data ) ) {
                
                $this->Session->setFlash( 'Module has been saved.', 'default', array( 'class' => 'alert alert-success' ) );
				return $this->redirect(array('controller' => 'modules'));
            } else {
                $this->Session->setFlash( 'The Module could not be saved. Please try again.' , 'default', array('class' => 'alert alert-error'));
            }
        }

		$modules = $this->Module->find('list',array('fields' => array('id', 'name'),'conditions'=>array('parent_id' => 0, 'status' = >1)));
        $title_for_layout = 'Add Module';
        $this->set(compact('modules','title_for_layout'));
    }
    
    public function edit( $id ) 
	{
        if (!$this->Module->exists($id)) {
			throw new NotFoundException(__('Invalid Module'));
		}

        if( ! empty( $this->request->data ) ) {
            
            $this->Module->id = $id;
			if( $this->Module->save( $this->request->data ) ) {
                $this->Session->setFlash( 'Module has been updated.', 'default', array( 'class' => 'alert alert-success' ) );
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash( 'The Module could not be updated. Please try again.', 'default', array('class' => 'alert alert-error'));
            }
        } else {
			$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
			$this->request->data = $this->Module->find('first', $options);
		}
        $modules = $this->Module->find('list',array('fields' => array('id', 'name'), 'conditions' => array('parent_id'=>0, 'status'=>1)));

        $title_for_layout = 'Edit Module';
        $this->set(compact('modules', 'title_for_layout'));
    }
    
    function delete($id = null) 
	{
        if( !$id || !($prev_data = $this->Module->read( null, $id )) ) {
            $this->Session->setFlash( 'Invalid Request!!', 'default', array( 'class' => 'alert alert-danger' ) );
            $this->redirect( array( 'action' => 'index' ) );
        }
        
        if( $this->Module->delete( $id ) ) {
            $this->Session->setFlash('Data is deleted.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('Something happen wrong (DB Error). Please try again later.', 'default', array('class' => 'alert alert-danger'));
        }
        $this->redirect( $this->referer() );
    }
	
	function changeStatus($id, $status) 
	{
		$this->Module->id = $id;
		if($this->Module->saveField("status", $status)) {
			$this->redirect(array('action'=>'index'));
		}
	}
    
}