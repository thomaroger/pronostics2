<?php
class Modelchampionship extends CI_MODEL {

  const WEEK = 2592000;// 30 days;
  const EXPIRED = 1;
  const ACTIF = 0;
  public static $statuses = array(self::EXPIRED => 'expired',
                                  self::ACTIF => 'live'); 
  
  public function getChampionships($user, $admin = false){
    
    $this->db->from('Championship');
    if(!$admin){
        $this->db->join('Championship_has_User', ' Championship_has_User.Championship_Id = Championship.Championship_Id');
    }
    $this->db->join('GameType', ' GameType.GameType_Id = Championship.GameType_Id');
    $this->db->join('Day', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    if($admin){
        $where = array('Day.Day_Prognosis_End < '=> date("Y-m-d H:i:s", time())); 
    }else{
        $where = array('Championship_has_User.User_Id' => $user->User_Id,
                       'Day.Day_Prognosis_End < '=> date("Y-m-d H:i:s", time() + self::WEEK));
    }            
    $this->db->where($where); 
    $this->db->order_by('Day.Day_Prognosis_End DESC'); 

    $query = $this->db->get();
    return $query->result();
  }
  
  public static function getLastChampionship($user, $limit = 5){
      $results = array();
      $instChampionship = new self();
      $instChampionship->db->from('Championship');
      $instChampionship->db->join('Day', ' Day.Championship_Id = Championship.Championship_Id', 'left');
      $instChampionship->db->join('Statistic', ' Day.Day_Id = Statistic.Day_Id', 'left');
      $instChampionship->db->join('User', ' User.User_Id = Statistic.User_Id', 'left');
      $instChampionship->db->join('Championship_has_User', ' Championship_has_User.Championship_Id = Championship.Championship_Id');
       
      $where = array('Day.Day_Status' => self::EXPIRED, 
                      'Championship_has_User.User_Id' => $user->User_Id);
                      
      $instChampionship->db->where($where);
        
      $instChampionship->db->limit($limit); 
      $query = $instChampionship->db->get();
      
      foreach($query->result() as  $championship){
          $userName = $championship->User_Name." ".$championship->User_Lastname;
          if($userName != ' '){
            if(!empty($results[$championship->Championship_Name][$userName])){
                $results[$championship->Championship_Name][$userName] += (int) $championship->Statistic_Point;
            } else {
                $results[$championship->Championship_Name][$userName] = (int) $championship->Statistic_Point;
            }
         }    
      }
      return $results;
  }
  
  public function getAllChampionships(){
     $this->db->from('Championship');
     $this->db->order_by('Championship.Championship_Id ASC'); 

     $query = $this->db->get();
     return $query->result();

  }
}
?>