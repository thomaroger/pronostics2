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
        <div class="caption"><ul>
<?php
    $days = ModelDay::getLastDays(5);
    $dayId = 0;
    foreach($days as $day):  
          if($dayId != $day->Day_Id): 
            $dayId = $day->Day_Id;
            ?>
            </ul><ul class="nav nav-list">
                <li class="nav-header"><?php echo $day->Day_Name; ?></li>
          <?php endif; ?>
           <li><?php echo $day->User_Name.' '.$day->User_Lastname.' '.$day->Statistic_Point.' pts' ; ?></li>
<?php  endforeach; ?>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header">Championship</li>
                <li><i class="icon-cog"></i> Championnat de France 2011-2012 </a></li>
                <li>ROGER Thomas 10 pts</li>
            </ul>
        </div>
    </div>
</div>