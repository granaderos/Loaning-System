<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$client_id = $_POST["client_id"];
	
    $action->retrieve_client_data($client_id);