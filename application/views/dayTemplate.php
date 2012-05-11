<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('menuTemplate');?>

<div class="container-fluid" id="day">
  <div class="row-fluid">
    <div class="span4">
       <?php $this->load->view('sidebarTemplate');?> 
    </div>
    <div class="span8">
        <?php echo form_open("/day/$day->Day_Id"); ?>
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
          <?php foreach($games as $game) :?>
              <tr>
                  <td><?php echo $game->Game_Team1?></td>
                  <td><input type="text" name="pronos[<?php echo $game->Game_Id?>][team1]" value="<?php echo isset($game->Prognosis_Team1)?$game->Prognosis_Team1:''?>" required></td>
                  <td><input type="text" name="pronos[<?php echo $game->Game_Id?>][team2]" value="<?php echo isset($game->Prognosis_Team2)?$game->Prognosis_Team2:''?>" required></td>
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
          your predictions are updated
      </div>
      <?php endif; ?>
      <input type="hidden" name="pronos[dayId]" value="<?php echo $day->Day_Id?>" />
      <?php if(date("Y-m-d H:i:s", time()) < $day->Day_Prognosis_End ) : ?>
      <input type="submit" class="btn-primary" value="Submit" />
      <?php else: ?>
         <div class="alert alert-error">
          <h4 class="alert-heading">Warning !</h4>
          your predictions can't be recording ! The end of the day is passed ! 
      </div> 
      <?php endif; ?>
  </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>