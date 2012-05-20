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
       $cumul = array();
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
       $this->db->where(array('Day.Championship_Id' => $championship->Championship_Id, 'Day.Day_Status' => Modelchampionship::EXPIRED));
       $query = $this->db->get();
       $days = $query->result();
       
       $result[$cpt][] = $cumul[$cpt][] = 'Day';
       foreach($usersAssociate as $userAssociate){
        $result[$cpt][] = $cumul[$cpt][] =  $userAssociate->User_Name.' '.$userAssociate->User_Lastname;
       }
       
       $cpt ++;
       
       $result[$cpt][] =  $cumul[$cpt][] =  '';
       foreach($usersAssociate as $userAssociate){
        $result[$cpt][] =  $cumul[$cpt][] = 0;
       }
       
       $cpt ++;
       
       foreach($days as $day){
        $result[$cpt][] = $cumul[$cpt][] = (string) $day->Day_Name;
        foreach($usersAssociate as $userAssociate){
          $this->db->from('Statistic');
          $where = array('Statistic.Day_Id' => $day->Day_Id,
                         'Statistic.User_Id' => $userAssociate->User_Id);
          $this->db->where($where);
          $query = $this->db->get();
          $resultUser = $query->result();
          if(!empty($resultUser)){
            $result[$cpt][] = (int) $resultUser[0]->Statistic_Point;
            $cumul[$cpt][$resultUser[0]->User_Id] = (int) $cumul[($cpt-1)][$resultUser[0]->User_Id] + (int) $resultUser[0]->Statistic_Point;
          }else{
            $result[$cpt][] = 0;
            $cumul[$cpt][$userAssociate->User_Id] = (int) $cumul[($cpt-1)][$userAssociate->User_Id] + 0;
          
          }
          
        }
        $cpt ++;
       }
       
       $result[$cpt][] = $cumul[$cpt][] = '';
       foreach($usersAssociate as $userAssociate){
        $result[$cpt][] = $cumul[$cpt][] = 0;
       }
       
       $championshipsArray[$championship->Championship_Id]['result'] = $result; 
       $championshipsArray[$championship->Championship_Id]['cumul'] = $cumul; 
    }
    
    
    
    
    $data['championships'] = $championshipsArray;
    
    $this->db->where(array('User_Id' => $user->User_Id));
    $this->db->update('User', array('User_Activity' => date("Y-m-d H:i:s", time()))); 
    
      
    $this->load->view('statisticTemplate', $data);
	}
	
}

