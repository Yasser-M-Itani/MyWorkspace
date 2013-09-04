<?session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>File Search</title>
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

<h1>File Based Search</h1>
<?php

if($_SESSION['count'] != 0){
	$dbh = pg_connect(/*DB info*/);
	if(isset($_POST['file'])){
		$compfilenum = $_POST['file'];
		if($compfilenum == ''){ echo ("No File Number Entered"); die();}
		
		$sql = "SELECT subjectstreet FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo1 = pg_query($dbh,$sql);
		$filestreet = pg_fetch_row($fileinfo1);
		$sql = "SELECT subjectcity FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo2 = pg_query($dbh,$sql);
		$filecity = pg_fetch_row($fileinfo2);
		$sql = "SELECT subjectzip FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo3 = pg_query($dbh,$sql);
		$filezip = pg_fetch_row($fileinfo3);
		$sql = "SELECT subjectstate FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo4 = pg_query($dbh,$sql);
		$filestate = pg_fetch_row($fileinfo4);
		$sql = "SELECT company FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo5 = pg_query($dbh,$sql);
		$filecompany = pg_fetch_row($fileinfo5);
		$sql = "SELECT loanofficer FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo6 = pg_query($dbh,$sql);
		$fileloanofficer = pg_fetch_row($fileinfo6);
		$sql = "SELECT loanappid FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo7 = pg_query($dbh,$sql);
		$fileloanappid = pg_fetch_row($fileinfo7);
		$sql = "SELECT titleunderwriter FROM loanapp WHERE co_filenum = '$compfilenum'";
		$fileinfo8 = pg_query($dbh,$sql);
		$filetitleco = pg_fetch_row($fileinfo8);

		$sql = "SELECT firstname, lastname, email FROM wuser WHERE homestreet = '$filestreet[0]' AND homezip = '$filezip[0]'";
		$wuserinfo = pg_query($dbh,$sql);
		$sql = "SELECT super FROM wuser WHERE homestreet = '$filestreet[0]' AND homezip = '$filezip[0]'";
		$wusersuper = pg_query($dbh,$sql);

		if($fileloanappid[0] == NULL){ echo ("No File Found"); die();}
		$sql = "SELECT access_key FROM access_devices WHERE loanappid = '$fileloanappid[0]' AND device_type = 1 ORDER BY created";
		$fileCDinfo1 = pg_query($dbh,$sql);
		$sql = "SELECT received_by FROM access_devices WHERE loanappid = '$fileloanappid[0]' AND device_type = 1 ORDER BY created";
		$filerecived = pg_query($dbh,$sql);
	}
}?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
FileNumber: <input type=text name="file" value="<?php echo $compfilenum; ?>">

<?php if(isset($_POST['count'])):?>
	<br/><input type="submit" name="submit" value="Submit">
<?php else:?>
	<br/><input type="submit" name="continue" value="Continue">
<?php endif;?>

<?php if(isset($_POST['file'])):?>
	<br/>
	<br/><?php if($filestreet[0] == ''){ echo ("No File Street Found");}?>
	<br/><?php echo("Address: $filestreet[0], $filecity[0], $filestate[0] $filezip[0]");?>
	<br/><?php echo("Company: $filecompany[0]");?>
	<br/><?php echo("Title Company: $filetitleco[0]");?>
	<br/><?php echo("Loan Officer: $fileloanofficer[0]");?>
	<br/><?php echo("Loan Application ID: $fileloanappid[0]");?>

	<br/><?php while($propownerinfo = pg_fetch_row($wuserinfo)):?>
		<br/><?php if($propownerinfo[0] == ''){ echo ("No Owner Found"); die();}?>
		<br/> <?php echo("Seller: $propownerinfo[0] $propownerinfo[1]");?>
		<br/> <?php echo("Email: $propownerinfo[2]");?>
	<?php endwhile;?>
	
	<br/> <?php while(($recievedby = pg_fetch_row($filerecived)) && ($fileCDnum = pg_fetch_row($fileCDinfo1))):?>
		<br/><?php if($recievedby[0] == ''){ echo ("No CD Issued"); die();}?>
		<?php
			$sql = "SELECT firstname, lastname FROM wuser WHERE username = '$recievedby[0]'";
			$flinfo = pg_query($dbh,$sql);
			$CDinfo = pg_fetch_row($flinfo);

			$sql = "SELECT email FROM wuser WHERE username = '$recievedby[0]'";
			$filemail = pg_query($dbh,$sql);
			$fileEmail = pg_fetch_row($filemail);

			$sql = "SELECT hc FROM access_devices WHERE access_key = '$fileCDnum[0]'";
			$HC = pg_query($dbh,$sql);
			$HCval = pg_fetch_row($HC);

			$sql = "SELECT password FROM access_devices WHERE access_key = '$fileCDnum[0]'";
			$PW = pg_query($dbh,$sql);
			$Password = pg_fetch_row($PW);
		?>
		<br/><?php echo("Registered to: $CDinfo[0] $CDinfo[1]");?>
		<br/><?php echo("CD: $fileCDnum[0]");?>
		<br/><?php echo("CD Password: $Password[0]");?>

		<?php if($HCval[0] == 0):?>
			<br/><?php echo ("Default Password");?>
		<?php endif;?>
		<?php if($HCval[0] == 1):?>
			<br/><?php echo ("Homeowner Changed Password");?>
		<?php endif;?>
		
		<br/><?php echo("Email: $fileEmail[0]");?>
		<br/>
	<?php endwhile;?>
<?php endif?>

</form>

</div>
</body>
</html>