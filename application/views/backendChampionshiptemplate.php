<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="championship">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        
    <form class="well form-horizontal" method="post">
        <h3> Add a championship </h3>
          <div class="control-group">
            <label for="name" class="control-label">Name :</label>
            <div class="controls">
              <input type="text" name="championship[Championship_Name]" id="name" class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="gameType" class="control-label">Type of Game :</label>
            <div class="controls">
              <select name="championship[GameType_Id]"  id="gameType">
                <?php foreach ($gameTypes as $gameType) : ?>
                        <option value="<?php echo $gameType->GameType_Id ?>"><?php echo $gameType->GameType_Name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
         <div class="control-group">
            <label for="begin" class="control-label">Date :</label>
            <div class="controls">
              <input type="text" id="begin" name="championship[Championship_Begin]" class="input-xlarge" placeholder='yyyy-mm-jj (ex:2011-10-03)' required>
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
            <th>Type of Sport</th>
            <th>Name</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($championships as $championship) :?>
               <tr>
                    <td>
                         <?php echo $championship->GameType_Name ?>
                    </td>
                    <td>
                         <?php echo $championship->Championship_Name ?>
                    </td>
                    <td>
                         <?php echo $championship->Championship_Begin ?>
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