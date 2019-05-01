<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Merriweather">
		<style type="text/css">
			body {
				font-family: Merriweather, serif;
				-webkit-font-smoothing: antialiased;
				font-smoothing: antialiased;
				color: #fff;
				background-color: #333;
				text-align: center;
			}
			#body {
				width: 948px;
				margin: 0 auto;
			}
			.two-col {
				column-count: 2;
				text-align: left;
			}
			input[type=text], input[type=url], input[type=email], input[type=password], input[type=tel] {
				-webkit-appearance: none; 
				-moz-appearance: none;
				diplay: block;
				margin: 10px;
				padding: 5px 10px 5px 10px;
				width: 400px; 
				height: 24px;
				line-height: 24px; 
				font-size: 15px;
				border: 1px solid #bbb;
			}
			input[type=checkbox], input[type=radio] {
				width: 15px; 
				height: 15px;
				-webkit-border-radius: 5px; 
				-moz-border-radius: 5px; 
				border-radius: 5px;
				border: 1px solid #bbb;
				margin: 10px;
			}
			select {
				margin: 10px;
				padding: 5px 10px 5px 10px;
				width: 400px;
				line-height: 24px;
				font-size: 15px;
				border: 1px solid #bbb;
			}
			table {
				width: 90%;
				margin-left: auto;
				margin-right: auto;
			}
			p {
				-webkit-column-break-inside: avoid;
				page-break-inside: avoid;
				break-inside: avoid;
			}

			@media (max-width:946px) {
				#body {
					width: 100%;
					margin: 0;
					padding: 0;
				}
				.two-col {
					column-count: 1;
					text-align: center;
				}
				.form {
					width: 100%;
					margin-left: auto;
					margin-right: auto;
					font-size: 24pt;
				}
				input[type=text], input[type=url], input[type=email], input[type=password], input[type=tel] {
				  margin: 5px auto 5px auto;
				  width: 90%; 
					height: 40px;
					line-height: 40px; 
					font-size: 17px;
				  border: 1px solid #bbb;
				}
				select {
					margin: 5px auto 5px auto;
					width: 90%;
					line-height: 40px;
					font-size: 17px;
					border: 1px solid #bbb;
				}
				input[type=checkbox] {
					width: 44px; 
					height: 44px;
					-webkit-border-radius: 22px; 
					-moz-border-radius: 22px; 
					border-radius: 22px;
				}
				input[type=radio] {
					width: 32px;
					height: 32px;
				}
				input[type=submit] {
					-webkit-appearance: none; 
					-moz-appearance: none;
					display: block;
					margin: 5px auto 5px auto;
					font-size: 24px; 
					line-height: 40px;
					color: #333;
					font-weight: bold;
					height: 80px; 
					width: 90%;
					background: #fdfdfd; 
					background: -moz-linear-gradient(top, #fdfdfd 0%, #bebebe 100%); 
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fdfdfd), color-stop(100%,#bebebe)); 
					background: -webkit-linear-gradient(top, #fdfdfd 0%,#bebebe 100%); 
					background: -o-linear-gradient(top, #fdfdfd 0%,#bebebe 100%); 
					background: -ms-linear-gradient(top, #fdfdfd 0%,#bebebe 100%); 
					background: linear-gradient(to bottom, #fdfdfd 0%,#bebebe 100%);
					border: 1px solid #bbb;
					-webkit-border-radius: 10px; 
					-moz-border-radius: 10px; 
					border-radius: 10px;
				}	
			}
		</style>
		<title>MailGen</title>
	</head>
	<body>
		<div id="body">

<?php
/**
 * Show and Generate Auto Emails
 */
# Preload Stuff
include_once 'config.php';

# Open MySQL Connection
$mysql = new mysqli('localhost', DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
	die("Could not connect: ".mysqli_connect_error());
}

?>

<div class="form">
<form action="index.php" method="post">
	Service<br>
	<input type="text" name="comment"><br>
	Alias<br>
	<input type="text" name="source"><br>
	Domain<br>
	<select name="domain">
		<option value="j3b.in">j3b.in</option>
		<option value="systemanomaly.com">systemanomaly.com</option>
		<option value="cheshil.com">cheshil.com</option>
	</select><br>
	Destination<br>
	<input type="text" name="destination" value="userjack6880@gmail.com"><br>
	Random<br>
	<input type="checkbox" name="generate" value="1"><br>
	<input type="submit" value="Submit">
</form>
</div>

<?php
# Process New Alias

if (isset($_POST['source'])) {
	$source = '';
	if (isset($_POST['generate'])) {
		$source = uniqid().'@'.$_POST['domain'];
	} else {
		$source = $_POST['source'].'@'.$_POST['domain'];
	}

	$source      = $mysql->real_escape_string($source);
	$destination = $mysql->real_escape_string($_POST['destination']);
	$comment     = $mysql->real_escape_string($_POST['comment']);

	$values = "'$source','$destination','$comment'";

	$sql = "INSERT INTO `virtual_aliases` (`source`,`destination`,`comment`) VALUES ($values)";

	$mysql->query($sql);

	echo "<h2>$source added!</h2>\n";
}

# De/Re-activate Alias

# List Active Aliases

function display_alias($result) {
	while($row = $result->fetch_array()) {
	?>
			<p><a href="edit.php?id=<?php echo $row['id']; ?>"><img src="edit.png"></a>
			<a href="delete.php?id=<?php echo $row['id']; ?>"><img src="delete.png"></a>
			| <strong><?php echo $row['comment']; ?></strong><br>
			<strong>Alias: </strong><?php echo $row['source']; ?><br>
			<em><?php echo $row['destination']; ?></em></p>
	<?php
	}
}

?>

<h1>Active Emails</h1>

<h2>systemanomaly.com</h2>
<div class="two-col">
<?php
$sql = "SELECT * FROM `virtual_aliases` WHERE `valid` = 1 AND `source` LIKE '%@systemanomaly.com' ORDER BY `comment` ASC";

$result = $mysql->query($sql);

display_alias($result);
?>
</div>

<h2>j3b.in</h2>
<div class="two-col">
<?php
$sql = "SELECT * FROM `virtual_aliases` where `valid` = 1 and `source` LIKE '%@j3b.in' ORDER BY `comment` ASC";

$result = $mysql->query($sql);

display_alias($result);
?>
</div>

<h2>cheshil.com</h2>
<div class="two-col">
<?php
$sql = "SELECT * FROM `virtual_aliases` where `valid` = 1 and `source` LIKE '%@cheshil.com' ORDER BY `comment` ASC";

$result = $mysql->query($sql);

display_alias($result);
?>
</div>

<?php

# List Deactivated Aliases

?>

<h1>Inactive Emails</h1>

<div class="two-col">
<?php
$sql = "SELECT * FROM `virtual_aliases` WHERE `valid` = 0";

$result = $mysql->query($sql);

while($row = $result->fetch_array()) {
?>

		<p><strong><?php echo $row['comment']; ?></strong><br>
		<strong>Alias: </strong><?php echo $row['source']; ?><br>
		<em><?php echo $row['destination']; ?></em></p>

<?php
}

?>
</div>

<?php

$mysql->close();
?>

		</div>
	</body>
</html>
