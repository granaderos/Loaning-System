<html>
	<head>
		<link rel = "stylesheet" href = "css/bootstrap.min.css" />
    	<link rel = "stylesheet" href = "css/jquery-ui.min.css" />
		<link rel = "stylesheet" href = "css/design.css" type = "text/css" />
		<script src = "js/bootstrap.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-1.9.1.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-ui-1.10.2.min.js" type = "text/javascript"></script>
	</head>
	
	<body>
		<div id = "divMainContainer">
			<h2>NULL Loaning System</h2>
			
			<div id = "divContent">
				<form>
					<table>
						<tr><td><h3>NEW CLIENT</h3></td></tr>
						<tr>
							<td>
								<table>
									<tr>
										<td>First name</td>
										<td>:</td>
										<td><input type = "text" name = "firstname"></td>
									</tr>
									<tr>
										<td>Last name</td>
										<td>:</td>
										<td><input type = "text" name = "lastname"></td>
									</tr>
									<tr>
										<td>Address</td>
										<td>:</td>
										<td><input type = "text" name = "address"></td>
									</tr>
									<tr>
										<td>Contact Number</td>
										<td>:</td>
										<td><input type = "text" name = "contact"></td>
									</tr>
									<tr>
										<td>Email Address</td>
										<td>:</td>
										<td><input type = "text" name = "lastname"></td>
									</tr>
									<tr>
										<td>Job</td>
										<td>:</td>
										<td><input type = "text" name = "address"></td>
									</tr>
									<tr>
										<td>Income/Month</td>
										<td>:</td>
										<td><input type = "text" name = "firstname"></td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr><td><h3>LOAN DATA</h3></td></tr>
									<tr>
										<td>Loan Type</td>
										<td>:</td>
										<td><select name = "address"><option>Cash</option><option>Home</option><option>Car</option></select></td>
									</tr>
									<tr>
										<td>Amount</td>
										<td>:</td>
										<td><input type = "text" name = "amount"></td>
									</tr>
									<tr>
										<td>Collateral</td>
										<td>:</td>
										<td><input type = "text" name = "collateral"></td>
									</tr>
									<tr>
										<td>Time Allotment</td>
										<td>:</td>
										<td><input type = "text" name = "contact"></td>
									</tr>
									<tr>
										<td>another data</td>
										<td>:</td>
										<td><input type = "text" name = "lastname"></td>
									</tr>
									<tr>
										<td>data</td>
										<td>:</td>
										<td><input type = "text" name = "address"></td>
									</tr>
									<tr>
										<td>data</td>
										<td>:</td>
										<td><input type = "text" name = "firstname"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<br />
					<span id = "spanBtn"><button class = "span4 btn-large btn-primary">submit</button> &nbsp;
					<button class = "span4 btn-large btn-danger">reset</button> </span>
				</form>
			</div>
			
			<div id = "divNav">
				<ul id = "ulNav">
					<li><a>HOME</a></li><br />
					<li><a>CLIENTS</a></li><br />
					<li><a>TRANSACTIONS</a></li> <br />
					<li><a href = "index.php">log-out</a></li> <br />
				</ul>
			</div>
		</div>
	</body>
</html>