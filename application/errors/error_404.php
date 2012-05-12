<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset=utf-8>
    <title>Pronostics</title>
    
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/pronostics.css" />
    
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/bootstrap.js"></script>
	<script type="text/javascript" src="/js/pronostics.js"></script>

</head>
<body>

<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">Frontend : Pronostics</a>
      <div class="nav-collapse">
          <ul class="nav">
            <li class="active"><a href="/championship">Championship</a></li>
            <li><a href="/statistics">Statistics</a></li>
          </ul>
        </div>
    </div>
  </div>
</div>



<div class="container-fluid" id="day">
  <div class="row-fluid">
    <div class="span4"></div>
    <div class="span8">		
    <h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
   </div>
  </div> 
</div>
</div>


</body>
</html>