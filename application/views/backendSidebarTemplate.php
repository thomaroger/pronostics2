<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo $user->User_Name. " ".$user->User_Lastname; ?></li>
                <li><i class="icon-cog"></i> Last signin : <?php echo $user->User_Activity; ?></li>
                <li><a href="/championship"><i class="icon-pencil"></i> Frontend</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header">Last Signin</li>
                <?php 
                $lastSignins = ModelUser::getLastSignin(5); 
                foreach ($lastSignins as $lastSignin) : ?>
                  <li><?php echo $lastSignin->User_Name.' '.$lastSignin->User_Lastname.' '.$lastSignin->User_Activity; ?> </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>



<?php if(isset($filters)) : ?>
<div class="span11">
    <div class="thumbnail">
        <div class="caption">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="icon-cog"></i> Filters</li>
                <form class="well form-horizontal backendSideBar" method="get">
                  <?php foreach($filters as $filter) : ?>
                    <li>
                      <div class="control-group">
                        <label for="<?php echo $filter['Name']; ?>" class="control-label"><?php echo $filter['Label']; ?> : </label>
                        <div class="controls">
                          <select name="filters[<?php echo $filter['Name']; ?>]"  id="<?php echo $filter['Name']; ?>" class="span13">
                            <?php foreach ($filter['Values'] as $id => $name) : ?>
                                    <option value="<?php echo $id ?>"><?php echo $name?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?> 
                  <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Filters</button>
                 </div>
                </form>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>