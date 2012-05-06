<?php
class Modelchampionship extends CI_MODEL {

  const WEEK = 1209600;// 14 days;
  
  public function getChampionships($user){
    
    $this->db->from('Championship');
    $this->db->join('Championship_has_User', ' Championship_has_User.Championship_Id = Championship.Championship_Id');
    $this->db->join('GameType', ' GameType.GameType_Id = Championship.GameType_Id');
    $this->db->join('Day', ' Day.Championship_Id = Championship.Championship_Id', 'left');
    
    $where = array('Championship_has_User.User_Id' => $user->User_Id,
                   'Day.Day_Prognosis_Begin >' => time() - self::WEEK,
                   'Day.Day_Prognosis_End < '=> time() + self::WEEK);
    
    $this->db->where($where); 
    $query = $this->db->get();
    return $query->result();
  }

}

?>