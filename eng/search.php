<!DOCTYPE html>
<html lang="en-us">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Welcome to nova!</title>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<?php
require_once('test.php');
?>

<body>
<div class="container" id = 'main'>
	<div class="search">
		<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
		<form  role="form" name="form" action="search.handler.php" method="post">
			<input type="text" class="form-control" name="search" id="search" required autofocus />
			<button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
		</form>
	</div>

	<div class="well well-lg"  id = 'Showcases'>
    <div class="page-header" id = 'TrendingBooksTitle'>
    	<h2> Trending:</h2>
    </div>

    <div class="row"  id = 'trendingTables'>
      <div class="col-sm-8"  id = 'TrendingBooksDiv'>
        <h3>Books:</h3>
        <table class ="table table-striped" id="TrendingBooksTable">
          <!-- <cpation> Your favorate books:</cpation> -->
          <thead>
            <tr>
			    <th>Book Title</th>
			    <th>Author</th>
			    <th>Genre</th>
			    <th>Release</th>
			    <th>Update</th>
			    <th>Views</th>
			    <th>Fans</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
				<?php
				  require_once('../headfiles/backend_classes_h.php');
				  $q = new Query;
				  $results = $q->getBookShowcase($_COOKIE['lang']);
				  $i = 0;
				  foreach ($results as $r) {
				    if ($i > 9) break;
				    echo $r->toHTMLTableRow();
				    $i++;
				  }
				?>
          </tbody>
        </table>
      </div>

      <div class="col-sm-4"  id = 'TrendingAuthorsDiv'>
        <h3>Authors:</h3>
        <table class ="table table-striped" id="TrendingAuthorsTable">
          <!-- <cpation> Your favorate Authors:</cpation> -->
          <thead>
            <tr>
              <th>Author</th>
              <th>Fans</th>
            </tr>
          </thead>
          <tbody>
            <!-- Generate table data here -->
			<?php
			  require_once('../headfiles/backend_classes_h.php');
			  $q = new Query;
			  $results = $q->getAuthorShowcase($_COOKIE['lang']);
			  $i = 0;
			  foreach ($results as $r) {
			    if ($i > 9) break;
			    echo $r->toHTMLTableRow();
			    $i++;
			  }
			?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>
