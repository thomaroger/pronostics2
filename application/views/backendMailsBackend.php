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
        <h3> Add a Mail </h3>
          <div class="control-group">
            <label for="tag" class="control-label">Tag :</label>
            <div class="controls">
              <input type="text" name="mail[Mail_Tag]" id="tag" required class="input-xlarge">
            </div>
          </div>
          <div class="control-group">
            <label for="text" class="control-label">Text :</label>
            <div class="controls">
              <textarea  name="mail[Mail_Text]" id="text" required class="input-xlarge" style="width: 650px; height: 200px;"></textarea>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Add</button>
          </div>

        <?php if (!empty($status) && $status == 'insert') : ?>
        <div class="alert alert-success">
          <h4 class="alert-heading">Congrats !</h4>
          your mail are recorded
        </div>
        <?php endif; ?>
    </form>
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Tag</th>
            <th>Text</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($mails as $mail) :?>
               <tr>
                    <td>
                         <?php echo $mail->Mail_Tag ?>
                    </td>
                    <td>
                         <?php echo $mail->Mail_Text ?>
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