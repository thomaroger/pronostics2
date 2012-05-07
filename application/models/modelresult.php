<?php
class Modelresult extends CI_MODEL {
    
    const PTS_SAME_SCORE = 3;
    const PTS_SAME_WINNER = 1;
    
 public static function checkPrognosis($dayId){
     $gamesId = array();
     $instPrognosis = new self();
     $instPrognosis->db->where('Day_Id', $dayId);
     $instPrognosis->db->select('Game_Id');
     $query = $instPrognosis->db->get('Game');
     foreach($query->result() as $res){
        $gamesId[] = $res->Game_Id;
     }
     $instPrognosis->db->where_in('Game_Id', $gamesId);
     $query = $instPrognosis->db->get('Result');
     if($query->num_rows() >= 1){
          return true;
    }
    return false;      
 }
 
  public function generateStatistic($dayId){
      $statistics = array();
      $games = $this->modelDay->getGames($dayId);
      foreach($games as $game){
          $this->db->where('Game_Id', $game->Game_Id);
          $result = $this->db->get('Result')->result();
          $this->db->where('Game_Id', $game->Game_Id);
          $pronostics = $this->db->get('Prognosis')->result();
          
          foreach($pronostics as $pronostic){
              $point = 0;
              if($pronostic->Prognosis_Win == $result[0]->Result_Win){
                 $point = self::PTS_SAME_WINNER;  
              }
              $isSameScore = $pronostic->Prognosis_Team2 == $result[0]->Result_Team1 && $pronostic->Prognosis_Team2 == $result[0]->Result_Team2; 
               if($isSameScore){
                 $point = self::PTS_SAME_SCORE;
              }
              if(!empty($statistics[$pronostic->User_Id])){
                  $statistics[$pronostic->User_Id] += $point;
              }else{
                   $statistics[$pronostic->User_Id] = $point;
              }
          }
      }
      $this->db->delete('Statistic', array('Day_Id' => $dayId)); 
      foreach($statistics as $user => $statistic){
          $data = array(
               'User_id' => $user ,
               'Day_id' => $dayId ,
               'Statistic_Point' => $statistic
            );

        $this->db->insert('Statistic', $data);
      }
  }

}

?>