<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {


	public $components = array('Session', 'Email', 'RequestHandler', 'Cookie',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'dashboards', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
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
    	$this->Session->write('USER_INFO', $this->Auth->user());
    	$this->userInfo = $this->Session->read('USER_INFO');
    	$userInfo = $this->userInfo;
    	$this->Auth->allow(array('login', 'logout', 'add', 'forgotPassword'));
    	//pr($userInfo); die;
    	$this->set(compact(array('userInfo')));
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
    	
    	switch ($user['role_id']) {
    		case 1:
    			return true;
    			break;
    		
    		default:
    			return true;
    			break;
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
