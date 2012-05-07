<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('backendMenuTemplate');?>
 
<div class="container-fluid" id="championship">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('backendSidebarTemplate');?> 
    </div>
    <div class="span8">
        <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Name of the championship</th>
            <th>Type of the game</th>
            <th>Name of the day</th>
            <th>End date of prognostic</th>
            <th>Status</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($championships as $championship) :?>
                <?php 
                    $label = 'label-important';
                    if ($championship->Day_Status == Modelchampionship::ACTIF ){
                       $label = 'label-success';  
                    }
                ?>
               <tr>
                    <td>
                         <?php echo anchor('backend/result/'.$championship->Day_Id,$championship->Championship_Name); ?>
                    </td>
                    <td>
                        <?php echo anchor('backend/result/'.$championship->Day_Id, $championship->GameType_Name); ?>
                    </td>
                    <td>
                        <?php echo anchor('backend/result/'.$championship->Day_Id, $championship->Day_Name); ?>
                    </td>
                    <td><?php echo $championship->Day_Prognosis_End ?></td>
                    <td><span class="label <?php echo $label ?>"><?php echo Modelchampionship::$statuses[$championship->Day_Status] ?></span></td>
                    <td>
                        <?php if(Modelresult::checkPrognosis($championship->Day_Id)) : ?>
                            <i class="icon-ok-sign"></i>
                        <?php endif; ?>
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