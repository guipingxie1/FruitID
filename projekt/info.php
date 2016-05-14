<?php
require_once('php/query.php');

$query = new Query();

// must be true unless someone manually types in stuff
if ( isset($_GET['fruit']) && isset($_GET['query']) ) {
  // check to see if anyone messed with it and return typo.php
  $fruit = ucfirst($_GET['fruit']);
  
  $main_info = $query -> getMainInfo($fruit);
  $description = $query -> getDes($fruit);
  
  if (isset($_GET['search'])) {
  	$input_query = htmlspecialchars($_GET['search']);
		$input_query = trim($input_query);
		$input_query = preg_replace("/[^a-z]+/", " ", $input_query);	
		$result_query = $query -> getResult($input_query);
  }
  
  $links_and_images = $main_info[0];
  
  $num_images = $links_and_images[1];
  
  $nutri['Calories'] = 0;
  
  if (strcmp($links_and_images[2], '.') != 0) {
  	$nut = $query -> getNutri($links_and_images[2]);
  	$nutri = $nut[0];
  }

  $query_flag = $_GET['query'];
   
  $related_query = "";
  $related_query = $related_query . $fruit . " ";
	$related_query = $related_query . $description[2] . " ";
	$related_query = $related_query . $description[ count($description) - 1 ];	
	$related_query = htmlspecialchars($related_query);
	$related_query = trim($related_query);
	$related_query = strtolower($related_query);
	$related_query = preg_replace("/[^a-z]+/", " ", $related_query);
	
	$related_fruit = $query -> getResult($related_query);
}
else {
	header( "Location: typo.php" ); 
	exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Info Test</title>

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

  <form class="navbar-form navbar-right" method="get" action="results.php">
    <div class="form-group">
      <input type="text" class="form-control" name="search" placeholder="Your description here (ie shape, color, size, taste, location)">
      <button type="submit" value="submit" class="btn btn-success nav-button">
        <span class="glyphicon glyphicon-search"></span> Search
      </button>
    </div>
  </form>        
</nav>

<!-- Sidebar -->
<div class="col-md-2 sidebar">
	<?php 
	if ( count($result_query) > 0 ) { 
		echo '<ul class="nav nav-sidebar side-font green-bar">';
		echo '<li><div class = "sidebar-fruit"> Your Results </div></li>'; 

  	for ($i = 0; $i < count($result_query); ++$i) {
  		echo '<li><a href = "info.php?fruit=' . $result_query[$i] . '&query=true&search=' . $input_query . '"> ' . $result_query[$i] . ' </a></li>';
  	}  
	  	
		echo '</ul>';
  } ?>

	<!-- TO DO -->
  <ul class="nav nav-sidebar side-font green-bar">
	  <li><div class = "sidebar-fruit"> Related Fruits </div></li>
	  <?php
	  	for ( $i = 0; $i < min(5, count($related_fruit)); ++$i ) {
	  		if ( strcmp($related_fruit[$i], $fruit) != 0 ) 
	  			echo '<li><a href = "info.php?fruit=' . $related_fruit[$i] . '&query=false"> ' . $related_fruit[$i] . ' </a></li>';
	  	}
	  ?>
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


<!-- https://ndb.nal.usda.gov/ndb/foods?format=&count=&max=35&sort=&fgcd=Fruits+and+Fruit+Juices&manu=&lfacet=&qlookup=&offset=NUMBER_35MOD&order=desc -->
<!-- only get raw fruits -->

<div class="col-md-7 col-md-offset-2 main">
  <h3><?php if (strcmp($query_flag, 'true') == 0) {
  				echo 'You searched for: "' . $input_query . '"'; 
  				echo '<div class = "make-one-space"></div>'; 
  				echo '<div class = "small-black-bar info-space"></div>';
			}?>
	</h3>		
	
  <p style="text-align:left">  
  	<span class = "fruit-name"><?php echo $fruit?></span> 
	 	<span style="float:right">
			<!-- Trigger the modal with a button -->
			<?php if ($nutri['Calories'] > 0) { ?>
				<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Nutrition Info</button>
			<?php } ?>
		</span>
	</p>
	
  <div class = "info-space"></div>
  <div class = "black-bar info-space"></div>

	<?php	
		for ($i = 1; $i < count($description); ++$i) {
			if ($i % 3 == 1) {
				echo '<div class = "make-one-space"></div>';
				echo '<span class = "big-text">' . $description[$i] . '</span>';
			}
			else {
				echo '<p class = "descript-font">' . $description[$i] . '</p>';
			}
		}
	?>

  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>

<div class="col-md-3 col-md-offset-9 right-sidebar-image">
  <?php 
  for ($i = 0; $i < $num_images; ++$i) {?>
  <img src = "<?php echo $links_and_images[$i + 4]?>" width="80%" alt = "ERROR" class = "img-rounded img-responsive center-me push-right">
  <div class = "image-space"></div>
  <?php } ?>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
    	<div class = "modal-header">
        <button type="button" class="close btn-lg" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">
        	<!-- nutrition info -->        
					<div class = "center-me">
						<button class="btn btn-success btn-lg disabled" id = "small-btn">Less Info</button>
						<button class="btn btn-success btn-lg active" id = "big-btn">More Info</button>
					</div>
        </h3>
      </div>
      
      <div class="modal-body">

<!--  nutrition chart  -->
<div class = "visible" id = "small-nutri">
<div class="panel panel-color">
  <div class="panel-heading">
    <!-- can also do it by NLEA serving -->
    <div class = "nutrition-title make-white">Nutrition Data per 100 Grams</div>
  </div>
  <div class="panel-body">
    <!-- internet hackz -->
    <div class = "nutrition-font">
      <p style="text-align:left">
        <b>Calories</b>: <?php echo $nutri['Calories'] ?>
        <span style="float:right">Calories from Fat: <?php echo round($nutri['Fat'] * 9.0, 2, PHP_ROUND_HALF_UP) ?></span>
      </p>
    </div>
    <div class = "make-one-space"></div>
    <table class="table">
    
    <thead>
      <tr>
       <p align = "right">% Daily Value</p>
      </tr>
    </thead>
    
    <tbody align = "right">
    <tr>
      <td width = "36%" align = "left"><b>Total Fat</b></td>
      <td width = "32%"><?php if($nutri['Fat'] != NULL) echo $nutri['Fat'] . ' g' ?></td>
      <td width = "32%"><?php if($nutri['Fat'] != NULL) echo round($nutri['Fat'] / 65.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Sat Fat</div></td>
      <td><?php if($nutri['Saturated fat'] != NULL) echo $nutri['Saturated fat'] . ' g' ?></td>
      <td><?php if($nutri['Saturated fat'] != NULL) echo round($nutri['Saturated fat'] * 5.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><b>Cholesterol</b></td>
      <td><?php if($nutri['Cholesterol'] != NULL) echo $nutri['Cholesterol'] . ' mg' ?></td>
      <td><?php if($nutri['Cholesterol'] != NULL) echo round($nutri['Cholesterol'] / 3.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><b>Sodium</b></td>
      <td><?php if($nutri['Sodium'] != NULL) echo $nutri['Sodium'] . ' mg' ?></td>
      <td><?php if($nutri['Sodium'] != NULL) echo round($nutri['Sodium'] / 24.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><b>Total Carbs</b></td>
      <td><?php if($nutri['Carbohydrates'] != NULL) echo $nutri['Carbohydrates'] . ' g' ?></td>
      <td><?php if($nutri['Carbohydrates'] != NULL) echo round($nutri['Carbohydrates'] / 3.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Dietary Fiber</div></td>
      <td><?php if($nutri['Fiber'] != NULL) echo $nutri['Fiber'] . ' g' ?></td>
      <td><?php if($nutri['Fiber'] != NULL) echo round($nutri['Fiber'] / 38.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Sugars</div></td>
      <td><?php if($nutri['Sugars'] != NULL) echo $nutri['Sugars'] . ' g' ?></td>
      <td></td>
    </tr>
    <tr>
      <td align = "left"><b>Protein</b></td>
      <td><?php if($nutri['Protein'] != NULL) echo $nutri['Protein'] . ' g' ?></td>
      <td><?php if($nutri['Protein'] != NULL) echo round($nutri['Protein'] * 2.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
  	</tbody>
  	
	  </table>
  	<div class = "green-bar"></div>
	  <table class = "table">
	  
    <tbody align = "right">
    <tr>
      <td width = "36%" align = "left">Vitamin A</td>
      <td width = "32%"><?php if($nutri['Vitamin A'] != NULL) echo $nutri['Vitamin A'] . ' IU' ?></td>
      <td width = "32%"><?php if($nutri['Vitamin A'] != NULL) echo round($nutri['Vitamin A'] / 50.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin B-6</td>
      <td><?php if($nutri['Vitamin B-6'] != NULL) echo $nutri['Vitamin B-6'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin B-6'] != NULL) echo round($nutri['Vitamin B-6'] / 2.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin B-12</td>
      <td><?php if($nutri['Vitamin B-12'] != NULL) echo $nutri['Vitamin B-12'] . ' µg' ?></td>
      <td><?php if($nutri['Vitamin B-12'] != NULL) echo round($nutri['Vitamin B-12'] / 6.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin C</td>
      <td><?php if($nutri['Vitamin C'] != NULL) echo $nutri['Vitamin C'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin C'] != NULL) echo round($nutri['Vitamin C'] / 6.0 * 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin D</td>
      <td><?php if($nutri['Vitamin D'] != NULL) echo $nutri['Vitamin D'] . ' IU' ?></td>
      <td><?php if($nutri['Vitamin D'] != NULL) echo round($nutri['Vitamin D'] * 4.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin E</td>
      <td><?php if($nutri['Vitamin E'] != NULL) echo $nutri['Vitamin E'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin E'] != NULL) echo round($nutri['Vitamin E'] / 15.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin K</td>
      <td><?php if($nutri['Vitamin K'] != NULL) echo $nutri['Vitamin K'] . ' µg' ?></td>
      <td><?php if($nutri['Vitamin K'] != NULL) echo round($nutri['Vitamin K'] / 8.0 * 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Calcium</td>
      <td><?php if($nutri['Calcium'] != NULL) echo $nutri['Calcium'] . ' mg' ?></td>
      <td><?php if($nutri['Calcium'] != NULL) echo round($nutri['Calcium'] / 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Potassium</td>
      <td><?php if($nutri['Potassium'] != NULL) echo $nutri['Potassium'] . ' mg' ?></td>
      <td><?php if($nutri['Potassium'] != NULL) echo round($nutri['Potassium'] / 35.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Iron</td>
      <td><?php if($nutri['Iron'] != NULL) echo $nutri['Iron'] . ' mg' ?></td>
      <td><?php if($nutri['Iron'] != NULL) echo round($nutri['Iron'] / 18.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Magnesium</td>
      <td><?php if($nutri['Magnesium'] != NULL) echo $nutri['Magnesium'] . ' mg' ?></td>
      <td><?php if($nutri['Magnesium'] != NULL) echo round($nutri['Magnesium'] / 4.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
  	</tbody>
  	
    </table>
  </div>
</div>
</div>

<div class = "hidden" id = "big-nutri">
<div class="panel panel-color">
  <div class="panel-heading">
    <div class = "nutrition-title make-white">Nutrition Data per 100 Grams</div>
  </div>
  <div class="panel-body">
    <div class = "nutrition-font">
      <p style="text-align:left">
        <b>Calories</b>: <?php echo $nutri['Calories'] ?>
        <span style="float:right">Calories from Fat: <?php echo round($nutri['Fat'] * 9.0, 2, PHP_ROUND_HALF_UP) ?></span>
      </p>
    </div>
    <div class = "make-one-space"></div>
    <table class="table">
    
    <thead>
      <tr>
     	 <p align = "right">% Daily Value</p>
      </tr>
    </thead>
    
    <tbody align = "right">
    <tr>
      <td width = "36%" align = "left"><b>Total Fat</b></td>
      <td width = "32%"><?php if($nutri['Fat'] != NULL) echo $nutri['Fat'] . ' g' ?></td>
      <td width = "32%"><?php if($nutri['Fat'] != NULL) echo round($nutri['Fat'] / 65.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Sat Fat</div></td>
      <td><?php if($nutri['Saturated fat'] != NULL) echo $nutri['Saturated fat'] . ' g' ?></td>
      <td><?php if($nutri['Saturated fat'] != NULL) echo round($nutri['Saturated fat'] * 5.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Monounsat Fat</div></td>
      <td><?php if($nutri['Monounsaturated fat'] != NULL) echo $nutri['Monounsaturated fat'] . ' g' ?></td>
      <td></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Polyunsat Fat</div></td>
      <td><?php if($nutri['Polyunsaturated fat'] != NULL) echo $nutri['Polyunsaturated fat'] . ' g' ?></td>
      <td></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Trans Fat</div></td>
      <td><?php if($nutri['Trans fat'] != NULL) echo $nutri['Trans fat'] . ' g' ?></td>
      <td></td>
    </tr>
    <tr>
      <td align = "left"><b>Cholesterol</b></td>
      <td><?php if($nutri['Cholesterol'] != NULL) echo $nutri['Cholesterol'] . ' mg' ?></td>
      <td><?php if($nutri['Cholesterol'] != NULL) echo round($nutri['Cholesterol'] / 3.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><b>Sodium</b></td>
      <td><?php if($nutri['Sodium'] != NULL) echo $nutri['Sodium'] . ' mg' ?></td>
      <td><?php if($nutri['Sodium'] != NULL) echo round($nutri['Sodium'] / 24.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><b>Total Carbs</b></td>
      <td><?php if($nutri['Carbohydrates'] != NULL) echo $nutri['Carbohydrates'] . ' g' ?></td>
      <td><?php if($nutri['Carbohydrates'] != NULL) echo round($nutri['Carbohydrates'] / 3.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Dietary Fiber</div></td>
      <td><?php if($nutri['Fiber'] != NULL) echo $nutri['Fiber'] . ' g' ?></td>
      <td><?php if($nutri['Fiber'] != NULL) echo round($nutri['Fiber'] / 38.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left"><div class = "grey tab">Sugars</div></td>
      <td><?php if($nutri['Sugars'] != NULL) echo $nutri['Sugars'] . ' g' ?></td>
      <td></td>
    </tr>
    <tr>
      <td align = "left"><b>Protein</b></td>
      <td><?php if($nutri['Protein'] != NULL) echo $nutri['Protein'] . ' g' ?></td>
      <td><?php if($nutri['Protein'] != NULL) echo round($nutri['Protein'] * 2.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
  	</tbody>
  	
  	</table>
	  <div class = "green-bar"></div>
	  <table class = "table">
	  
    <tbody align = "right">
    <tr>
      <td width = "36%" align = "left">Vitamin A</td>
      <td width = "32%"><?php if($nutri['Vitamin A'] != NULL) echo $nutri['Vitamin A'] . ' IU' ?></td>
      <td width = "32%"><?php if($nutri['Vitamin A'] != NULL) echo round($nutri['Vitamin A'] / 50.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin B-6</td>
      <td><?php if($nutri['Vitamin B-6'] != NULL) echo $nutri['Vitamin B-6'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin B-6'] != NULL) echo round($nutri['Vitamin B-6'] / 2.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin B-12</td>
      <td><?php if($nutri['Vitamin B-12'] != NULL) echo $nutri['Vitamin B-12'] . ' µg' ?></td>
      <td><?php if($nutri['Vitamin B-12'] != NULL) echo round($nutri['Vitamin B-12'] / 6.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin C</td>
      <td><?php if($nutri['Vitamin C'] != NULL) echo $nutri['Vitamin C'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin C'] != NULL) echo round($nutri['Vitamin C'] / 6.0 * 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin D</td>
      <td><?php if($nutri['Vitamin D'] != NULL) echo $nutri['Vitamin D'] . ' IU' ?></td>
      <td><?php if($nutri['Vitamin D'] != NULL) echo round($nutri['Vitamin D'] * 4.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin E</td>
      <td><?php if($nutri['Vitamin E'] != NULL) echo $nutri['Vitamin E'] . ' mg' ?></td>
      <td><?php if($nutri['Vitamin E'] != NULL) echo round($nutri['Vitamin E'] / 15.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Vitamin K</td>
      <td><?php if($nutri['Vitamin K'] != NULL) echo $nutri['Vitamin K'] . ' µg' ?></td>
      <td><?php if($nutri['Vitamin K'] != NULL) echo round($nutri['Vitamin K'] / 8.0 * 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Calcium</td>
      <td><?php if($nutri['Calcium'] != NULL) echo $nutri['Calcium'] . ' mg' ?></td>
      <td><?php if($nutri['Calcium'] != NULL) echo round($nutri['Calcium'] / 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Potassium</td>
      <td><?php if($nutri['Potassium'] != NULL) echo $nutri['Potassium'] . ' mg' ?></td>
      <td><?php if($nutri['Potassium'] != NULL) echo round($nutri['Potassium'] / 35.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Iron</td>
      <td><?php if($nutri['Iron'] != NULL) echo $nutri['Iron'] . ' mg' ?></td>
      <td><?php if($nutri['Iron'] != NULL) echo round($nutri['Iron'] / 18.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Magnesium</td>
      <td><?php if($nutri['Magnesium'] != NULL) echo $nutri['Magnesium'] . ' mg' ?></td>
      <td><?php if($nutri['Magnesium'] != NULL) echo round($nutri['Magnesium'] / 4.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Phosphorus</td>
      <td><?php if($nutri['Phosphorus'] != NULL) echo $nutri['Phosphorus'] . ' mg' ?></td>
      <td><?php if($nutri['Phosphorus'] != NULL) echo round($nutri['Phosphorus'] / 10.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Zinc</td>
      <td><?php if($nutri['Zinc'] != NULL) echo $nutri['Zinc'] . ' mg' ?></td>
      <td><?php if($nutri['Zinc'] != NULL) echo round($nutri['Zinc'] / 15.0 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Thiamin</td>
      <td><?php if($nutri['Thiamin'] != NULL) echo $nutri['Thiamin'] . ' mg' ?></td>
      <td><?php if($nutri['Thiamin'] != NULL) echo round($nutri['Thiamin'] / 1.5 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Riboflavin</td>
      <td><?php if($nutri['Riboflavin'] != NULL) echo $nutri['Riboflavin'] . ' mg' ?></td>
      <td><?php if($nutri['Riboflavin'] != NULL) echo round($nutri['Riboflavin'] / 1.7 * 100.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Niacin</td>
      <td><?php if($nutri['Niacin'] != NULL) echo $nutri['Niacin'] . ' mg' ?></td>
      <td><?php if($nutri['Niacin'] != NULL) echo round($nutri['Niacin'] * 5.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    <tr>
      <td align = "left">Folate</td>
      <td><?php if($nutri['Folate'] != NULL) echo $nutri['Folate'] . ' µg' ?></td>
      <td><?php if($nutri['Folate'] != NULL) echo round($nutri['Folate'] / 4.0, 2, PHP_ROUND_HALF_UP) . '%' ?></td>
    </tr>
    </tbody>
    
	  </table>
  </div>
</div>
</div>         

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-lg" data-dismiss="modal">Close</button>
        </div>
      </div>     
    </div>
  </div> 
</div>
	<!--  end modal  -->

<!-- got online -->
<script type = "text/javascript">
	var smallDiv = document.getElementById("small-nutri");
	var bigDiv = document.getElementById("big-nutri");
	
	var smallBtn = document.getElementById("small-btn");
	var bigBtn = document.getElementById("big-btn");
	
	smallBtn.onclick = function() {
		smallDiv.setAttribute("class", "visible");
		bigDiv.setAttribute("class", "hidden");
		smallBtn.setAttribute("class", "btn btn-success btn-lg disabled");
		bigBtn.setAttribute("class", "btn btn-success btn-lg active");
	};
	
	bigBtn.onclick = function() {
		smallDiv.setAttribute("class", "hidden");
		bigDiv.setAttribute("class", "visible");
		smallBtn.setAttribute("class", "btn btn-success btn-lg active");
		bigBtn.setAttribute("class", "btn btn-success btn-lg disabled");
	};
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
