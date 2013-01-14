<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo $user->User_Name. " ".$user->User_Lastname; ?></li>
                <li><i class="icon-cog"></i> Last signin : <?php echo $user->User_Activity; ?></li>
                <?php if($user->User_Admin == Modeluser::ADMIN):?>
                    <li><a href="/backend"><i class="icon-pencil"></i> Backend</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption accordion" id="modelday">
        <ul class="nav nav-list"><li class="nav-header">Last Days</li></ul>
        <ul><div>
<?php
    $days = ModelDay::getLastDays($user,6);
    $dayId = 0;
    foreach($days as $day):  
          if($dayId != $day->Day_Id): 
            $dayId = $day->Day_Id;
            ?></div></ul>
            <ul class="nav nav-list accordion-group">
                <li class="nav-header accordion-heading" >
                  <a class="accordion-toggle" href="#model<?php echo $day->Day_Id;?>" data-parent="#modelday" data-toggle="collapse">
                    <?php echo $day->Day_Name; ?>
                  </a>
                </li>
                <div id="model<?php echo $day->Day_Id;?>" class="accordion-body in collapse">
          <?php endif; ?>
           <li><?php echo $day->User_Name.' '.$day->User_Lastname.' '.$day->Statistic_Point.' pts' ; ?></li>
<?php  endforeach; ?>
      </div>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <?php
                $championships = ModelChampionship::getLastChampionship($user);
            ?>
            <ul class="nav nav-list">
                <?php foreach($championships as $name => $results) : ?>
                    <li class="nav-header"><?php echo $name ?></li>
                    <?php foreach($results as $username => $pts) : ?>
                         <li><?php echo $username.' '.$pts.' pts'; ?></li>
                     <?php endforeach; ?>   
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>