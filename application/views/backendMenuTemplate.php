<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/backend">Backend : Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li><a href="/backend">Results</a></li>
            <li><a href="/backend/users">Users</a></li>
            <li><a href="/backend/typeGames">Type Of Games</a></li>
            <li><a href="/backend/championships">Championships</a></li>
            <li><a href="/backend/days">Days</a></li>
            <li><a href="/backend/games">Games</a></li>
            <li><a href="/backend/predictions">Predictions</a></li>
            <li><a href="/backend/results">Statistics</a></li>
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
