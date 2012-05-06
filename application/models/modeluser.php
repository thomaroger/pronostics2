<?php
class Modeluser extends CI_MODEL {
    
        
    
    function __construct(){
        parent::__construct();
    }
    
    public function checkSignin(){
      var_dump($_POST);
      return true;
    }
    
}