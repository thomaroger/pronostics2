<?php 

class Login extends CI_Controller {

	public function index()
	{
	  $ticket = $this->input->cookie('ticket');
	  $user = Modeluser::getUser($ticket);
      if($user !== false){
          redirect('/championship');
      }
    
    $data = array();
    $status = $this->uri->segment(2);
    if(!empty($status)){
      if($status == 'fail'){
        $data["fail"] = 1;
      }else{
        $data['password'] = 1;
      }
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
    $return =  $this->modelUser->checkSignin($email, $password);
    if($return == false){
      redirect('/login/fail');
    }else{
      redirect('/championship');
    }
	}
	
	public function generatePassword(){
    	 $newPassword = $this->modelUser->generatePassword();
    	 $data = array('User_Password' => md5($newPassword));
         $this->db->where('User_Email', $_POST['email']);
         $this->db->update('User', $data);
    
         
         $where = array('Mail_Tag' => 'new_password');
         $this->db->where($where);
         $query = $this->db->get('Mail');
         $mails = $query->result();
         $mail = $mails[0];
         $text = $mail->Mail_Text;
         
         $keys = array('{{User_Email}}', '{{User_Password}}');
         $values = array($_POST['email'], $newPassword);
         $text = str_replace($keys, $values, $text);
        
         $config = array();
         $config['mailtype'] = 'html';
         $this->email->initialize($config);
          
         $this->email->from('thomaroger@gmail.com', 'Pronostics');
         $this->email->to($_POST['email']); 
         $this->email->subject('[Pronostics] : New Password');
         $this->email->message($text);	
    
         $this->email->send();
     
        redirect('/login/password');
     
	}
}

