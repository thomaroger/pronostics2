<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<div id="login">

  <?php echo form_open("index.php/login/signin"); ?>
  <fieldset>
    <legend>Connexion</legend>
        <div class="ligne">
            <label for="email"> Email </label>
            <br />
            <input id="email" name="email" type=email placeholder="exemple@domaine.com" required />  
        </div>
        <div class="ligne">
            <label> Password </label>
            <br />
            <input type="password" name="password" required />  
        </div>
        <div class="ligne">
            <input type="submit" value="signin" />
        </div>
        
      <?php if(!empty($fail)) : ?>
          <span class="error">Erreur lors de la connexion</span>
      <?php endif; ?>
    </fieldset>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>