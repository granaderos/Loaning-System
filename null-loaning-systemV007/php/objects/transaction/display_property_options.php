<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();
	
	$type = $_POST["type"];
	
    $action->display_property_options($type);