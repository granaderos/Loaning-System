<?php
		
	include_once "../../classes/Transaction.php";

	$search_data = $_POST['search_data'];

	$action = new Transaction();
	$action -> search_client($search_data);