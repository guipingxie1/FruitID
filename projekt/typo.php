<?php
require_once('php/query.php');

$query = new Query();

// must be true unless someone manually types in stuff
if (isset($_GET['fruit']) && isset($_GET['query'])) {
  // check to see if anyone messed with it and return typo.php
  $fruit = ucfirst($_GET['fruit']);
  $fruit = str_replace('_', ' ', $fruit);					// make sure to str_replace ' ' to '_'
  $nut = $query -> getNutri($fruit);
  $nutri = $nut[0];

  $query_flag = $_GET['query'];
  //echo $query_flag;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Typo Test</title>

<link rel="stylesheet"
href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="css/test.css" rel="stylesheet">
<link href="css/sidebar.css" rel="stylesheet">

</head>

<body>

<nav class="navbar make-green navbar-fixed-top header">
  <div class="navbar-header">
    <a class="navbar-brand big-text make-white" href="search.php"><span
        class="glyphicon glyphicon-home make-white"></span> FruitID</a>
  </div>

  <form class="navbar-form navbar-right" role="form" method="post" action="results.php">
    <div class="form-group">
      <input type="text" class="form-control" name="query" id="query" placeholder="Your description here (ie shape, color, size, taste, location)">
      <button type="submit" name="search" value="search" class="btn btn-success nav-button">
        <span class="glyphicon glyphicon-search"></span> Search
      </button>
    </div>
  </form>        
</nav>

<!-- Sidebar -->
<div class="col-md-2 sidebar">
  <ul class="nav nav-sidebar small-side-font green-bar">
    <li><div class = "sidebar-fruit"> All Fruits </div></li>
			<?php
				$fruits = $query -> getAllFruit();
				foreach ($fruits as $name) {
			?>
    	  <li><a href = "<?php echo 'info.php?fruit=' . $name['Name'] . '&query=false'?>"> <?php echo $name['Name'] ?> </a></li>
      <?php } ?>
  </ul>
</div>

<!-- Website: https://en.wikipedia.org/wiki/FRUIT_NAME
                                                        https://ndb.nal.usda.gov/ndb/foods?format=&count=&max=35&sort=&fgcd=Fruits+and+Fruit+Juices&manu=&lfacet=&qlookup=&offset=NUMBER_35MOD&order=desc -->
<!-- only get raw fruits -->

<div class="col-md-5 col-md-offset-2 main">
  <h3><?php if (strcmp($query_flag, 'true') == 0) echo 'You searched for: Return Query' ?></h3>			<!-- const -->
  <h2><?php echo $fruit ?></h2> 
  <div class = "info-space"></div>
  <div class = "black-bar info-space"></div>
  
  <h4> Description </h4>

	

  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>