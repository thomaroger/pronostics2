<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="statistics">
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
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($statistics as $statistic) : ?>
               <tr>
                    <td>
                         <?php echo $statistic->User_Name." ".$statistic->User_Lastname;  ?>
                    </td>
                    <td>
                         <?php echo $statistic->Championship_Name." : ".$statistic->Day_Name;  ?>
                    </td>
                    <td>
                         <?php echo $statistic->Statistic_Point." pts"; ?>
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