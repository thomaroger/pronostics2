<?php
class Modeluser extends CI_MODEL {
    
        
    
    function __construct(){
        parent::__construct();
    }
    
    public function checkSignin($email, $password){
      $this->db->where('User_Email',$email);
      $this->db->where('User_Password',md5($password));
      $query = $this->db->get('User');
      if($query->num_rows() == 1){
        return true;
      }
      return false;
    }
    
}