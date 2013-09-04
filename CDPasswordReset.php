<?session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Access Device Password Reset</title>
<style type="text/css">
	
		#wrapper {
			max-width: 600px;
		}

	</style>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<meta name="apple-mobile-web-app-capable" content="yes" />
</head>
<body>
<div id="wrapper">
<?php
if($_SESSION['count'] != 0){
	$dbh = pg_connect(/*Insert data base information*/);
	if(isset($_POST['accessdevice_selc'])){
		$cdinfo = $_POST['cdselc'];
		$sql = "SELECT hc FROM a_ds WHERE a_key = '$acdinfo' ORDER BY a_d_id";
		$cds = pg_query($dbh, $sql);
		$cdid = pg_fetch_row($cds);
		$sql = "SELECT password FROM a_des WHERE a_key = '$acdinfo' ORDER BY a_d_id";
		$cdpwd = pg_query($dbh,$sql);
		$cdpw = pg_fetch_row($cdpwd);
	}

}?>


<h1>AD Password Reset</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
CD Number: <input type=text name="cdselc" value="<?php echo $cdinfo; ?>">
</input>

<?php if(isset($_POST['count'])):?>
	<br/><input type="submit" name="submit" value="Submit">
<?php else:?>
	<br/><input type="submit" name="continue" value="Continue">
<?php endif;?>

<?php if(isset($_POST['continue'])):?>
	<br/>
	<br/><?php if($cdinfo == '') {echo ("No CD Number Entered"); die();}?>
	<br/><?php echo ("hc = $cdid[0]");?>
	<br/><?php if($cdpw[0] == NULL){ echo ("current password = NULL");}
	else{echo ("current password = $cdpw[0]");}?>

	<?php
		$sql = "UPDATE a_d SET hc = '0' WHERE a_key = '$cdinfo'";
		$reset = pg_query($dbh,$sql);
	?>

	<br/><?php echo ("hc now set to 0");?>
	<br/>
	<br/>
	Undo: <input type=text name="error" value="<?php echo $acdinfo; ?>"></input>
	<br/><input type="submit" name="undo" value="Undo">	

<?php endif;?>

<?php if(isset($_POST['undo'])):?>
	<?php 
		$sql = "UPDATE a_d SET hc = '1' WHERE a_key = '$acdinfo'";
		$undoreset = pg_query($dbh,$sql);
	?>
	<br/>
	<br/><?php echo("hc now set to 1");?>

<?php endif;?>

</form>

</div>
</body>
</html>