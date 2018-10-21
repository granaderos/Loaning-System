<html>
	<head>
		<link rel = "stylesheet" href = "css/bootstrap.min.css" />
    	<link rel = "stylesheet" href = "css/jquery-ui.min.css" />
		<link rel = "stylesheet" href = "css/design.css" type = "text/css" />
		<script src = "js/bootstrap.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-1.9.1.min.js" type = "text/javascript"></script>
		<script src = "js/jquery-ui-1.10.2.min.js" type = "text/javascript"></script>
		<script src = "js/null_client_functionality.js" type = "text/javascript"></script>
	</head>
	
	<body>
		<div id = "divMainContainer">
			<h2>NULL  LOANING  SYSTEM</h2>
			
			<div id = "divContent">
			</div> <!-- End of div content -->
			
			<div id = "divNav">
				<ul id = "ulNav">
					<li id = "cmd_home"><a>HOME</a></li><br />
					<li id = "cmd_new_loan"><a>NEW LOAN</a></li><br />
					<li id = "cmd_contact_admin"><a>CONTACT MANAGEMENT</a></li> <br />
					<li id = "cmd_account"><a>ACCOUNT</a></li> <br />
					<li><a href = "index.php">log-out</a></li> <br />
				</ul>
			</div>
			
			<div id = "nullClientHomeContent">
				<form method = "POST" id = "form_client_data">
					<table>
						<tr>
							<td>
								<table>
									<tr><td><h3>Current Loan</h3></td></tr>
								</table>
							</td>
							<td>
								<table>
									<tr><td><h3>Loans</h3></td></tr>
								</table>
							</td>
						</tr>
					</table>
					<br />
				</form>	
			</div><!-- end of home content -->
			
			<div id = "newLoanContent">
				<h3>You are attempting to apply for a new loan...</h3>
			</div><!-- end of newLoanContent -->
			
			<div id = "contactContent">
				<h3>Send message to the management.</h3>
			</div><!-- end of contactContent -->
			
			<div id = "accountContent">
				<h3>Manage Your Account</h3>
			</div><!-- end of accountContent -->
			
		</div>
	</body>
</html>