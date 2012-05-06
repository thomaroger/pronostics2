<?php 

class Login extends CI_Controller {

	public function index()
	{
    $data = array();
    $fail = $this->uri->segment(2);
    if(!empty($fail)){
      $data["fail"] = 1;
    }
	  $data['isAjax'] = $this->input->isAjax();
		$this->load->view('loginTemplate', $data);
	}
	
	public function signin(){
    $password = !empty($_POST['password'])?$_POST['password']:'';
    $email = !empty($_POST['email'])?$_POST['email']:'';
    if(empty($email) || empty($password)){
      redirect('/login/fail'); 
    }
    $return  =  $this->modelUser->checkSignin($email, $password);
    var_dump($return);
	}
}
