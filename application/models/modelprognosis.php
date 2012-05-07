<?php
class Modelprognosis extends CI_MODEL {

 public static function checkPrognosis($dayId, $userId){
     $gamesId = array();
     $instPrognosis = new self();
     $instPrognosis->db->where('Day_Id', $dayId);
     $instPrognosis->db->select('Game_Id');
     $query = $instPrognosis->db->get('Game');
     foreach($query->result() as $res){
        $gamesId[] = $res->Game_Id;
     }
     $instPrognosis->db->where('User_Id', $userId);
     $instPrognosis->db->where_in('Game_Id', $gamesId);
     $query = $instPrognosis->db->get('Prognosis');
     if($query->num_rows() >= 1){
          return true;
    }
    return false;      
 }

}

?>