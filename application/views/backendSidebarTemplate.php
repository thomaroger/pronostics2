<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo $user->User_Name. " ".$user->User_Lastname; ?></li>
                <li><i class="icon-cog"></i> Last signin : <?php echo date("d/m/Y H:i:s", time());?></li>
                <?php if($user->User_Admin == Modeluser::ADMIN):?>
                    <li><a href="/championship"><i class="icon-pencil"></i> Frontend</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header">Last Signin</li>
                <li>ROGER Thomas <?php echo date("d/m/Y H:i:s", time());?> </li>
            </ul>
        </div>
    </div>
</div>
