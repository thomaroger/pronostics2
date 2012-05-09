<?php 

class Backend extends CI_Controller {
    
	public function index(){
	    $ticket = $this->input->cookie('ticket');
        $user = Modeluser::getUser($ticket, false);

        if($user === false || $user->User_Admin ==0){
          redirect('/login/fail');  
        }
        $championships = $this->modelChampionship->getChampionships($user, true);
        $data = array('user' => $user,
                      'championships' => $championships,
                      'isAjax' => $this->input->isAjax());
                               
        $this->load->view('backendTemplate', $data);
  }
  
  public function result(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    $data = array();

    if(!empty($_POST)){    
        $pronostics = $_POST['pronos'];
        $games = $this->modelDay->getGames($pronostics['dayId']);
        foreach($games as $game){
            $pronostic =$pronostics[$game->Game_Id];
            if($pronostic['team1'] > $pronostic['team2']){
			    $winner = $game->Game_Team1;
			}else if($pronostic['team1'] < $pronostic['team2']){
				$winner = $game->Game_Team2;
			}else{
				$winner = 'Nul';
			}
			$insert = array('Game_Id' => (int)$game->Game_Id);
            $this->db->where($insert);
            $query = $this->db->get('Result');  
            if($query->num_rows() == 0) {             
    			$insert['Result_Team1'] = (int)$pronostic['team1'];
    			$insert['Result_Team2'] = (int)$pronostic['team2'];      
    			$insert['Result_Win'] = $winner;        
    			$this->db->insert('Result', $insert);
    			$data["status"] = 'insert'; 
		    }else{
		        $update = array();
		        $update['Result_Team1'] = (int)$pronostic['team1'];
    			$update['Result_Team2'] = (int)$pronostic['team2'];      
    			$update['Result_Win'] = $winner;
    			$this->db->where($insert);
		        $this->db->update('Result', $update); 
		        $data["status"] = 'updated'; 
		    }                
        }
        $this->db->where('Day_Id', $pronostics['dayId']);
        $update = array('Day_Status' => Modelchampionship::EXPIRED);
        $this->db->update('Day', $update); 
        $this->modelResult->generateStatistic($pronostics['dayId']);
    }
    
    $dayId = $this->uri->segment(3);
    $day = $this->modelDay->getDay($dayId);
    $games = $this->modelDay->getGames($dayId, 0, true);
    
    $data['user'] = $user;
    $data['day'] = $day[0];
    $data['games'] = $games;
    $data['isAjax'] = $this->input->isAjax();
      
    $this->load->view('backendDayTemplate', $data);
  }
  
  public function typeGames(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    
    $data = array();
    if(!empty($_POST)){ 
        $this->db->insert('GameType', $_POST['gameType']); 
        $data['status'] = 'insert';
    }
    
    $query = $this->db->get('GameType');
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['gameTypes'] = $query->result();
    $this->load->view('backendGameTypeTemplate', $data);
  }
  
  public function championships(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    
    $data = array();
    if(!empty($_POST)){ 
        $this->db->insert('Championship', $_POST['championship']); 
        $data['status'] = 'insert';
    }
    $query = $this->db->from('Championship');
    $this->db->join('GameType', ' GameType.GameType_Id = Championship.GameType_Id');
    $query = $this->db->get();
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['championships'] = $query->result();
    
    $query = $this->db->get('GameType');
    $data['gameTypes'] = $query->result();
    $this->load->view('backendChampionshiptemplate.php', $data);
  }
}

