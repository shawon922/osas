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

    public $userInfo = 0;
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

        $messages = $this->User->find('all', array('conditions' => array('User.status' => 1), 'fields' => array('User.first_name', 'User.last_name', 'User.email', 'User.created'), 'order' => array('User.created DESC')));
    	
    	$this->userInfo = $this->Session->read('USER_INFO');
    	$userInfo = $this->userInfo;

        $cont = strtolower($this->params['controller']);
        $act = strtolower($this->params['action']);
        //pr($this->params);
        if (empty($this->Session->read('DEPT_ID')) && ($cont != 'homes' && ($cont != 'users' && $act != 'login'))) {
            $this->redirect(array('controller' => 'homes', 'action' => 'index'));
        } else {
            $this->departmentId = $this->Session->read('DEPT_ID');
            $departmentId = $this->departmentId;
        }

    	//pr($userInfo); die;
    	$this->set(compact('userInfo', 'messages', 'departmentId'));
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
    	//pr($user); die;
    	switch ($user['role_id']) {
    		case 1:
    			return true;
    			break;
    		
    		default:
    			/*$role_status = $this->Role->find('first', array('conditions'=>array('Role.id' => $user['role_id']), 'fields' => 'Role.status'));
                //pr($role_status); die;
                if ($role_status['Role']['status'] == 0) {
                    return $this->redirect($this->Auth->logout());
                } else if( (bool)(in_array("{$this->request->action}", $this->allowedActions[$user['role_id']])) === false ) {
                    return $this->redirect($this->Auth->logout());
                } else {
                    return true;
                }*/

                return true;
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
}
