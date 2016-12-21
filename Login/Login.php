<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'MOEdb';

$Username = $_POST['Username'];
$Password = $_POST['Password'];

	$m = new MongoClient();
	$db = $m->$dbName;
	$collection = $db->Test;
	
	$query = array(
		'username' => $Username,
		'password' => $Password
	);
	$user = $collection->findOne($query);
	if ($db) {
		if(!count($user)) {
			$data = ['api' => 0];
			echo json_encode( $data );	//Login Failed
		} else {
			if ($user['loginTime'] == 0 || time() - $user['loginTime'] > 11) {
				$user['loginTime'] = time();
				
				if (count($user['Closest']) == 0) {
					$data = array(
						'api' => 1,
						'id' => (string)$user['_id']
					);
					echo json_encode( $data );	//Login Success
				} else {
					$data = array(
						'api' => 1,
						'id' => (string)$user['_id'],
						'closest' => $user['Closest']
					);
					echo json_encode( $data );	//Login Success
				}
				
				
			} else {
				$data = ['api' => 0];
				echo json_encode( $data );	//Login Failed
			}
			
		}
	} else {
		echo 6;		//Failed to connect to database
	}
	
   
?>