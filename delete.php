<?php
/*
SA Mail Alias Generator
config.php
2022 - John Bradley (userjack6880)

Available at: https://github.com/userjack6880/mailgen

This file is part of the SA Mail Alias Generator

The SA Mail Alias Generator is free software: you can redistribute it and/or
modify it under the terms of the GNU General Public License as published by the 
Free Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program. If not, see <https://www.gnu.org/licenses/>.
*/
?>

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
			#footer {
				width: 948px;
				margin: 0 auto;
				color: #999;
			}
			a:link {
				text-decoration: none;
				color: #CCC;
			}
			a:visited {
				text-decoration: none;
				color: #CCC;
			}
			a:active {
				text-decoration: none;
				color: #FFF;
			}
			a:hover {
				text-decoration: none;
				color: #FFF;
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
			input[type=checkbox] {
				width: 15px; 
				height: 15px;
				-webkit-border-radius: 5px; 
				-moz-border-radius: 5px; 
				border-radius: 5px;
				border: 1px solid #bbb;
				margin: 10px;
			}
			table {
				width: 90%;
				margin-left: auto;
				margin-right: auto;
			}
			a {
				color: #fff;
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
				#footer {
					width: 100%;
					margin: 0;
					padding: 0;
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
				input[type=checkbox] {
					width: 44px; 
					height: 44px;
					-webkit-border-radius: 22px; 
					-moz-border-radius: 22px; 
					border-radius: 22px;
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
$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
	die("Could not connect: ".mysqli_connect_error());
}

# Delete (rather, deactive) Alias

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	$id = $mysql->real_escape_string($id);

	$sql = "UPDATE `virtual_aliases` SET `valid` = 0 WHERE `id` = $id";

	$mysql->query($sql);

	echo "<h2>Email Deleted</h2>\n";
}

?>

<a href="index.php">Back</a>

<?php

$mysql->close();
?>

		</div>
		<div id="footer">
			SA Mail Alias Generator <a href="https://github.com/userjack6880/mailgen"><?php echo VERSION; ?></a>
		</div>
	</body>
</html>
