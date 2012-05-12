<?php 

class Statistic extends CI_Controller {

	public function index()
	{
    $ticket = $this->input->cookie('ticket');
    $user = Modeluser::getUser($ticket);
    if($user === false){
      redirect('/login/fail');  
    }
    
    $data = array();
    $championshipsArray = array();
    
    $data['user'] = $user;
    $data['isAjax'] = $this->input->isAjax();
    $data['action'] = 'statistics';
    
    $championships = $this->modelChampionship->getAllChampionships();
    foreach ($championships as $championship){
       
       $result = array();
       $cpt = 0;
       
       $championshipsArray[$championship->Championship_Id]['name'] = $championship->Championship_Name;
       $championshipsArray[$championship->Championship_Id]['id'] = $championship->Championship_Id;
       
       $this->db->from('Championship_has_User');
       $this->db->join('User', ' Championship_has_User.User_id = User.User_Id');
       $this->db->where(array('Championship_has_User.Championship_Id' => $championship->Championship_Id));
       $query = $this->db->get();
       $usersAssociate = $query->result();
       
       $days = "";
       $this->db->from('Day');
       $this->db->where(array('Day.Championship_Id' => $championship->Championship_Id));
       $query = $this->db->get();
       $days = $query->result();
       
       $result[$cpt][] = 'Day';
       foreach($usersAssociate as $userAssociate){
        $result[$cpt][] = $userAssociate->User_Name.' '.$userAssociate->User_Lastname;
       }
       
       $cpt ++;
       
       foreach($days as $day){
        $result[$cpt][] = $day->Day_Name;
        foreach($usersAssociate as $userAssociate){
          $this->db->from('Statistic');
          $where = array('Statistic.Day_Id' => $day->Day_Id,
                         'Statistic.User_Id' => $userAssociate->User_Id);
          $this->db->where($where);
          $query = $this->db->get();
          $resultUser = $query->result();
          $result[$cpt][] = (int) $resultUser[0]->Statistic_Point;
        }
        $cpt ++;
       }
       
       
       
       $championshipsArray[$championship->Championship_Id]['result'] = $result; 
    }
    
    
    $data['championships'] = $championshipsArray;
      
    $this->load->view('statisticTemplate', $data);
	}
	
}
