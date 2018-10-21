<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$propId = $_POST["propId"];
	
    $action->retrieve_property_data($propId);