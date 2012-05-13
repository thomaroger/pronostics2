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
                      'isAjax' => $this->input->isAjax(),
                      'action' => 'results');                   
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
    $data['action'] = 'results';
    
      
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
    $data['action'] = 'typeGames';
    
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
    
    if(!empty($_GET['filters']['GameType']) && $_GET['filters']['GameType'] > 0){
      $this->db->where(array('GameType.GameType_Id' => $_GET['filters']['GameType']));
    }
    
    $query = $this->db->get();
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['championships'] = $query->result();
    $data['action'] = 'championships';
    
    $query = $this->db->get('GameType');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->GameType_Id] = $result->GameType_Name;
    }
    $data['filters'][] = array('Name' => 'GameType',
                               'Label' => 'Type Of Games', 
                               'Values' => $values,
                               'Type' => 'Select');
    
    $this->load->view('backendChampionshiptemplate.php', $data);
  }
  
  
  public function users(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    
    $data = array();
    if(!empty($_POST)){ 
        $dataUser = $_POST['user'];
        $dataUser['User_Password'] = md5($dataUser['User_Password']);
        $this->db->insert('User', $dataUser); 
        $data['status'] = 'insert';
    }
    $query = $this->db->get('User');
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['users'] = $query->result();
    $data['action'] = 'users';
    $this->load->view('backendUsertemplate.php', $data);  
  }
  
  public function userAssociate(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
     }
     $data = array();
     $data['user'] = $user;
     if(!empty($_POST['associate']['Championship_Id'])){ 
        $this->db->where('User_Id', $_POST['associate']['User_Id']);
        $this->db->delete('Championship_has_User'); 
        foreach(array_keys($_POST['associate']['Championship_Id']) as $championship){
          $insert = array('Championship_Id' =>  $championship,
              'User_Id' => $_POST['associate']['User_Id']);
          $this->db->insert('Championship_has_User', $insert);   
        }
        $data['status'] = 'insert';   
     }
     
     $query = $this->db->get('Championship');
     $data['championships'] = $query->result();
     $userId = $this->uri->segment(3);
        
     $this->db->where(array('User_Id' => $userId));
     $query = $this->db->get('User');
     $userToAssociate = $query->result();
     $data['userToAssociate'] = $userToAssociate[0];
     $data['isAjax'] = $this->input->isAjax();
     $data['action'] = 'users';
     $this->load->view('backendAssociateTemplate.php', $data);  
  }
  
  public function days(){
     $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    
    $data = array();
    if(!empty($_POST)){ 
        $dataDay = $_POST['day'];
        $this->db->insert('Day', $dataDay); 
        $data['status'] = 'insert';
    }
    $this->db->from('Day');
    $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    if(!empty($_GET['filters']['Championship']) && $_GET['filters']['Championship'] > 0){
      $this->db->where(array('Championship.Championship_Id' => $_GET['filters']['Championship']));
    }
    
    $query = $this->db->get();
    $data['days'] = $query->result();
    $data['user'] = $user;
    $query = $this->db->get('Championship');
    $data['championships'] = $query->result();
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'days';
    
    $query = $this->db->get('Championship');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Championship_Id] = $result->Championship_Name;
    }
    $data['filters'][] = array('Name' => 'Championship',
                               'Label' => 'Championship', 
                               'Values' => $values,
                               'Type' => 'Select');
    
    $this->load->view('backendDaystemplate.php', $data);
  }
  
  public function games(){
      $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    
    $data = array();
    if(!empty($_POST)){ 
        $dataGame = $_POST['game'];
        $this->db->insert('Game', $dataGame); 
        $data['status'] = 'insert';
    }
    $this->db->from('Game');
    $this->db->join('Day', ' Day.Day_id = Game.Day_Id', 'left');
    $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    $where = array();
    if(!empty($_GET['filters']['Championship']) && $_GET['filters']['Championship'] > 0){
      $where['Championship.Championship_Id'] = $_GET['filters']['Championship'];
    }
    if(!empty($_GET['filters']['Day']) && $_GET['filters']['Day'] > 0){
      $where['Game.Day_Id'] = $_GET['filters']['Day'];
    }
    if(!empty($where)){
      $this->db->where($where);
    }
  
    $query = $this->db->get();
    $data['games'] = $query->result();
    $data['user'] = $user;
    $this->db->from('Day');
    $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    $query = $this->db->get();
    $data['days'] = $query->result();
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'games';
    
    $query = $this->db->get('Championship');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Championship_Id] = $result->Championship_Name;
    }
    $data['filters'][] = array('Name' => 'Championship',
                               'Label' => 'Championship', 
                               'Values' => $values,
                               'Type' => 'Select');
                               
    $query = $this->db->get('Day');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Day_Id] = $result->Day_Name;
    }
    $data['filters'][] = array('Name' => 'Day',
                               'Label' => 'Day', 
                               'Values' => $values,
                               'Type' => 'Select');
                               
    
    $this->load->view('backendGamestemplate.php', $data); 
  }
  
  public function predictions(){
    $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    $data = array();
    
    $this->db->from('Prognosis');
    $this->db->join('Game', ' Prognosis.Game_Id = Game.Game_id', 'left');
    $this->db->join('Day', ' Day.Day_id = Game.Day_Id', 'left');
    $this->db->join('User', ' Prognosis.User_Id = User.User_Id', 'left');
    $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    $where = array();
    if(!empty($_GET['filters']['Championship']) && $_GET['filters']['Championship'] > 0){
      $where['Championship.Championship_Id'] = $_GET['filters']['Championship'];
    }
    if(!empty($_GET['filters']['Day']) && $_GET['filters']['Day'] > 0){
      $where['Game.Day_Id'] = $_GET['filters']['Day'];
    }
    if(!empty($_GET['filters']['User']) && $_GET['filters']['User'] > 0){
      $where['Prognosis.User_id'] = $_GET['filters']['User'];
    }
    if(!empty($where)){
      $this->db->where($where);
    }
    
    $query = $this->db->get();
    $data['predictions'] = $query->result();
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'predictions';
    
    $query = $this->db->get('Championship');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Championship_Id] = $result->Championship_Name;
    }
    $data['filters'][] = array('Name' => 'Championship',
                               'Label' => 'Championship', 
                               'Values' => $values,
                               'Type' => 'Select');
                               
    $query = $this->db->get('Day');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Day_Id] = $result->Day_Name;
    }
    $data['filters'][] = array('Name' => 'Day',
                               'Label' => 'Day', 
                               'Values' => $values,
                               'Type' => 'Select');
     
    $query = $this->db->get('User');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->User_Id] = $result->User_Name.' '.$result->User_Lastname;
    }
    $data['filters'][] = array('Name' => 'User',
                               'Label' => 'User', 
                               'Values' => $values,
                               'Type' => 'Select');                          
    
    $this->load->view('backendPredictionstemplate.php', $data); 
     
  }
  
  public function statistics(){
    $ticket = $this->input->cookie('ticket');
     $user = Modeluser::getUser($ticket, false);

     if($user === false || $user->User_Admin ==0){
        redirect('/login/fail');  
    }
    $data = array();
    
    $this->db->from('Statistic');
    $this->db->join('Day', ' Statistic.Day_id = Day.Day_Id', 'left');
    $this->db->join('User', ' Statistic.User_Id = User.User_Id', 'left');
    $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    $where = array();
    if(!empty($_GET['filters']['Championship']) && $_GET['filters']['Championship'] > 0){
      $where['Championship.Championship_Id'] = $_GET['filters']['Championship'];
    }
    if(!empty($_GET['filters']['Day']) && $_GET['filters']['Day'] > 0){
      $where['Day.Day_Id'] = $_GET['filters']['Day'];
    }
    if(!empty($_GET['filters']['User']) && $_GET['filters']['User'] > 0){
      $where['User.User_id'] = $_GET['filters']['User'];
    }
    if(!empty($where)){
      $this->db->where($where);
    }
    
    $query = $this->db->get();
    $data['statistics'] = $query->result();
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'statistics';
    
    $query = $this->db->get('Championship');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Championship_Id] = $result->Championship_Name;
    }
    $data['filters'][] = array('Name' => 'Championship',
                               'Label' => 'Championship', 
                               'Values' => $values,
                               'Type' => 'Select');
                               
    $query = $this->db->get('Day');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->Day_Id] = $result->Day_Name;
    }
    $data['filters'][] = array('Name' => 'Day',
                               'Label' => 'Day', 
                               'Values' => $values,
                               'Type' => 'Select');
     
    $query = $this->db->get('User');
    $values = array('0' => 'All');
    foreach ($query->result() as $result){
      $values[$result->User_Id] = $result->User_Name.' '.$result->User_Lastname;
    }
    $data['filters'][] = array('Name' => 'User',
                               'Label' => 'User', 
                               'Values' => $values,
                               'Type' => 'Select');
    
    $this->load->view('backendStatisticsBackend.php', $data);
  }
  
}

