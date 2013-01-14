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
        
    <form class="well form-horizontal" method="post">
        <h3> Add a day </h3>
          <div class="control-group">
            <label for="name" class="control-label">Name of the day :</label>
            <div class="controls">
              <input type="text" name="day[Day_Name]" id="name" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="gameType" class="control-label">Name of the Championship :</label>
            <div class="controls">
              <select name="day[Championship_Id]"  id="gameType" class="span6">
                <?php foreach ($championships as $championship) : ?>
                        <option value="<?php echo $championship->Championship_Id ?>"><?php echo $championship->Championship_Name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
         <div class="control-group">
            <label for="begin" class="control-label">Begin of the pronostics for the day :</label>
            <div class="controls">
              <input type="text" id="begin" name="day[Day_Prognosis_Begin]" class="input-xlarge" placeholder='yyyy-mm-jj hh:mm:ss(ex:2011-10-03 12:23:00)' required>
            </div>
          </div>
          <div class="control-group">
            <label for="end" class="control-label">End of the pronostics for the day :</label>
            <div class="controls">
              <input type="date" id="end" name="day[Day_Prognosis_End]" class="input-xlarge" placeholder='yyyy-mm-jj hh:mm:ss(ex:2011-10-03 13:23:00)' required>
            </div>
          </div>
          <div class="form-actions">
             <input type="hidden" name="day[Day_Status]" value="<?php echo Modelday::ACTIF; ?>">
             <button class="btn btn-primary" type="submit">Add</button>
          </div>

        <?php if (!empty($status) && $status == 'insert') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your day are recorded
        </div>
        <?php endif; ?>
    </form>
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name of the day</th>
            <th>Name of the Championship</th>
            <th>Begin of the pronostics for the day</th>
            <th>End of the pronostics for the day</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($days as $day) :?>
                <?php
                    $label = 'label-important';
                    if ($day->Day_Status == Modelday::ACTIF ){
                       $label = 'label-success';  
                    }
                ?>
               <tr>
                    <td>
                         <?php echo $day->Day_Name  ?>
                    </td>
                    <td>
                         <?php echo $day->Championship_Name  ?>
                    </td>
                    <td>
                         <?php echo $day->Day_Prognosis_Begin ?>
                    </td>
                    <td>
                         <?php echo $day->Day_Prognosis_End ?>
                    </td>
                    <td>
                        <span class="label <?php echo $label ?>"><?php echo Modelchampionship::$statuses[$day->Day_Status] ?></span>
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