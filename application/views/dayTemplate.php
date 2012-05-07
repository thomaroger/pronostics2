<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li class="active"><a href="/championship">Championship</a></li>
            <li><a href="/statistics">Statistics</a></li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <?php echo $user->User_Name. " ".$user->User_Lastname; ?>
                  <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/account"><i class="icon-user"></i> Account</a></li>
                <li><a href="/logout"><i class="icon-off"></i> Sign out</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </div>
</div>

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
      <input type="submit" class="btn-primary" value="Submit" />
  </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>