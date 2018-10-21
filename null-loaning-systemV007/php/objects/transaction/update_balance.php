<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$trans_id = $_POST["trans_id"];
	$amount = $_POST["amount"];
	
    $action->update_balance($trans_id, $amount);