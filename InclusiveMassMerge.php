<?session_start();?>
<!DOCTYPE html>
<html>

	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>New Mass Merge</title>	
	<style type="text/css">
	
		#wrapper {
			max-width: 600px;
		}

	</style>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	</head>
	<body>
	<div id = "wrapper">
	<h1>Merge</h1>

<div id="results">
<?php
if($_SESSION['count'] != 0){
	$dbh = pg_connect(/*DB info*/);
	if (isset($_POST['email'])){
		$emailselc = $_POST['email'];
		parse_str($emailselc,$name);
		echo("input = $emailselc");
		echo("Firstname = $name[0]");
		echo("Lastname = $name[1]");
		//Switch to look up by firstname and lastname
		$sql = "SELECT f.username, 
						ff.email, 
						ff.photo, 
						ff.dashboardactive,
						ff.organization,
						ff.workphone1,
						ff.homestate,
						ff.role,
						ff.super
						FROM file_users f INNER JOIN wuser ff ON f.username = ff.username WHERE ff.email = '$emailselc'";
		$info = pg_query($dbh,$sql);
		$sql = "SELECT count(*) FROM wuser WHERE email = '$emailselc'";
		$ct = pg_query($dbh,$sql);
		$count = pg_fetch_row($ct);
	}
}?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
Email: <input type=text name="email" value="<?php echo $emailselc ?>">

<?php if(isset($_POST['email'])):?>
	<br/><input type="submit" name="submit" value="Submit">
<?php else:?>
	<br/><input type="submit" name="continue" value="Continue">
<?php endif;?>

<br/>
<br/><?php echo ("Duplicate Users = $count[0]");?>

<?php if(isset($_POST['email'])):?>
	<br/>
	<br/><?php while($allinfo = pg_fetch_row($info)):?>
		<?php
			if($allinfo[3] == 1){echo("Dashboard is 1: $allinfo[0]"); $hasactivedb = $allinfo[0];}
			if($allinfo[2] != NULL){echo("Has a photo: $allinfo[0]"); $hasphoto = $allinfo[0];}
			if($allinfo[2] != NULL && $allinfo[3] == 1){echo("Has a photo and dashboard is 1: $allinfo[0]"); $hasphotoactivedb = $allinfo[0];}
		?>
		<br/><?php echo("Username: $allinfo[0]");?>
		<br/><?php echo("Email: $allinfo[1]");?>
		<br/><?php echo("Photo: $allinfo[2]");?>
		<br/><?php echo ("Dashboardactive = $allinfo[3]");?>
		<br/>
	<?php endwhile;?>
<?php endif;?>

</div>
</body>
</html>