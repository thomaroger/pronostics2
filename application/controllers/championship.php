<?php 

class Championship extends CI_Controller {


	public function index(){
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    
    $championships = $this->modelChampionship->getChampionships($user);
    $data = array('user' => $user,
                  'championships' => $championships,
                  'isAjax' => $this->input->isAjax(),
                  'action' => 'championship');
    
    $this->db->where(array('User_Id' => $user->User_Id));
    $this->db->update('User', array('User_Activity' => date("Y-m-d H:i:s", time()))); 
    		                               
    $this->load->view('championshipTemplate', $data);
  }
}

