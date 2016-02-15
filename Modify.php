<html>
	<head>
	  	<meta charset="UTF-8">
		<meta name="description" content="Stock Monitor and Portfolio Manager">
		<meta name="keywords" content="HTML,CSS,PHP">
		<meta name="author" content="Anirudh Goel">
		<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Modify.css">
		<link rel="stylesheet" href="http://csinsit.org/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:600,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<!--  -->
		<!--  -->
		<!-- Script to display live search suggestions -->
		<!--  -->
		<!--  -->
		<script>
			function showResult(str) 
			{
				if (str.length==0) 
				{
					document.getElementById("livesearch").innerHTML="";
					document.getElementById("livesearch").style.border="0px";
					return;
				}

				if (window.XMLHttpRequest) 
				{
					xmlhttp=new XMLHttpRequest();
				}

				xmlhttp.onreadystatechange=function() 
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200) 
					{
						document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
						document.getElementById("livesearch").style.border="1px solid #A5ACB2";
					}
				}
				xmlhttp.open("POST","livesearch.php?q="+str,true);
				xmlhttp.send();
			}
		</script>
		<!--  -->
		<!--  -->
		<!--  -->
		<!--  -->
		<!--  -->
	</head>
	<body>
		<div class='jumbotron'>
			<h1>Stock Monitor and Portfolio Manager</h1>
		</div>
		
		<div class='text-center'>
			<form action='Modify.php' method='POST'>
				<input name='var1' type='text' class='input-lg' placeholder='Stock Symbol 1' onkeyup="showResult(this.value)">
				<input name='pri1' type='text' class='input-lg' placeholder='Price'>
				<input name='vol1' type='text' class='input-lg' placeholder='Volume'>
				<br>
				<br>
				<input name='var2' type='text' class='input-lg' placeholder='Stock Symbol 2' onkeyup="showResult(this.value)">
				<input name='pri2' type='text' class='input-lg' placeholder='Price'>
				<input name='vol2' type='text' class='input-lg' placeholder='Volume'>
				<br>
				<br>
				<input name='var3' type='text' class='input-lg' placeholder='Stock Symbol 3' onkeyup="showResult(this.value)">
				<input name='pri3' type='text' class='input-lg' placeholder='Price'>
				<input name='vol3' type='text' class='input-lg' placeholder='Volume'>
				<br>
				<br>
				<input name='var4' type='text' class='input-lg' placeholder='Stock Symbol 4' onkeyup="showResult(this.value)">
				<input name='pri4' type='text' class='input-lg' placeholder='Price'>
				<input name='vol4' type='text' class='input-lg' placeholder='Volume'>
				<br>
				<br>
				<input name='var5' type='text' class='input-lg' placeholder='Stock Symbol 5' onkeyup="showResult(this.value)">
				<input name='pri5' type='text' class='input-lg' placeholder='Price'>
				<input name='vol5' type='text' class='input-lg' placeholder='Volume'>
				<div id="livesearch"></div>
				<br>
				<br>
				<input name='Add' type='submit' class='btn btn-lg btn-success' value='Add'>
				<input name='Delete' type='submit' class='btn btn-lg btn-danger' value='Delete'>
				<br>
				<br>
			</form>
		</div>
	</body>
</html>

<?php
	// If Add button is pressed
	if(isset($_POST['Add']))
	{ 
		// Checking wether first line is completely filled
		if(empty($_POST['var1']) or empty($_POST['pri1']) or empty($_POST['vol1']))
		{
			?><h1><center>To add values please fill atleast first row completely.</center></h1><?php
			die();
		}

		// Establising Connection to SQL
		$servername = 'localhost';
		$username = 'root';
		$password = 'password';

		// Create Connection
		$conn = mysqli_connect($servername, $username, $password);

		// Check Connection
		if(!$conn)
		{
			die('Connection to SQL failed:' . mysqli_connect_error());
		}

		// Creating Database
		$sql = 'CREATE DATABASE IF NOT EXISTS stocks';

		// Establising Connection to Database
		$db = 'stocks';

		// Create Connection
		$dbconn = mysqli_select_db($conn, $db);

		// Check Connection
		if(!$dbconn)
		{
			die('Connection to Database failed:' . mysqli_connect_error());
		}

		// Create Table
		$sql = "CREATE TABLE IF NOT EXISTS portfolio
		(
			stock_symbol VARCHAR(30) PRIMARY KEY,
			price INT(30),
			volume INT(30)
		)";

		if (!mysqli_query($conn, $sql)) 
		{
			echo "Error creating table: " . mysqli_error($conn);
			die();
		}

		for($x=1;$x<=5;$x++)
		{
			$var = [];
			$pri = [];
			$vol = [];
			if (!empty($_POST['var'.$x]) and !empty($_POST['pri'.$x]) and !empty($_POST['vol'.$x])) 
			{
				$var[$x] = $_POST['var'.$x];
				$pri[$x] = $_POST['pri'.$x];
				$vol[$x] = $_POST['vol'.$x];
				$sql = "INSERT INTO portfolio 
					(stock_symbol, price, volume)
					VALUES ('$var[$x]', $pri[$x], $vol[$x])";
					// Code to be reviewed
					// ON DUBLICATE PRIMARY KEY UPDATE
					// price=VALUES($pri[$x]), volume=VALUES($vol[$x]);";

				// Check if values are added successfully
				if(mysqli_query($conn, $sql))
				{
					?><h1><center><?php
					echo $x.". Values added.";
					?></h1><center><?php
				}
				else
				{
					?><h3><center><?php
					echo $x.". Error adding values to table". "<br>". $sql.
					"<br>". $conn->error;
					?></h3><center><?php
				}
			}
		}
		mysqli_close($conn);
	}


	// If Delete button is pressed


	else if(isset($_POST['Delete']))
	{
		// Checking wether stock symbol (required) is given
		if(empty($_POST['var1']))
		{
			?><h1><center>To delete values atleast enter the symbol of stock to be deleted.</center></h1><?php
			die();
		}

		// Establising Connection to SQL
		$servername = 'localhost';
		$username = 'root';
		$password = 'password';

		// Create Connection
		$conn = mysqli_connect($servername, $username, $password);

		// Check Connection
		if(!$conn)
		{
			die('Connection to SQL failed:' . mysqli_connect_error());
		}

		// Establising Connection to Database
		$db = 'stocks';

		// Create Connection
		$dbconn = mysqli_select_db($conn, $db);

		// Check Connection
		if(!$dbconn)
		{
			die('Connection to Database failed:' . mysqli_connect_error());
		}


		for($x=1;$x<=5;$x++)
		{
			$var = [];
			$pri = [];
			$vol = [];
			
			// All three values to be deleted are given
			if (!empty($_POST['var'.$x]) and !empty($_POST['pri'.$x]) and !empty($_POST['vol'.$x])) 
			{
				$var[$x] = $_POST['var'.$x];
				$pri[$x] = $_POST['pri'.$x];
				$vol[$x] = $_POST['vol'.$x];
				$sql = "DELETE FROM portfolio 
				WHERE stock_symbol='$var[$x]' and price=$pri[$x] and volume=$vol[$x]";

				// Check if values are deleted successfully
				if(mysqli_query($conn, $sql))
				{
					?><h1><center><?php
					echo $x.". Values deleted.";
					?></h1><center><?php
				}
				else
				{
					?><h3><center><?php
					echo $x.". Error deleting values from table". "<br>". $sql.
					"<br>". $conn->error;
					?></h3><center><?php
				}
			}
			
			// Only Stock Symbol and Price to be deleted are given
			else if (!empty($_POST['var'.$x]) and !empty($_POST['pri'.$x])) 
			{
				$var[$x] = $_POST['var'.$x];
				$pri[$x] = $_POST['pri'.$x];
				$sql = "DELETE FROM portfolio 
				WHERE stock_symbol='$var[$x]' and price=$pri[$x]";

				// Check if values are deleted successfully
				if(mysqli_query($conn, $sql))
				{
					?><h1><center><?php
					echo $x.". Values deleted.";
					?></h1><center><?php
				}
				else
				{
					?><h3><center><?php
					echo $x.". Error deleting values from table". "<br>". $sql.
					"<br>". $conn->error;
					?></h3><center><?php
				}
			}

			// Only Stock Symbol and Volume to be deleted are given
			else if (!empty($_POST['var'.$x]) and !empty($_POST['vol'.$x]))
			{
				$var[$x] = $_POST['var'.$x];
				$vol[$x] = $_POST['vol'.$x];
				$sql = "DELETE FROM portfolio 
				WHERE stock_symbol='$var[$x]' and volume=$vol[$x]";

				// Check if values are deleted successfully
				if(mysqli_query($conn, $sql))
				{
					?><h1><center><?php
					echo $x.". Values deleted.";
					?></h1><center><?php
				}
				else
				{
					?><h3><center><?php
					echo $x.". Error deleting values from table". "<br>". $sql.
					"<br>". $conn->error;
					?></h3><center><?php
				}
			}

			// Only Stock Symbol to be deleted is given
			else if (!empty($_POST['var'.$x]))
			{
				$var[$x] = $_POST['var'.$x];
				$sql = "DELETE FROM portfolio 
				WHERE stock_symbol='$var[$x]'";

				// Check if values are deleted successfully
				if(mysqli_query($conn, $sql))
				{
					?><h1><center><?php
					echo $x.". Values deleted.";
					?></h1><center><?php
				}
				else
				{
					?><h3><center><?php
					echo $x.". Error deleting values from table". "<br>". $sql.
					"<br>". $conn->error;
					?></h3><center><?php
				}
			}
		}
		mysqli_close($conn);
	}
?>



<html>
	<div class='disclaimer'>
		**********************
		Copyright © 2016. All market data provided by Barchart Market Data Solutions.

		BATS market data is at least 15-minutes delayed. Forex market data is at least 10-minutes delayed. AMEX, NASDAQ, NYSE and futures market data (CBOT, CME, COMEX and NYMEX) is end-of-day. Information is provided 'as is' and solely for informational purposes, not for trading purposes or advice, and is delayed. To see all exchange delays and terms of use, please see our disclaimer.
		**********************
	</div>
</html>