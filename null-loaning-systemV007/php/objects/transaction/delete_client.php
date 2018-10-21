<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$client_id = $_POST["client_id"];
	
    $action->delete_client($client_id);