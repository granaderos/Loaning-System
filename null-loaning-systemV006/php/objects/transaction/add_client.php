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
	$mode_of_payment = $_POST['mode_of_payment'];
	$remarks = $_POST['remarks'];
	$loan_id = "temp_id";
	
	$action = new Transaction();
	$client_id = $action -> add_client($last_name, $first_name, $address, $contact, $email, $job, $income, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks);
	$action -> add_transaction($client_id, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment, $remarks);