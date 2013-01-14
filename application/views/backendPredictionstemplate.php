<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="predictions">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        
    <form />
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>User</th>
            <th>Day</th>
            <th>Prediction</th>
            <th>Winner of the game</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($predictions as $prediction) : ?>
               <tr>
                    <td>
                         <?php echo $prediction->User_Name." ".$prediction->User_Lastname;  ?>
                    </td>
                    <td>
                         <?php echo $prediction->Championship_Name." : ".$prediction->Day_Name;  ?>
                    </td>
                    <td>
                         <?php echo $prediction->Game_Team1." ".$prediction->Prognosis_Team1." - ".$prediction->Prognosis_Team2." ".$prediction->Game_Team2 ?>
                    </td>
                    <td>
                         <?php echo $prediction->Prognosis_Win!='Nul'?$prediction->Prognosis_Win:'No winner'; ?>
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