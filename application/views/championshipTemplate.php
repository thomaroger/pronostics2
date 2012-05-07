<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li class="active"><a href="/championship">Championship</a></li>
            <li><a href="/statistics">Statistics</a></li>
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <?php echo $user->User_Name. " ".$user->User_Lastname; ?>
                  <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/account"><i class="icon-user"></i> Account</a></li>
                <li><a href="/logout"><i class="icon-off"></i> Sign out</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </div>
</div>

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
                    if ($championship->Day_Status == Modelchampionship::ACTIF ){
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