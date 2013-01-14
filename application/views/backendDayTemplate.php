<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>

<div class="container-fluid" id="day">
  <div class="row-fluid">
    <div class="span4">
       <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        <?php echo form_open("/backend/result/$day->Day_Id"); ?>
         <h3><?php echo $day->Championship_Name; ?> : <?php echo $day->Day_Name; ?></h3>
         <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Domicile</th>
            <th colspan="2" >Score</th>
            <th>Extérieur</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($games as $k => $game) :?>
              <tr>
                  <td><?php echo $game->Game_Team1?></td>
                  <td><input type="text" name="pronos[<?php echo $games2[$k]->Game_Id?>][team1]" value="<?php echo isset($game->Result_Team1)?$game->Result_Team1:''?>" required></td>
                  <td><input type="text" name="pronos[<?php echo $games2[$k]->Game_Id?>][team2]" value="<?php echo isset($game->Result_Team2)?$game->Result_Team2:''?>" required></td>
                  <td><?php echo $game->Game_Team2?></td>
              </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      <?php if (!empty($status) && $status == 'insert') : ?>
      <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your predictions are recorded
      </div>
      <?php endif; ?>
        <?php if (!empty($status) && $status == 'updated') : ?>
      <div class="alert alert-info">
          <h4 class="alert-heading">Congrats !</h4>
          your result are updated
      </div>
      <?php endif; ?>
      <input type="hidden" name="pronos[dayId]" value="<?php echo $day->Day_Id?>" />
      <input type="submit" class="btn-primary" value="Submit" />
  </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>	
