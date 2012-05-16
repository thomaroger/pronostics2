<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>

<div class="container-fluid" id="associate">
  <div class="row-fluid">
    <div class="span4">
       <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        <?php echo form_open(""); ?>
         <h3>
             Associate championship to <?php echo $userToAssociate->User_Name; ?> <?php echo $userToAssociate->User_Lastname; ?>         
         </h3>
          <?php echo anchor('backend/users', "<i class='icon-step-backward'></i> Return to users"); ?> 
         <table class="table table-striped table-bordered table-condensed"></table>
         <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name of Championships</th>
            <th>Associate</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($championships as $championship) :?>
              <tr>
                  <td><?php echo $championship->Championship_Name?></td>
                  <td>
                    <label class="checkbox">
                        <input type="checkbox" value="1" id="isAdmin" name="associate[Championship_Id][<?php echo $championship->Championship_Id?>]" <?php echo Modeluser::checkAssociationChampionship($userToAssociate->User_Id, $championship->Championship_Id)?"checked":"" ?>>
                        Make championship available for this user.
                    </label>
                  </td>
              </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      <?php if (!empty($status) && $status == 'insert') : ?>
      <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your associations are recorded
      </div>
      <?php endif; ?>
      <input type="hidden" name="associate[User_Id]" value="<?php echo $userToAssociate->User_Id?>" />
      <input type="submit" class="btn-primary" value="Associate" />
  </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>