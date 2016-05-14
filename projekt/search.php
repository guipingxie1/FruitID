<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Search Bar Test</title>

<link rel="stylesheet"
href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="css/test.css" rel="stylesheet">

</head>

<body>

<nav class="navbar make-green navbar-fixed-top header">
  <div class="navbar-header">
    <a class="navbar-brand big-text make-white" href="search.php"><span
        class="glyphicon glyphicon-home make-white"></span> FruitID</a>
  </div>
</nav>

<div class = "big-search">
  <h2> Welcome to FruitID. Type your query below </h2>
  <div class = "make-space"></div>
  <!-- role = search -->
  <form class="form-horizontal" method="get" action="results.php"> 
    <div class="form-group">
      <input type="text" class="main-search form-control" name="search" placeholder="Your description here (ie shape, color, size, taste, location)">
    </div> 
      <!-- <i class = "glyphicon glyphicon-search form-control-feedback light-grey"></i> -->
    <div class = "make-more-space"></div>
    <button type="submit" value="submit" class="btn make-green big-button">
      <span class="glyphicon glyphicon-search"></span> Search
    </button>
  </form>
</div>

<div class = "container">
  <footer class="footer">
    <p>&copy; 2016 FruitID</p>
  </footer>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
