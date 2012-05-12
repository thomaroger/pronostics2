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
                <a href="/user/requestPassword">Forgot password?</a>                    
            </div>
            
          <?php if(!empty($fail)) : ?>
              <div class="alert alert-error">Erreur lors de la connexion</div>
          <?php endif; ?>
        </fieldset>
        </div>
    </div>
</div>
<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>


