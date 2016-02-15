<html>
	<head>
	  	<meta charset="UTF-8">
		<meta name="description" content="Stock Monitor and Portfolio Manager">
		<meta name="keywords" content="HTML,CSS,PHP">
		<meta name="author" content="Anirudh Goel">
		<!-- <META HTTP-EQUIV="refresh" CONTENT="57"> -->
		<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="Portfolio.css">
		<link rel="stylesheet" href="http://csinsit.org/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:600,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class='jumbotron'>
			<h1>Portfolio</h1>
		</div>
	</body>


<?php
	// Connecting to Server
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "stocks";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if (!$conn) 
	{
	    die("Connection to Database failed: " . mysqli_connect_error());
	}

	// Retreiving information from database
	$sql = "SELECT * FROM portfolio";
	$result = mysqli_query($conn, $sql);

	$y = 0;

	// Check if databse is empty
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = mysqli_fetch_assoc($result)) 
		{
			$sym[$y] = $row["stock_symbol"];
			$pri[$y] = $row["price"];
			$vol[$y] = $row["volume"];
			$y += 1;
		}
	}
	// If database empty
	else 
	{
		?><h1><center><?php
		echo "Portfolio Empty";
		?></h1></center><?php
		die();
	}
	mysqli_close($conn);

	$z = '';

	// Adding all stock names in one variable to enable API call
	for($a=0;$a<$y;$a++)
	{
		$z = $z.$sym[$a].',';
	}

	$z = rtrim($z,",");

	// API call
	$contents = file_get_contents("http://marketdata.websol.barchart.com/getQuote.json?key=93dcc722279c3a7577f248b09ef6167f&symbols=".$z."&mode=R");
	$contents = json_decode($contents, true);

	// Initialising variables to store extracted information
	$name = [];
	$symbol = [];
	$exchange = [];
	$open = [];
	$close = [];
	$high = [];
	$low = [];
	$lastprice = [];

	// Check successfull API call
	if($contents["status"]["code"] == 200) 
	{
		foreach($contents['results'] as $result) 
		{
			array_push($name,$result['name']);
			array_push($symbol,$result['symbol']);
			array_push($exchange,$result['exchange']);
			array_push($open,$result['open']);
			array_push($close,$result['close']);
			array_push($high,$result['high']);
			array_push($low,$result['low']);
			array_push($lastprice,$result['lastPrice']);
		}
	}
	// If API call unsuccessfull
	else 
	{
		?>
		<h1><center>"Error retreiving data. Please try again later."</center></h1>
		<?php
		die();
	}
?>

<!-- Generating Output in tabular format -->
<html>
	<table class='table table-responsive'>
		<tr class='head warning'>
			<td>Name</td>
			<td>Symbol</td>
			<td>Exchange</td>
			<td>Open</td>
			<td>Close</td>
			<td>High</td>
			<td>Low</td>
			<td>Last Price</td>
			<td>Price Bought</td>
			<td>Volume Bought</td>
			<td>Change Per Stock</td>
			<td>Profit/Loss</td>
		</tr>
		<?php
			for($x=0;$x<$y;$x++) 
			{?>
				<tr>
					<td><?php echo $name[$x]; ?></td>
					<td><?php echo $symbol[$x]; ?></td>
					<td><?php echo $exchange[$x]; ?></td>
					<td><?php echo $open[$x]; ?></td>
					<td><?php echo $close[$x]; ?></td>
					<td><?php echo $high[$x]; ?></td>
					<td><?php echo $low[$x]; ?></td>
					<td><?php echo $lastprice[$x]; ?></td>
					<td><?php echo $pri[$x]; ?></td>
					<td><?php echo $vol[$x]; ?></td>

					<td><?php 
						if($pri[$x] > $lastprice[$x]) 
						{?>
							<i class="fa fa-arrow-down">
							<?php echo $lastprice[$x]-$pri[$x];
						}
						else if($pri[$x] < $lastprice[$x]) 
						{?>
							</i>
							<i class="fa fa-arrow-up">
							<?php echo $lastprice[$x]-$pri[$x];
							?></i><?php
						}
						else
							echo '0';
						?></td>
					
					<td><?php 
						if($pri[$x] > $lastprice[$x])
						{?>
							<i class="fa fa-arrow-down">
							<?php echo ($lastprice[$x]-$pri[$x]) * $vol[$x];
						}
						else if($pri[$x] < $lastprice[$x]) 
						{?>
							</i>
							<i class="fa fa-arrow-up">
							<?php echo ($lastprice[$x]-$pri[$x]) * $vol[$x];
							?></i><?php
						}
						else
							echo '0'; ?>
					</td>
				</tr>
			<?php } ?>
	</table>
	<br>
	<br>
</html>


<div class='disclaimer'>
	<br>
	<br>
	**********************
	Copyright © 2016. All market data provided by Barchart Market Data Solutions.

	BATS market data is at least 15-minutes delayed. Forex market data is at least 10-minutes delayed. AMEX, NASDAQ, NYSE and futures market data (CBOT, CME, COMEX and NYMEX) is end-of-day. Information is provided 'as is' and solely for informational purposes, not for trading purposes or advice, and is delayed. To see all exchange delays and terms of use, please see our disclaimer.
	**********************
</div>
</html>