<?php
class Modeluser extends CI_MODEL {
    
    const KEY = "0mT1aH2tO3hM4iA5eS6uR7rO8oG9gE0eR1r"; 
    
    public function checkSignin($email, $password){
      $where = array('User_Email' => $email,
                     'User_Password' => md5($password));
      $this->db->where($where);
      $query = $this->db->get('User');
      if($query->num_rows() == 1){
        $this->setCookie($query);
        return true;
      }
      return false;
    }
    
    
    public function setCookie($query){
      $user = $query->result();
      $ticket = self::generateTicket($user[0]);
      $cookie = array('name' => 'ticket',
            'value' => $ticket,
            'expire' => '86500',
            'path'   => '/');
            
	    $this->input->set_cookie($cookie);
    }
    
    
    public static function getUser($ticket){
      $ticketArray = explode(':', $ticket);
      $instUser = new self();
      $instUser->db->where('User_Id',(int) $ticketArray[0]);
      $query = $instUser->db->get('User');
      $user = $query->result();
      if(!empty($user)){
        if($ticket == self::generateTicket($user[0])){
          return $user[0];
        }      
      }
      return false;
    }
    
    
    
    public static function generateTicket($user){
      $ticket = $user->User_Id.":".md5($user->User_Id.''.$user->User_Lastname.''.$user->User_Email.''.self::KEY);
      return $ticket;
    }
}