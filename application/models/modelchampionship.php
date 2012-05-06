<?php
class Modelchampionship extends CI_MODEL {

  public function getChampionships($user){
    
    $this->db->from('Championship');
    $this->db->join('Championship_has_User', ' Championship_has_User.Championship_Id = Championship.Championship_Id');
    $this->db->join('GameType', ' GameType.GameType_Id = Championship.GameType_Id');
    $this->db->where('Championship_has_User.User_Id', $user->User_Id); 
    $query = $this->db->get();
    return $query->result();
  }

}

?>