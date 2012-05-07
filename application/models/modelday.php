<?php
class Modelday extends CI_MODEL {

  public function getGames($dayId, $userId = 0){
    $this->db->from('Game');
    $this->db->where('Day_Id',(int) $dayId);
    if($userId > 0) {
        $this->db->join('Prognosis', ' Prognosis.Game_Id = Game.Game_Id', 'left'); 
        $this->db->where('Prognosis.User_id',(int) $userId); 
    }
    $query = $this->db->get();
    //var_dump($query->num_rows());
    if($query->num_rows() == 0) {
        $this->db->from('Game');
        $this->db->where('Day_Id',(int) $dayId);  
        $query = $this->db->get();
    }
    return $query->result();
  }
  

  
  public function getDay($dayId){
      $this->db->from('Day');
      $this->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
      $this->db->where('Day.Day_Id', $dayId);
      $query = $this->db->get();
      return $query->result();
  }

}

?>