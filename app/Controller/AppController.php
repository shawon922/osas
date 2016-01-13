<?php

App::uses('Controller', 'Controller');
/*App::uses('DataTableRequestHandlerTrait', 'DataTable.Lib');*/

class AppController extends Controller {
    /*use DataTableRequestHandlerTrait;*/

    public $uses = array('User', 'Role', 'Designation', 'Department', 'Employee', 'Course', 'OfferCourse', 'OfferCourseChild', 'Student');
	public $components = array('Session', 'Email', 'RequestHandler', 'Cookie',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'homes', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'homes', 'action' => 'index'),
            'authorize'      => array('Controller'),
			'authenticate' => array(
				'Form' => array(
					'scope' => array('User.status' => 1, )
				)
			)
		), 
		'DebugKit.Toolbar',
        /*'DataTable.DataTable' => [
            'User' => [
                'columns' => [
                    'id',
                    'username',
                    'email',
                    'Actions' => null,
                ],
            ],
        ],*/
	);


	public $helpers = array(
        'Html', 'Form', 'Session',
        'Form'=> array('className'=> 'MyForm'),
        'Js' => array('Jquery'), 
        'Time', 'Cache', 'Text',
        /*'DataTable.DataTable'*/
    );

    public $userInfo = 0, $roleId = 0;
    protected $departmentId = 0;

    public function beforeFilter()
    {
    	parent::beforeFilter();
    	Configure::load('constant');


        if (!empty($this->Auth->user())) { 
            $this->Session->write('USER_INFO', $this->Auth->user());
            $this->layout = 'admin';
        } else {
            $this->layout = 'default';            
        }


        $this->userInfo = $this->Session->read('USER_INFO');
        $userInfo = $this->userInfo;

        $this->roleId = $userInfo['role_id'];
        $roleId = $this->roleId;
        
        $controls = $this->getPrivileges($this->name);
        
        if(($controls['status'] == 0) || ($controls['add'] == 0 && $controls['index']== 0 
        && $controls['edit']== 0 && $controls['delete']== 0 )) {
            $this->allowedActions[$roleId][] = '';
        } else {
            unset($controls['status']);
            foreach ($controls as $key => $data) {
                if($data != 0) {
                    $this->allowedActions[$roleId][] = $key;
                }
            }
        }
        
        /*$controls2 = $this->getPrivilegeUsers($this->name);
        
        if(($controls2['status'] == 0) || ($controls2['add'] == 0 && $controls2['index']== 0 
        && $controls2['edit']== 0 && $controls2['delete']== 0 )) {
            $this->allowedActions[$roleId][] = '';
        } else {
            unset($controls2['status']);
            foreach ($controls2 as $key2 => $data2) {
                if($data2 != 0) {
                    $this->allowedActions[$roleId][] = $key2;
                }
            }
        }*/

        $messages = $this->User->find('all', array('conditions' => array('User.status' => 1), 'fields' => array('User.first_name', 'User.last_name', 'User.email', 'User.created'), 'order' => array('User.created DESC')));


        $cont = strtolower($this->params['controller']);
        $act = strtolower($this->params['action']);
        //pr($this->params);
        if (empty($this->Session->read('DEPT_ID')) && ($cont != 'homes' && ($cont != 'users' && $act != 'login'))) {
            //$this->redirect(array('controller' => 'homes', 'action' => 'index'));
        } else {
            $this->departmentId = $this->Session->read('DEPT_ID');
            $departmentId = $this->departmentId;
        }

        

    	//pr($userInfo); die;
    	$this->set(compact('userInfo', 'roleId', 'messages', 'departmentId'));
    }

    function beforeRender() {
        
        //---------------------- 
        // Set the Error Layout
        //----------------------
        if($this->name == 'CakeError') {
            $this->layout = 'error';
            $this->set( 'cookieIsSet', '' );
        }
    }


    public function isAuthorized($user) {
    	switch($user['role_id']) {
            case 1:
                return true;
            break;
            
            default:
            
                $role_status = $this->Role->find('first', array('conditions'=>array('Role.id'=> $user['role_id']), 'fields'=>'Role.status'));
                
                if ($role_status['Role']['status'] == 0) {
                    return $this->redirect($this->Auth->logout());
                } else if( (bool)(in_array("{$this->request->action}", $this->allowedActions[$user['role_id']])) === false ) {
                    return $this->redirect($this->Auth->logout());
                } else {
                    return true;
                }
        }
        return false;
	}

    public function getAllBatch()
    {
        
    }

    public function getCurrentSemester()
    {
        $semester = null;

        $month = date('n');

        if ($month >= 1 || $month <= 4) {
            $semester = 1;
        } elseif ($month >= 5 || $month <= 8) {
            $semester = 2;
        } else {
            $semester = 3;
        }

        return $semester;
    }


    public function remove_all_cookies() 
	{
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) {
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
			}
		}
	}

	public function getClientIp() 
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
        
		return $ip;
	}


    protected function getPrivileges( $controller )
    {
        $module_name = Inflector::singularize($controller);
        
        $rtrPrivileges = array();
        $privileges = $this->Privilege->find('first',array(
            'conditions'=> array(
                'Privilege.role_id'=> $this->roleId, 
                'Module.name'=> $module_name
            ),
            'fields'=> array(
                'Privilege.can_create',
                'Privilege.can_read',
                'Privilege.can_update',
                'Privilege.can_delete',
                'Privilege.status',
            )
        ));

        $rtrPrivileges['add'] = (!empty($privileges['Privilege']['create'])) ? $privileges['Privilege']['create'] : 0;
        $rtrPrivileges['index'] = (!empty($privileges['Privilege']['read'])) ? $privileges['Privilege']['read'] : 0;
        $rtrPrivileges['manage'] = $rtrPrivileges['index'];
        $rtrPrivileges['edit'] = (!empty($privileges['Privilege']['update'])) ? $privileges['Privilege']['update']: 0;
        $rtrPrivileges['delete'] = (!empty($privileges['Privilege']['delete'])) ? $privileges['Privilege']['delete']: 0;
        $rtrPrivileges['status'] = (!empty($privileges['Privilege']['status'])) ? $privileges['Privilege']['status']: 0;
        $rtrPrivileges['search'] = 1;
        $rtrPrivileges['view'] = 1;
        $rtrPrivileges['changeStatus'] = 1;
        return $rtrPrivileges;
    }
    
    protected function getPrivilegeUsers( $controller )
    {
        $module_name = Inflector::singularize($controller);
        
        $rtrPrivileges = array();
        $privileges = $this->PrivilegeUser->find('first',array(
            'conditions'=> array(
                'PrivilegeUser.role_id'=> $this->roleId, 
                'Module.name_en'=> $module_name
                //'Module.name'=> $module_name
            ),
            'fields'=> array(
                'PrivilegeUser.create',
                'PrivilegeUser.read',
                'PrivilegeUser.update',
                'PrivilegeUser.delete',
                'PrivilegeUser.status',
            )
        ));
        $rtrPrivileges['add'] = (!empty($privileges['PrivilegeUser']['create'])) ? $privileges['PrivilegeUser']['create'] : 0;
        $rtrPrivileges['index'] = (!empty($privileges['PrivilegeUser']['read'])) ? $privileges['PrivilegeUser']['read'] : 0;
        $rtrPrivileges['manage'] = $rtrPrivileges['index'];
        $rtrPrivileges['edit'] = (!empty($privileges['PrivilegeUser']['update'])) ? $privileges['PrivilegeUser']['update']: 0;
        $rtrPrivileges['delete'] = (!empty($privileges['PrivilegeUser']['delete'])) ? $privileges['PrivilegeUser']['delete']: 0;
        $rtrPrivileges['status'] = (!empty($privileges['PrivilegeUser']['status'])) ? $privileges['PrivilegeUser']['status']: 0;
        $rtrPrivileges['search'] = 1;
        $rtrPrivileges['view'] = 1;
        $rtrPrivileges['changeStatus'] = 1;
        return $rtrPrivileges;
    }
    
    //======================================================
    // 
    //======================================================
    
    function getPrivilegeIds( $mid = null ) 
    {
        $privileges = $rsPrivileges = array();
        //$conditions = array("Privilege.status"=> 1, "Privilege.role_id"=> $this->roleId);
        //$conditions[] = "Privilege.status = 1";
        //$conditions[] = "Privilege.module_id = $mid";
        //$conditions[] = "Privilege.role_id = ".$user["role_id"];
        
        $privilegeUsers = $this->PrivilegeUser->find('first', array('conditions' => array(
                'PrivilegeUser.user_id'=> $this->userId, 
                'PrivilegeUser.role_id' => $this->roleId
            )
        ));
        
        if(empty($privilegeUsers)) {
            $prvModelName = 'Privilege';
            $prvConditions = array(
                "Privilege.role_id"=> $this->roleId,
                "Privilege.status"=> 1
            );
        } else {
            $prvModelName = 'PrivilegeUser';
            $prvConditions = array(
                'PrivilegeUser.user_id'=> $this->userId, 
                "PrivilegeUser.role_id"=> $this->roleId,
                "PrivilegeUser.status"=> 1
            );
        }
        
        //pr($privilegeUsers);
        //pr($prvModelName);
        //pr($prvConditions);
        
        $rsPrivileges = $this->$prvModelName->find("all", array("conditions" => $prvConditions , 'fields'=> array("id", "module_id", "create", "read", "update", "delete")));
        if(!empty($rsPrivileges)) {
            foreach($rsPrivileges as $p_row) {
                $privileges[$p_row[$prvModelName]['module_id']] = $p_row;
            }
        }
        //pr($this->userId);
        //pr($privileges);
        $this->set(compact('privileges', 'prvModelName'));
        //$this->set("privileges", $privileges);
        return $privileges;
    }
    
    /* function getPrivileges($mid){
        $user = $this->Session->read("USER_INFO");
        $privileges = NULL;
        $conditions[] = "Privilege.status = 1";
        $conditions[] = "Privilege.module_id = $mid";
        $conditions[] = "Privilege.role_id = ".$user["role_id"];
        $privilege = $this->Privilege->find("first",array("conditions"=>$conditions),array("id", "create","read","update","delete"));
        $this->set("privilege", $privilege);
        return $privilege;
    } */
    
    protected function publicAuth( $controller ) 
    {
        if( ! $this->Auth->login() ) {
            $controls = (array) @$this->allowedActions[ array_search( 'public', Configure::read( 'USER_ROLE' ) ) ];
            $allowed = array();
            
            foreach ($controls as $action_path) {
                if( stristr( $action_path, $controller ) ) {
                    $allowed[] = substr( $action_path, strpos( $action_path, ':' ) + 1 );
                }
            }
            $this->Auth->allow( $allowed );
        }
    }

    function all_action_controller_model($load_m = '', $load_c = '', $load_a = '') 
    {
        $aCtrlClasses = App::objects('controller');
        $admin_menus = array();
        $all_controllers = array();
        $all_models = array();

        if ( $load_m ) {
            $aMdlClasses = App::objects('model');
            foreach($aMdlClasses as $model) {
                if ( $model != 'AppModel' ) {
                    $all_models[] = $model;
                }
            }
            //pr($all_models);
            return $all_models;
        }

        foreach ($aCtrlClasses as $controller) {
            if ($controller != 'AppController') {
                if ( $load_c ) {
                    $this->uses[] = Inflector::singularize(str_ireplace('controller', '', $controller));
                    continue;
                }
                // Load the controller
                App::import('Controller', str_replace('Controller', '', $controller));

                // Load its methods / actions
                $aMethods = get_class_methods($controller);

                foreach ($aMethods as $idx => $method) {

                    if ($method{0} == '_') {
                        unset($aMethods[$idx]);
                    }

                    if ( stristr( $method, 'login' ) || stristr( $method, 'logout' ) ) {
                        unset($aMethods[$idx]);
                    }

                    if ( !stristr( $method, 'admin' ) ) {
                        unset($aMethods[$idx]);
                    }

                    if ( stristr( $method, 'delete' ) ) {
                        unset($aMethods[$idx]);
                    }

                    if ( $controller == 'UsersController' && $method == 'admin_index' ) {
                        unset($aMethods[$idx]);
                    }
                }

                // Load the ApplicationController (if there is one)
                App::import('Controller', 'AppController');
                $parentActions = get_class_methods('AppController');

                $admin_menus[Inflector::tableize(str_ireplace('controller', '', $controller))] = array_diff($aMethods, $parentActions);
            }
        }
    }
}
