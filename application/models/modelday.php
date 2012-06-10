<?php
class Modelday extends CI_MODEL {
  
    const EXPIRED = 1;
    const ACTIF = 0;
  
  public function getGames($dayId, $userId = 0, $isAdmin = 0){
    $this->db->from('Game');
    $this->db->where('Day_Id',(int) $dayId);
    
    if($isAdmin){
        $this->db->join('Result', ' Result.Game_Id = Game.Game_Id', 'left'); 
    }else if($userId > 0) {
        $this->db->join('Prognosis', ' Prognosis.Game_Id = Game.Game_Id'); 
        $this->db->where('Prognosis.User_id',(int) $userId); 
    }

    $query = $this->db->get();

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

  public static function getLastDays($user, $limit = 5){
       $instDay = new self();
       $instDay->db->from('Day');
       $instDay->db->join('Statistic', ' Statistic.Day_Id = Day.Day_Id', 'left'); 
       $instDay->db->join('Championship', ' Day.Championship_Id = Championship.Championship_Id', 'left');
       $instDay->db->join('User', ' Statistic.User_Id = User.User_Id', 'left');
       $instDay->db->join('Championship_has_User', ' Championship_has_User.Championship_Id = Championship.Championship_Id');
       
       $where = array('Day.Day_Status' => self::EXPIRED, 
                      'Championship_has_User.User_Id' => $user->User_Id);
                      
       $instDay->db->where($where);
       
       $instDay->db->order_by("Day.Day_Id DESC, Statistic.Statistic_Point DESC"); 
       
       $instDay->db->limit($limit); 
       $query = $instDay->db->get();
       return $query->result();
  }
}

?>