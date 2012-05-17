<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="user">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        
    <form class="well form-horizontal" method="post">
        <h3> Add a user </h3>
          <div class="control-group">
            <label for="email" class="control-label">Email :</label>
            <div class="controls">
              <input type="text" name="user[User_Email]" id="email "type="email" placeholder="exemple@domaine.com" required class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="password" class="control-label">Password :</label>
            <div class="controls">
              <input type="password" name="user[User_Password]" id="password" required class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="name" class="control-label">Name :</label>
            <div class="controls">
              <input type="text" name="user[User_Name]" id="name" required class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="lastname" class="control-label">Lastname :</label>
            <div class="controls">
              <input type="text" name="user[User_Lastname]" id="lastname" required class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="isAdmin" class="control-label">Is Admin ?</label>
            <div class="controls">
              <label class="checkbox">
                <input type="checkbox" value="1" id="isAdmin" name="user[User_Admin]">
                Make backend available for this user.
              </label>
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Add</button>
          </div>

        <?php if (!empty($status) && $status == 'insert') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your user are recorded
        </div>
        <?php endif; ?>
    </form>
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Lastname </th>
            <th>Admin </th>
            <th>Activity </th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($users as $userback) :?>
               <tr>
                    <td>
                         <?php echo $userback->User_Email ?>
                    </td>
                    <td>
                         <?php echo $userback->User_Name ?>
                    </td>
                    <td>
                         <?php echo $userback->User_Lastname ?>
                    </td>
                    <td>
                        <?php if ($userback->User_Admin == 1) : ?>
                              <i class="icon-ok-sign"></i>
                        <?php endif; ?> 
                    </td>
                    <td>
                         <?php echo $userback->User_Activity ?>
                    </td>
                    <td>
                         <ul class="unstyled">
                            <li><?php echo anchor('backend/userAssociate/'.$userback->User_Id, "<i class='icon-tags'></i> Associate"); ?></li>
                            <li><?php echo anchor('backend/userAssociate/'.$userback->User_Id, "<i class='icon-user '></i> Pretenting to be"); ?></li>
                         </ul>
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