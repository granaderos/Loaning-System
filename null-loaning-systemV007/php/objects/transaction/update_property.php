<?php
		
	include_once "../../classes/Transaction.php";
	
	$propId = $_POST['propId'];
	$type = $_POST['type'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$location = $_POST['location'];
	
	$action = new Transaction();
	$client_id = $action -> update_property($propId, $type, $name, $price, $location);