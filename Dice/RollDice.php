<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	
	$query = rand(1, 6);
	
	echo json_encode(["dot" => $query]);
   
?>