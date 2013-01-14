<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('menuTemplate');?>

<div class="container-fluid" id="statistics">
  <div class="row-fluid">
    <div class="span4">
       <?php $this->load->view('sidebarTemplate');?> 
    </div>
    <div class="span8">
       <form class="well form-horizontal" method="post">
        <h3> Update your account </h3>
          <div class="control-group">
            <label for="email" class="control-label">Email :</label>
            <div class="controls">
              <input type="text" name="user[User_Email]" id="email" class="input-xlarge" value="<?php echo $user->User_Email?>" disabled />
            </div>
          </div>
          <div class="control-group">
            <label for="name" class="control-label">Name :</label>
            <div class="controls">
              <input type="text" name="user[User_Name]" id="name" class="input-xlarge" value="<?php echo $user->User_Name?>" />
            </div>
          </div>
          <div class="control-group">
            <label for="lastname" class="control-label">Lastname :</label>
            <div class="controls">
              <input type="text" name="user[User_LastName]" id="lastname" class="input-xlarge" value="<?php echo $user->User_Lastname?>" disabled />
            </div>
          </div>
          
          <div class="form-actions">
             <input type="hidden" name="User_Id" value="<?php echo $user->User_Id; ?>">
             <button class="btn btn-primary" type="submit">Update</button>
          </div>

        <?php if (!empty($status) && $status == 'updated') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your account are updated !
        </div>
        <?php endif; ?>
    </form>
    </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>