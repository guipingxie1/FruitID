<?php
require_once('php/query.php');

$query = new Query();

$input_query = 'red green seeds';
$result_query = $query -> getResult($input_query);

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
<!--
  <ul class="nav nav-sidebar side-font green-bar"> 
  	<li><div class = "sidebar-fruit"> Your Results </div></li>
    <?php
    	for ($i = 0; $i < count($result_query); ++$i) {
    		echo '<li><a href = "info.php?fruit=' . $result_query[$i] . '&query=true"> ' . $result_query[$i] . ' </a></li>';
    	}
    ?>
  </ul>
-->  
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

<div class="col-md-8 col-md-offset-2 main">
  <h3><?php 
  				echo 'You searched for: "' . $input_query . '"'; 
  				echo '<div class = "make-one-space"></div>'; 
  				echo '<div class = "small-black-bar info-space"></div>';
			?>
	</h3>
	
  <h2> Your Results </h2>
  <div class = "black-bar make-space"></div>
  <?php
    	for ($i = 0; $i < count($result_query); ++$i) {
    		echo '<div class = "make-one-space results-font"><a href = "info.php?fruit=' . $result_query[$i] . '&query=true"> ' . $result_query[$i] . ' </a></div>';
    		
    		$description = $query -> getDes($result_query[$i]);
    		echo '<div class = "small-tab make-one-space"> ' . $description[2] . ' </div>';
    	}
  ?>
<!--  
  <div class = "make-one-space black-bar make-one-space"></div>
 	<div class = "make-one-space results-font"><a href = "info.php?fruit=apricot&query=true"> Apricot </a></div>
 	<div class = "small-tab make-one-space"> Small Description </div>
  <div class = "make-one-space results-font"><a href = "info.php?fruit=banana&query=true"> Banana </a></div>
  <div class = "small-tab make-one-space"> Small Description </div>
  <div class = "make-one-space results-font"><a href = "info.php?fruit=cranberry&query=true"> Cranberry </a></div>
  <div class = "small-tab make-one-space"> Small Description </div>
-->

  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
