<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('menuTemplate');?>
 
<div class="container-fluid" id="championship">
  <div class="row-fluid">
    <div class="span4">
        <?php $this->load->view('sidebarTemplate');?> 
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
            <th>predictions</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($championships as $championship) :?>
                <?php 
                    $label = 'label-important';
                    if ($championship->Day_Status == Modelday::ACTIF ){
                       $label = 'label-success';  
                    }
                ?>
               <tr>
                    <td>
                         <?php echo anchor('day/'.$championship->Day_Id,$championship->Championship_Name); ?>
                    </td>
                    <td>
                        <?php echo anchor('day/'.$championship->Day_Id, $championship->GameType_Name); ?>
                    </td>
                    <td>
                        <?php echo anchor('day/'.$championship->Day_Id, $championship->Day_Name); ?>
                    </td>
                    <td><?php echo $championship->Day_Prognosis_End ?></td>
                    <td><span class="label <?php echo $label ?>"><?php echo Modelchampionship::$statuses[$championship->Day_Status] ?></span></td>
                    <td>
                        <?php if(Modelprognosis::checkPrognosis($championship->Day_Id, $user->User_Id)) : ?>
                            <i class="icon-ok"></i>
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