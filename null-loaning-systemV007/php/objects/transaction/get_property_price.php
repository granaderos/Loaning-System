<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$prop_id = $_POST["prop_id"];
	
    $action->getPropertyPrice($prop_id);