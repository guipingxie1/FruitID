<?php
require_once('php/query.php');

$query = new Query();

if ( isset($_GET['search']) ) {
	$input_query = htmlspecialchars($_GET['search']);
	$original_query = $input_query;
	$input_query = trim($input_query);
	$input_query = strtolower($input_query);
	$input_query = preg_replace("/[^a-z]+/", " ", $input_query);	
	
	$result_query = $query -> getResult($input_query);	
	
	if ( count($result_query) <= 2 ) {
		$edit_query = $query -> editDistance($input_query);
		$after_edit_query = array();
		$poison = "123--";
		$bad_poison = "321--";
		$direct_hits = 0;			// used to check if the query is correct but less than 2 results
		$bad_hits = 0;
		
		for ( $i = 0; $i < count($edit_query); ++$i ) {
			if ( strcmp($edit_query[$i][0], $poison) == 0 ) {
				array_push($after_edit_query, $edit_query[$i][1]);
				array_push($after_edit_query, $poison);
				++$direct_hits;
			}
			else if (strcmp($edit_query[$i][0], $bad_poison) != 0) {
				foreach ( $edit_query[$i] as $key => $value ) {
					for ( $j = 0; $j < count($value); ++$j )
						array_push($after_edit_query, $value[$j]);
				}
				
				array_push($after_edit_query, $poison);
			}
			else {
				array_push($after_edit_query, $edit_query[$i][1]);
				array_push($after_edit_query, $poison);
				++$bad_hits;
			}
		}

		$error_query = array();
		$all_result_query = array();

		if ( ($direct_hits != count($edit_query) && $bad_hits != count($edit_query)) || ($direct_hits == count($edit_query) && count($result_query) == 0) ) {
			$i = 0;
			while ( $i < count($after_edit_query) ) {
				$mini_result = array();
				
				while ( $i < count($after_edit_query) && strcmp($after_edit_query[$i], $poison) != 0 ) {
					array_push($mini_result, $after_edit_query[$i]);
					++$i;	
				}
				
				array_push($all_result_query, $mini_result);
				++$i;
			}		
					
			$len = count($all_result_query);
			
			if ( $len > 0 ) {	
				$idx_arr = array_fill( 0, $len, 0 );
				$dest_arr = array_fill( 0, $len, 0 );
				$max_idx = 1;				
				
				for ( $i = 0; $i < $len; ++$i ) {
					$dest_arr[$i] = count($all_result_query[$i]);
					$max_idx *= $dest_arr[$i];
				}
				
				$idx = 0;
				while ( $idx < $max_idx ) {
					$new_query = "";
					
					for ( $i = 0; $i < $len; ++$i ) {
						$new_query = $new_query . $all_result_query[$i][$idx_arr[$i]] . " ";
		
						if ( $i == $len - 1 ) {
							$idx_arr[$i]++;
							$j = $i;
							
							while ( $j > 0 && $idx_arr[$j] == $dest_arr[$j] ) {
								$idx_arr[$j] = 0;
								--$j;
								$idx_arr[$j]++;
							}
						}
					}
					
					array_push($error_query, $new_query);
					++$idx;
				}
			}
		}
	}
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
<div class="col-sm-3 col-md-2 sidebar">
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

<div class="col-md-9 col-md-offset-2 main">
  <h3><?php 
  				echo 'You searched for: "' . $original_query . '"'; 
  				echo '<div class = "make-one-space"></div>'; 
  				echo '<div class = "small-black-bar info-space"></div>';
			?>
	</h3>
	
  <?php  	 	
    	if ( count($result_query) == 0 ) 
    		echo '<h2>No results for "' . $original_query . '"</h2>';
    	else echo '<h2> Your Results </h2>'
  ?>  	
  <div class = "black-bar"></div>
  
  <?php
  if ( count($result_query) > 0 ) { 
  	echo '<div class = "make-space"></div>';
  ?>
  <ul style = "list-style-type:none">
  <?php  	
    	for ($i = 0; $i < count($result_query); ++$i) {
    		$main_info = $query -> getMainInfo($result_query[$i]);
    		$links_and_images = $main_info[0];
    		echo '<li class = "inline-me"><div class="col-md-3 col-md-offset-0"><a href = "info.php?fruit=' . $result_query[$i] . '&query=true&search=' . $input_query . '"><img src = "' . $links_and_images[4] . '" alt = "ERROR" width="80%" class = "img-rounded img-responsive center-me"></div></a>';
    		echo '<div class = "make-one-space results-font col-md-offset-3"><a href = "info.php?fruit=' . $result_query[$i] . '&query=true&search=' . $input_query . '"> ' . $result_query[$i] . ' </a></div>';
    		
    		$description = $query -> getDes($result_query[$i]);
    		echo '<div class = "small-tab make-one-space col-md-offset-3"> ' . $description[2] . ' </div></li>';
    		echo '<div class = "make-space"></div>';
    	}    
    }
   ?>
  </ul>		
  <?php  	 	
    	if ( count($error_query) > 0 ) {
    		echo '<div class = "make-one-space"></div>'; 
    		echo '<div class = "make-one-space"></div>'; 
		echo '<h2>Do you mean: </h2>';
		
	    	for ($i = 0; $i < count($error_query); ++$i) 
	    		echo '<div class = "tab"><h3><a href = "results.php?search=' . $error_query[$i] . '">' . $error_query[$i] . '</a></h3></div>';
    	}
  ?>

  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
