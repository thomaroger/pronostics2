<?php 

class Day extends CI_Controller {


	public function index(){
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    $data = array();
    $dayId = $this->uri->segment(2);
    $day = $this->modelDay->getDay($dayId);
    if(!empty($_POST)){    
        $pronostics = $_POST['pronos'];
        
        if(date("Y-m-d H:i:s", time()) < $day[0]->Day_Prognosis_End ) {
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
    			$insert = array('Game_Id' => (int)$game->Game_Id,
    			                'User_Id' => (int)$user->User_Id);
                $this->db->where($insert);
                $query = $this->db->get('Prognosis');  
                if($query->num_rows() == 0) {             
        			$insert['Prognosis_Team1'] = (int)$pronostic['team1'];
        			$insert['Prognosis_Team2'] = (int)$pronostic['team2'];      
        			$insert['Prognosis_Win'] = $winner;        
        			$this->db->insert('Prognosis', $insert);
        			$data["status"] = 'insert'; 
    		    }else{
    		        $update = array();
    		        $update['Prognosis_Team1'] = (int)$pronostic['team1'];
        			$update['Prognosis_Team2'] = (int)$pronostic['team2'];      
        			$update['Prognosis_Win'] = $winner;
        			$this->db->where($insert);
    		        $this->db->update('Prognosis', $update); 
    		        $data["status"] = 'updated'; 
    		        
    		        $this->db->where(array('User_Id' => $user->User_Id));
    		        $this->db->update('User', array('User_Activity' => date("Y-m-d H:i:s", time()))); 
    		    }                
            }
        }
    }
    
    
    $games = $this->modelDay->getGames($dayId, $user->User_Id);
    
    $data['user'] = $user;
    $data['day'] = $day[0];
    $data['games'] = $games;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'championship';
      
    $this->load->view('dayTemplate', $data);
  }
}

