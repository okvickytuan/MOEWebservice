<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'MOEdb';

$Id = $_POST['Id'];

$Body = $_POST['Body'];
$Hair = $_POST['Hair'];
$Face = $_POST['Face'];
$Beard = $_POST['Beard'];
$Hat = $_POST['Hat'];
$Backet = $_POST['Backet'];
$Skin = $_POST['Skin'];
$Weapon = $_POST['Weapon'];

$HairColor = $_POST['HairColor'];
$BeardColor = $_POST['BeardColor'];
$HatColor = $_POST['HatColor'];
$WeaponColor = $_POST['WeaponColor'];

	$m = new MongoClient();
	$db = $m->$dbName;
	$collection = $db->Test;
	
	$query = array('_id' => new MongoId($Id));
	$user = $collection->findOne($query);
	$update = array(
		'$set' => array(
			'Closest' => (object)array(
				'Body' => $Body,
				'Hair' => (object)array(
					'Type' => $Hair,
					'Color' => $HairColor
				),
				'Face' => $Face,
				'Beard' => (object)array(
					'Type' => $Beard,
					'Color' => $BeardColor
				),
				'Hat' => (object)array(
					'Type' => $Hat,
					'Color' => $HatColor
				),
				'Backet' => $Backet,
				'Skin' => $Skin,
				'Weapon' => (object)array(
					'Type' => $Weapon,
					'Color' => $WeaponColor
				)
			)
		)
	);
	try {
		if(count($user)) {
			$collection->update($query, $update);
			$data = ['api' => 8];
			echo json_encode( $data );
		} else {
			$data = ['api' => 9];
			echo json_encode( $data );
		}
	} catch (Exception $e) {
		$data = ['api' => 9];
		echo json_encode( $data );
	}
   
?>