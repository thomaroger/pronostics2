<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/backend">Backend : Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li class="active"><a href="/backend">Results</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/users">Championships</a></li>
            <li><a href="/users">Days</a></li>
            <li><a href="/users">Games</a></li>
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
