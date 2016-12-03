<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'QuestionDB';
$qid = $_POST['qid'];
$answer = $_POST['answer'];

	$m = new MongoClient();
	$db = $m->$dbName;
	$collection = $db->Question;
	
	$query = array(
		'qid' => intval($qid)
	);
	$ques = $collection->findOne($query);
	if ($db) {
		if(count($ques)) {
			if ($ques['rightAnswer'] == $answer) {
				$data = ['api' => 12];		//Answer correct
				echo json_encode( $data );
			} else {
				$data = ['api' => 13];		//Answer wrong
				echo json_encode( $data );
			}
		}
	} else {
		echo json_encode(['api' => 6]);		//Failed to connect to database
	}
	
   
?>