<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'MOEdb';

$Id = $_POST['Id'];

	$m = new MongoClient();
	$db = $m->$dbName;
	$collection = $db->Test;
	
	$query = array('_id' => new MongoId($Id));
	$user = $collection->findOne($query);
	$update = array(
		'$set' => array(
			'loginTime' => time()
		)
	);
	try {
		if(count($user)) {
			$collection->update($query, $update);
		}
		
	} catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}
   
?>