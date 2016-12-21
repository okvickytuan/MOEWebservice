<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'MOEdb';

$Username = $_POST['Username'];
$Password = $_POST['Password'];

	$m = new MongoClient();
	$db = $m->$dbName;
	if ($db) {
		$collection = $db->Test;
	
		$query = array('username' => $Username);
		$count = $collection->findOne($query);
		
		$document = array(
			'username' => $Username,
			'password' => $Password,
			'loginTime' => 0,
			'Closest' => (object)array()
		);
		
		
		if(trim($Username) == "" || trim($Password) == "" || 
			strlen(trim($Username)) < 6 || strlen(trim($Password)) < 6) {
			echo 2;
		} else if(!count($count)) {
			$collection->insert($document);
			echo 4;	//Success
		} else {
			echo 3;	//Username already exist
		}
	} else {
		echo 6;		//Failed to connect to database
	}
   
?>