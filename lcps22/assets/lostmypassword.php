<?php
ob_start();
session_start();
include("db_config.php");
ini_set('display_errors', 1);
?>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Aceme Corp Login</title>

    <link href="css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Aceme Corp Login
			</p>
        </div>
		
		<div class="response">
		<form method="POST" autocomplete="off">
			<p style="color:white">
				Username:  <input type="text" id="uid" name="uid"><br /></br />
				Password: <input type="password" id="password" name="password">
			</p>
			<br />
			<p>
			<input type="submit" value="Submit"/> 
			<input type="reset" value="Reset"/>
			</p>
		</form>
        </div>
    
        
		<br />
		
      <div class="row marketing">
        <div class="col-lg-6">

<?php

if (!empty($_GET['msg'])) {
 
}


if (!empty($_REQUEST['uid'])) {
$username = ($_REQUEST['uid']);
$pass = md5($_REQUEST['password']);


$stmt = $mysqli->prepare("SELECT id, fname,description,username FROM users WHERE username = ? AND password = ?");
$stmt->bind_param('ss',$username,$pass);
    $stmt->execute();
    $stmt->bind_result($id,$fname,$description,$username);
    $rs= $stmt->fetch ();
    $stmt->close();
    if ($rs) {
 
            
	

	$_SESSION["username"] =$username;
	$_SESSION["name"] = $fname;
	$_SESSION["desc"] = $description;

	
	
	

	
	header('Location:home.php');
	
}
	else{
		
		echo "<font style=\"color:#FF0000\"><br \>Invalid password!</font\>";
		

	}


}
?>

	</div>
	</div>
	  
	  
	  <div class="footer">
		<p>Can you Login? |  SQL Injection won't Work, but feel free to give it a try.</p>
      </div>
	</div> <!-- /container -->
  
</body>
</html>