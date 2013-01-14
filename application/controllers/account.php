<?php 

class Account extends CI_Controller {

	public function index()
	{
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    if(!empty($_POST)){    
        $userToUpdate = $_POST['user'];
        $where = array('User_Id' => $_POST['User_Id']);
        $this->db->where($where);
    		$this->db->update('User', $userToUpdate); 
        $data["status"] = 'updated';
        $user = Modeluser::getUser($ticket);
    }    
    $data = array();
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'account';
    
    $this->db->where(array('User_Id' => $user->User_Id));
    $this->db->update('User', array('User_Activity' => date("Y-m-d H:i:s", time()))); 
    
      
    $this->load->view('accountTemplate', $data);
	}
	
}

