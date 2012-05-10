<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="game">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        
    <form class="well form-horizontal" method="post">
        <h3> Add a Game </h3>
          <div class="control-group">
            <label for="gameType" class="control-label">Name of the day :</label>
            <div class="controls">
              <select name="game[day_Id]"  id="gameType" class="span6">
                <?php foreach ($days as $day) : ?>
                        <option value="<?php echo $day->Day_Id ?>"><?php echo $day->Day_Name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
         <div class="control-group">
            <label for="name1" class="control-label">Team 1 :</label>
            <div class="controls">
              <input type="text" name="game[Game_Team1]" id="name1" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="name2" class="control-label">Team 2:</label>
            <div class="controls">
              <input type="text" name="game[Game_Team2]" id="name2" class="input-xlarge">
            </div>
          </div>
          <div class="form-actions">
             <button class="btn btn-primary" type="submit">Add</button>
          </div>

        <?php if (!empty($status) && $status == 'insert') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your championship are recorded
        </div>
        <?php endif; ?>
    </form>
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name of the day</th>
            <th>Team 1</th>
            <th>Team 2</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($games as $game) :?>
                <tr>
                    <td>
                         <?php echo $game->Day_Name  ?>
                    </td>
                    <td>
                         <?php echo $game->Game_Team1  ?>
                    </td>
                    <td>
                         <?php echo $game->Game_Team2 ?>
                    </td>
                </tr>  
            <?php endforeach;?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>