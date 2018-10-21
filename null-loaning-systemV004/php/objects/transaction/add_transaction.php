<?php
		
	include_once "../../classes/Transaction.php";

	$client_id = $_POST['client_id'];
	$date_of_loan = $_POST['date'];
	$amount = $_POST['amount'];
	$balance = S_POST['balance'];
	$collateral = $_POST['collateral'];
	$mode_of_payment = $_POST['mode_of_payment'];

	$action = new Transaction();
	$action -> add_transaction($client_id, $loan_id, $date_of_loan, $amount, $balance, $collateral, $mode_of_payment);