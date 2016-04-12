<?php
require_once('php/query.php');

$query = new Query();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Results Test</title>

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
<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar side-font green-bar">
  	<li><div class = "sidebar-fruit"> Your Results </div></li>
    <li><a href = "info.php?fruit=apricot&query=true"> Apricot </a></li>
    <li><a href = "info.php?fruit=banana&query=true"> Banana </a></li>
    <li><a href = "info.php?fruit=cranberry&query=true"> Cranberry </a></li>
  </ul>
  
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

<div class="col-md-7 col-md-offset-2 main">
  <h3> Return Query </h3>			<!-- const -->
  <h2> Links </h2>
  <div class = "make-one-space black-bar make-one-space"></div>
 	<div class = "make-one-space results-font"><a href = "info.php?fruit=apricot&query=true"> Apricot </a></div>
 	<div class = "small-tab make-one-space"> Small Description </div>
  <div class = "make-one-space results-font"><a href = "info.php?fruit=banana&query=true"> Banana </a></div>
  <div class = "small-tab make-one-space"> Small Description </div>
  <div class = "make-one-space results-font"><a href = "info.php?fruit=cranberry&query=true"> Cranberry </a></div>
  <div class = "small-tab make-one-space"> Small Description </div>


  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
