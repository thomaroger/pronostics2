<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="gameType">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        
    <form method="post" class="well form-inline">
        <h3> Add a type of Game </h3>
        <input type="text" class="input" name="gameType[GameType_Name]" required />
        <button type="submit" class="btn btn-primary">Add</button>
        <?php if (!empty($status) && $status == 'insert') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your type of game are recorded
        </div>
        <?php endif; ?>
    </form>
        
        
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Type of Sport</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($gameTypes as $gameType) :?>
               <tr>
                    <td>
                         <?php echo $gameType->GameType_Name ?>
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