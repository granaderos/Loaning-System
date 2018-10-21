<?php
    include "../../classes/Transaction.php";
    $action = new Transaction();

	$propId = $_POST['propId'];
	
    $action->delete_property($propId);