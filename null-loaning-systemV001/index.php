<html>
	<head>
		<link rel = "stylesheet" href = "css/bootstrap.min.css" />
    	<link rel = "stylesheet" href = "css/jquery-ui.min.css" />
		<link rel = "stylesheet" href = "css/log-in-design.css" type = "text/css" />
		<script type = "text/javascript" src = "js/functionality.js"></script>
		<script type = "text/javascript" src = "js/jquery-1.9.1.min.js"></script>
		<script type = "text/javascript" src = "js/jquery-ui-1.10.2.min.js"></script>
	</head>
	
	<body>
		<div id = "divMainContainer">
			<h2>NULL Loaning System</h2>
			
			<div id = "divLogin">
				<span>LOG-IN</span> <br /><hr>
				username: <input type = "text" id = "username" name = "username" /><br />
				password: <input type = "password" id = "password" name = "password" /><br />
				<input type = "radio" id = "client" name = "type" /> client
				<input type = "radio" id = "admin" name = "type" /> admin <br/>
				<br /> <br />
				<a href = "home.php"><button class = "span3 btn-large btn-primary">log-in</button></a> <button class = "span3 btn-large btn-danger">reset</button>
				
			</div>
		</div>
	</body>
</html>