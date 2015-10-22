<?php
App::uses('AppController', 'Controller');


class PrivilegesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	//public $components = array('Paginator');
	
	
	function beforeFilter() {
        parent::beforeFilter();
		$this->allowedActions[$this->roleId][]= 'statusChange';
		$this->allowedActions[$this->roleId][]= 'getRoleManagementData';
    }  

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$privileges = $this->Privilege->find('all');
		//pr($privileges);
		//die;
		//$this->Privilege->recursive = 0;
		$this->set('privileges', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Privilege->exists($id)) {
			throw new NotFoundException(__('Invalid ministry'));
		}
		$options = array('conditions' => array('Privilege.' . $this->Privilege->primaryKey => $id));
		$this->set('ministry', $this->Privilege->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Privilege->create();
			$this->request->data['entry_date'] = date("Y-m-d h:i:s"); //2003-02-04 14:08:43
			if ($this->Privilege->save($this->request->data)) {
				$this->Session->setFlash(__('The ministry has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ministry could not be saved. Please, try again.'));
			}
		}
		
		$roles = $this->Privilege->Role->find('list',array('fields' => array('id','name')));
		$modules = $this->Privilege->Module->find('list',array('fields' => array('id','name'),'conditions'=>array('parent_id'=>0))); 
		//$subModules = array();
        $title_for_layout = "Add Module";
        $this->set(compact('roles','modules','subModules','title_for_layout'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Privilege->exists($id)) {
			throw new NotFoundException(__('Invalid ministry'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Privilege->save($this->request->data)) {
				$this->Session->setFlash(__('The ministry has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ministry could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Privilege.' . $this->Privilege->primaryKey => $id));
			$this->request->data = $this->Privilege->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Privilege->id = $id;
		if (!$this->Privilege->exists()) {
			throw new NotFoundException(__('Invalid ministry'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Privilege->delete()) {
			$this->Session->setFlash(__('The ministry has been deleted.'));
		} else {
			$this->Session->setFlash(__('The ministry could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function getRoleManagementData()
	{
		$module_id = $this->request->data['module_id'];
		
		$rtrResultArrs = array();
		$this->loadModel('Module');
		$resultArrs = $this->Module->find('all',array('conditions'=>array('Module.parent_id'=>$module_id)));
		if (empty($resultArrs)) {
			$resultArrs = $this->Module->find('all',array('conditions'=>array('Module.id'=>$module_id)));
		}
		foreach($resultArrs as $rs_row){
			$rtrResultArrs[] = $rs_row['Module'];
		}
		//header("Content-type: application/json"); // not necessary
		echo json_encode($rtrResultArrs);
		exit;
	}
}
