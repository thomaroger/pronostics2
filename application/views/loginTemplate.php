<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Pronostics</a>
    </div>
  </div>
</div>

<div class="container" id="login">
    <div class="row-fluid">
        <div class="span4">
      <?php echo form_open("/login/signin"); ?>
      <fieldset>
        <legend>
            <span>Pronostics</span>
        </legend>
            <div class="control-group">
                <label class="control-label" for="signin_username">Email :</label>
                <div class="controls">
                    <input type="text" id="signin_username" name="email" type=email placeholder="exemple@domaine.com" required />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="signin_username">Password :</label>
                <div class="controls">
                    <input type="password" name="password" required  />
                </div>
            </div>
            <div class="form-actions center">
                <input type="submit" value="Sign in" class="btn btn-primary">
                <a data-toggle="modal" href="#myModal">Forgot password?</a>                    
            </div>          
          <?php if(!empty($fail)) : ?>
              <div class="alert alert-error">Error when login</div>
          <?php endif; ?>
          <?php if(!empty($password)) : ?>
              <div class="alert alert-success">Your password will be sent in your mail box !</div>
          <?php endif; ?>
        </fieldset>
        </form>
        </div>
    </div>
</div>

<div class="modal" id="myModal" style="display:none;">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Forgot password ?</h3>
  </div>
  <?php echo form_open("/login/generatePassword"); ?>
  <div class="modal-body">
    <div class="control-group">
      <label class="control-label" for="signin_username">Email :</label>
      <div class="controls">
        <input type="text" id="signin_username" name="email" type=email placeholder="exemple@domaine.com" required />
      </div>
    </div>
  </div>
  <div class="modal-footer">
     <input type="submit" value="Reset my password" class="btn btn-primary">
  </div>
  </form>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>


