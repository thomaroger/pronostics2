<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Frontend : Pronostics</a>
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
