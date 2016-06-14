<?php
  // require_once "../headfiles/connect.php";

  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashpw=sha1($password);

  require_once('../headfiles/pdo_h.php');
  try{$dbh = _db_connect();
  $stmt = $dbh->prepare("SELECT * FROM Members WHERE username=:uid AND userpass=:hashpw");
  $stmt->bindParam(':uid', $username);
  $stmt->bindParam(':hashpw', $hashpw);
  $stmt->execute();
  _db_commit($dbh);} catch(Exception $e) {_db_error($dbh,$e);}

  if($stmt->fetch()){
    SetCookie("user", "$username", time()+3600);
    header("location:search.php");
    exit;
  } else {
    echo "Login fail, please try again.";
  }
?>
