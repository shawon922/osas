<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {

    public $uses = array('User', 'Role');
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
		'DebugKit.Toolbar'
	);


	public $helpers = array(
        'Html', 'Form', 'Session',
        'Form'=> array('className'=> 'MyForm'),
        'Js' => array('Jquery'), 
        'Time', 'Cache', 'Text'
    );

    public $userInfo = 0;

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

    	//pr($userInfo); die;
    	$this->set(compact(array('userInfo', 'messages')));
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
    			$role_status = $this->Role->find('first', array('conditions'=>array('Role.id' => $user['role_id']), 'fields' => 'Role.status'));
                //pr($role_status); die;
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
