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
      Helloworld
    </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>