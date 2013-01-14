<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/backend">Backend : Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li <?php echo $action=='results'?"class='active'":''; ?> ><a href="/backend">Results</a></li>
            <li <?php echo $action=='users'?"class='active'":''; ?> ><a href="/backend/users">Users</a></li>
            <li <?php echo $action=='typeGames'?"class='active'":''; ?> ><a href="/backend/typeGames">Type Of Games</a></li>
            <li <?php echo $action=='championships'?"class='active'":''; ?> ><a href="/backend/championships">Championships</a></li>
            <li <?php echo $action=='days'?"class='active'":''; ?> ><a href="/backend/days">Days</a></li>
            <li <?php echo $action=='games'?"class='active'":''; ?> ><a href="/backend/games">Games</a></li>
            <li <?php echo $action=='predictions'?"class='active'":''; ?> ><a href="/backend/predictions">Predictions</a></li>
            <li <?php echo $action=='statistics'?"class='active'":''; ?> ><a href="/backend/statistics">Statistics</a></li>
            <li <?php echo $action=='mails'?"class='active'":''; ?> ><a href="/backend/mails">Mails</a></li>
            
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <?php echo $user->User_Name. " ".$user->User_Lastname; ?>
                  <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/championship"><i class="icon-user"></i> Frontend</a></li>
                <li><a href="/logout"><i class="icon-off"></i> Sign out</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </div>
</div>
