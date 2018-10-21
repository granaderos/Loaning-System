<?php
		
	include_once "../../classes/Transaction.php";

	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$job = $_POST['job'];
	$income = $_POST['income'];
	
	$date_of_loan = $_POST['date'];
	$amount = $_POST['amount'];
	$balance = $_POST['balance'];
	$collateral = $_POST['collateral'];
	$date_due = $_POST['date_due'];
	$mode_of_payment = $_POST['mode_of_payment'];
	
	$remarks = $_POST['remarks'];
	$prop_id = "loan_title";
	
	$action = new Transaction();
	$client_id = $action -> add_client($last_name, $first_name, $address, $contact, $email, $job, $income, $prop_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $date_due, $remarks);
	$action -> add_transaction($client_id, $prop_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $date_due, $remarks);
	$action -> generate_client_account($client_id, $last_name, $contact);