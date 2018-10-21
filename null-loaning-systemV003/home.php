<html>
	<head>
		<link rel = "stylesheet" href = "css/bootstrap.min.css" />
    	<link rel = "stylesheet" href = "css/jquery-ui.min.css" />
		<link rel = "stylesheet" href = "css/design.css" type = "text/css" />
		<script src = "js/bootstrap.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-1.9.1.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-ui-1.10.2.min.js" type = "text/javascript"></script>
		<script src = "js/functionality.js" type = "text/javascript"></script>
	</head>
	
	<body>
		<div id = "divMainContainer">
			<h2>NULL  LOANING  SYSTEM</h2>
			
			<div id = "divContent">
				
			</div> <!-- End of div content -->
			
			
			
			<div id = "divNav">
				<ul id = "ulNav">
					<li id = "cmd_home"><a>HOME</a></li><br />
					<li id = "cmd_clients"><a>CLIENTS</a></li><br />
					<li id = "cmd_transactions"><a>TRANSACTIONS</a></li> <br />
					<li><a href = "index.php">log-out</a></li> <br />
				</ul>
			</div>
			
			<div id = "homeContent">
				<form method = "POST" id = "form_client_data">
					<table>
						<tr>
							<td>
								<table>
									<tr><td><h3>New Client</h3></td></tr>
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
									<tr><td><h3>Loan Data</h3></td></tr>
									<tr>
										<td>Loan Type</td>
										<td>:</td>
										<td><select name = "address"><option>Cash</option><option>Home</option><option>Car</option></select></td>
									</tr>
									<tr>
										<td>title</td>
										<td>:</td>
										<td><input type = "text" name = "loan_title"></td>
									</tr>
									<tr>
										<td>Amount(cash)/Price(car|house)</td>
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
										<td><input type = "text" id = "time_allotment" name = "time_allotment"></td>
									</tr>
									<tr>
										<td>remarks</td>
										<td>:</td>
										<td><input type = "text" name = "remarks"></td>
									</tr>
									<tr>
										<td>data</td>
										<td>:</td>
										<td><input type = "text" name = "data"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<br />
					<span id = "spanBtn"><button id = "btn_submit_client_data"  class = "span4 btn-large btn-primary">Submit</button> &nbsp;
					<input type = "reset" id = "btn_reset" class = "span4 btn-large btn-danger" /></span>
				</form>	
			</div><!-- end of home content -->
			
			<div id = "clientsContent">
				<h3>Clients</h3>
			</div><!-- end of clientsContent -->
			
			<div id = "transactionsContent">
				<h3>Transactions</h3>
			</div><!-- end of transactionsContent -->
			
		</div>
	</body>
</html>