<?php 

class Championship extends CI_Controller {


	public function index()
	{
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    
    $championships = $this->modelChampionship->getChampionships($user);
    var_dump($championships);
  }
}

