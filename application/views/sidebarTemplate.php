<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo $user->User_Name. " ".$user->User_Lastname; ?></li>
                <li><i class="icon-cog"></i> Last signin : <?php echo date("d/m/Y H:i:s", time());?></li>
                <?php if($user->User_Admin == Modeluser::ADMIN):?>
                    <li><a href="#"><i class="icon-pencil"></i> Backend</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header">Last Days</li>
                <li><i class="icon-cog"></i> 11e Journee </a></li>
                <li>ROGER Thomas 10 pts</li>
            </ul>
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