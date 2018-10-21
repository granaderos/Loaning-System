<?php
		
	include_once "../../classes/Transaction.php";
	
	$client_id = $_POST["client_id"];
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$job = $_POST['job'];
	$income = $_POST['income'];
	
	$action = new Transaction();
	$client_id = $action -> update_client($client_id, $last_name, $first_name, $address, $contact, $email, $job, $income);