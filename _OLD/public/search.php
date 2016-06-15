<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
#TB{
    width:65%;
    height:100px;
    float:left;
    margin: 0 auto;
}
#TA{
    width:30%;
    height:100px;
    float:left;
    margin: 0 auto;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
    margin: 0 auto;
}
th, td {
    padding: 5px;
}
</style>
<title>Welcome to nova!</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">

</head>

<?php
require_once('test.php');
?>

<body>

<div class="search">
	<div class="signin-head"><img src="images/test/touxiang.jpeg" alt="" class="img-circle"></div>
	<form  role="form" name="form" action="search.handler.php" method="post">
		<input type="text" class="form-control" name="search" id="search" required autofocus />

    Preferred language:
                  <select name="lcode">
                    <?php
                      require_once('../headfiles/pdo_h.php');
                      try{$dbh = _db_connect();
                      $stmt = $dbh->prepare("SELECT DISTINCT * from Languages");
                      $stmt->execute();
                      _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

                      $result = $stmt->fetchAll();
                      var_dump($result);
                      foreach ($result as $v) {
                        echo '<option value="'.$v['LCode'].'">'.$v["LName"].'</option>';
                      }
                    ?>
                  </select><br/>
		<button class="btn btn-lg btn-warning btn-block" type="submit">Search</button>
	</form>
</div>

<!-- Show Case Here -->

<div id='TB'>
<div id="SearchResult">
<h3> Trending Books:</h3>
<table id="TrendingBooks">
  <tr>
    <th>Book Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Release</th>
    <th>Update</th>
    <th>Views</th>
    <th>Fans</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getBookShowcase('eng');
  $i = 0;
  foreach ($results as $r) {
    if ($i > 9) break;
    echo $r->toHTMLTableRow();
    $i++;
  }
?>
 </table>
</div>
</div>

<div id='TA'>
<div id="AuthorShowcase">
<h3> Trending Authors:</h3>
<table id="TrendingAuthors">
  <tr>
    <th>Author</th>
    <th>Fans</th>
  </tr>

<?php
  require_once('../headfiles/backend_classes_h.php');
  $q = new Query;
  $results = $q->getAuthorShowcase('eng');
  $i = 0;
  foreach ($results as $r) {
    if ($i > 9) break;
    echo $r->toHTMLTableRow();
    $i++;
  }
?>

  </table>
  </div>
</div>

</body>
</html>