<?session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Edit Co Templates</title>
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
<h1>Edit ompany Templates</h1>
<?php
if($_SESSION['count'] != 0){
	$dbh = pg_connect(/*DB info*/);
	$sql = "SELECT max(file_sec_set_id) FROM file_sec_set";
	$miselc = pg_query($dbh,$sql);
	$maxindex = pg_fetch_row($miselc);
	$fssid = array();
	$array = array();
	$order = array();
	$tempfssid = array();
	$sql = 'SELECT company FROM company ORDER BY company';
	$list = pg_query($dbh, $sql);	
	if(isset($_POST['company'])){
		$comp = $_POST['company'];
		$sql = "SELECT group_id, name FROM groups WHERE company_id = '$comp' ORDER BY group_id";
		$files = pg_query($dbh, $sql);
		if(isset($_POST['Template_List'])){
			$tempnum = $_POST['Template_List'];
			$sql = "SELECT file_sec_set_id, sec_name FROM file_sec_set WHERE group_id = '$tempnum' ORDER BY file_sec_set_id";
			$numselc = pg_query($dbh,$sql);
			$numrow = pg_num_rows($numselc);
			$counter = $numrow;
			if(isset($_POST['submit'])){
				echo("Change Executed - Reload Page");
			}
		}
	}

}?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><?php foreach ($_POST as $key => $value) {
	//echo $key."->".$value.'<br/>';
	if(isset($_POST['Template_List'])){
		if($value != 'Continue'){
			array_push($array, $value);
		}
	}
}?></p>
Company: <select id="company" name="company">
	<?php while($row = pg_fetch_row($list)): ?>
		<?php if($_POST['company'] == $row[0]): ?>
			<option value="<?php echo $row[0]; ?>" selected = 'selected'><?php echo $row[0]?></option>
		<?php else: ?>
			<option value="<?php echo $row[0]; ?>"><?php echo $row[0]?></option>
		<?php endif;?>
	<?php endwhile;?>
</select>

<?php if(isset($_POST['company'])):?>
	<br/>Templates:<select name="Template_List">
		<?php while($row = pg_fetch_row($files)):?>
			<?php if($_POST['company'] == $row[0]):?>
				<option value="<?php echo $row[0]; ?>" selected = 'selected'><?php echo $row[0]."-".$row[1];?></option>
			<?php else: ?>
				<option value="<?php echo $row[0]; ?>"><?php echo $row[0]."-".$row[1];?></option>
			<?php endif;?>
		<?php endwhile;?>
	</select>
<?php endif;?>

<?php if(isset($_POST['Template_List'])):?>
	<?php $c = 1;?>
	<table style="border:solid;">
		<thead>
			<th>id</th>
			<th>name</th>
			<th>prev order</th>
			<th>new order</th>
		</thead>
		<tbody>
			<?php while($row = pg_fetch_row($numselc)): ?>
					<tr>
						<td style="border:1px solid"><?php echo $row[0]; ?></td>
						<td style="border:1px solid"><?php echo $row[1]; ?></td>
						<td style="border:1px solid"><?php echo $c; ?></td>
						<td style="border:1px solid"><input type=text name="placeholder_<?php echo $c; ?>" value='<?php echo $c; ?>' size ='1'></td>
					</tr>
					<?php $fssid[$c] = $row[0]; $tempfssid[$c] = $row[0]; ?>
					<?php $c++; $counter++; ?>
			<?php endwhile;?>
		</tbody>
	</table>
	
	<?php foreach ($array as $key => $c) {
			if($key == 1 || $key == 0){
				$array[$key] = NULL;}
			if($array[$key] != NULL){
				$order[$key-1] = $array[$key];}
	}?>
<?php endif;?>

<?php if(isset($_POST['submit'])):?>
	<?php $i=1; $maxi = $maxindex[0];
	foreach ($order as $key => $counter){
		
		$changeto = $tempfssid[$order[$key]];
		$settomax = $fssid[$order[$key]];
		$update = $fssid[$key];

		if($order[$key] > $key){

			$maxi = $maxindex[0]+$changeto;
			$sql = "UPDATE file_sec_set SET file_sec_set_id = '$maxi' WHERE file_sec_set_id = '$settomax'";
			$change1 = pg_query($dbh,$sql);

			$sql = "UPDATE file_sec_set SET file_sec_set_id = '$changeto' WHERE file_sec_set_id = '$update'";
			$change2 = pg_query($dbh,$sql);

		}

		if($order[$key] < $key){

			$newsec = ($maxindex[0]+$tempfssid[$key]);
			$sql = "UPDATE file_sec_set SET file_sec_set_id = '$changeto' WHERE file_sec_set_id = '$newsec'";
			$change = pg_query($dbh,$sql);

		}

	}
?>
<?php endif;?>

<?php if(isset($_POST['Template_List'])):?>
	<br /><input type="submit" name="submit" value="Submit">
<?php else:?>
	<br /><input type="submit" name="continue" value="Continue">
<?php endif;?>

</form>

</div>
</body>
</html>