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
				<span>M E N U</span><hr />
				<ul id = "ulNav">
					<li id = "cmd_home"><a>HOME</a></li><br />
					<li id = "cmd_clients"><a>CLIENTS</a></li><br />
					<li id = "cmd_transactions"><a>TRANSACTIONS</a></li> <br />
					<li id = "cmd_properties"><a>PROPERTIES</a></li> <br />
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
										<td><input type = "text" id = "firstname" name = "firstname"></td>
									</tr>
									<tr>
										<td>Last name</td>
										<td>:</td>
										<td><input type = "text" id = "lastname"></td>
									</tr>
									<tr>
										<td>Address</td>
										<td>:</td>
										<td><input type = "text" id = "address"></td>
									</tr>
									<tr>
										<td>Contact Number</td>
										<td>:</td>
										<td><input type = "text" id = "contact"></td>
									</tr>
									<tr>
										<td>Email Address</td>
										<td>:</td>
										<td><input type = "text" id = "email"></td>
									</tr>
									<tr>
										<td>Job</td>
										<td>:</td>
										<td><input type = "text" id = "job"></td>
									</tr>
									<tr>
										<td>Income/Month</td>
										<td>:</td>
										<td><select id = "income">
										<option>P10,000 below</option>
										<option>P10,000 - P50,000</option>
										<option>P50,000 - P100,000</option>
										<option>P100,000 - P200,000</option>
										<option>P200,000 - P500,000</option>
										<option>P500,000 above</option>
										</select></td>
									</tr>
								</table>
							</td>
							<td>
								<table>
									<tr><td><h3>Loan Data</h3></td></tr>
									<tr>
										<td>Date</td>
										<td>:</td>
										<td><input type = "text" id = "date" value = "0000-00-00"></td>
									</tr>
									<tr>
										<td>Loan Type</td>
										<td>:</td>
										<td><select id = "type"><option>Cash</option><option>House</option><option>Car</option></select></td>
									</tr>
									<tr>
										<td>title</td>
										<td>:</td>
										<td><input type = "text" id = "loan_title"></td>
									</tr>
									<tr>
										<td>Amount(cash)/Price(car|house)</td>
										<td>:</td>
										<td><input type = "text" id = "amount"></td>
									</tr>
									<tr>
										<td>Collateral</td>
										<td>:</td>
										<td><input type = "text" id = "collateral"></td>
									</tr>
									<tr>
										<td>Mode of Payment</td>
										<td>:</td>
										<td><select id = "mode_of_payment" ><option>Quarterly</option>
													<option>Annually</option>
													<option>Semi-quarterly</option>
										</select></td>
									</tr>
									<tr>
										<td>remarks</td>
										<td>:</td>
										<td><input type = "text" id = "remarks"></td>
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
				<span id = "span_search" class = "pull-right">search: <input type = "text" id = "search_client" /></span> <h3>Clients</h3>
				<table id = "client_list" class = "table tbl-hover">
					
				</table>
			</div><!-- end of clientsContent -->
			
			<div id = "transactionsContent">
				<h3>Transactions</h3>
				<table id = "transaction_list" class = "table tbl-hover"></table>
			</div><!-- end of transactionsContent -->
			
			<div id = "propertiesContent">
				<h3>Properties</h3>
				<table id = "properties_list" class = "table tbl-hover"></table>
			</div><!-- end of propertiesContent -->
			
			
		</div>
	</body>
</html>