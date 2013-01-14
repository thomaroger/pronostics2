<?php 

class Logout extends CI_Controller {

	public function index()
	{
        $cookie = array('name' => 'ticket',
            'value' => '',
            'expire' => '1',
            'path'   => '/');
        $this->input->set_cookie($cookie);
        redirect('/');
	}
	
}

