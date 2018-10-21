<?php
		
	include_once "../../classes/Transaction.php";

	$type = $_POST['type'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$location = $_POST['location'];
	
	$action = new Transaction();
	
	$action -> add_property($type, $name, $price, $location, "available");