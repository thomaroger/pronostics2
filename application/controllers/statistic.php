<?php 

class Statistic extends CI_Controller {

	public function index()
	{
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    
    $data = array();
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'statistics';
      
    $this->load->view('statisticTemplate', $data);
	}
	
}

