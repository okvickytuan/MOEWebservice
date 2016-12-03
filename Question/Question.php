<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$dbName = 'QuestionDB';

	$m = new MongoClient();
	$db = $m->$dbName;
	$collection = $db->Question;
	
	$query = array(
		'qid' => rand(1, 3)
	);
	$ques = $collection->findOne($query);
	if ($db) {
		if(count($ques)) {
			$data = [
				'qid' => $ques['qid'],
				'question_Vi' => $ques['question_Vi'],
				'answer_A_Vi' => $ques['answer_A_Vi'],
				'answer_B_Vi' => $ques['answer_B_Vi'],
				'answer_C_Vi' => $ques['answer_C_Vi'],
				'answer_D_Vi' => $ques['answer_D_Vi'],
				'question_Eng' => $ques['question_Eng'],
				'answer_A_Eng' => $ques['answer_A_Eng'],
				'answer_B_Eng' => $ques['answer_B_Eng'],
				'answer_C_Eng' => $ques['answer_C_Eng'],
				'answer_D_Eng' => $ques['answer_D_Eng'],
				'time' => $ques['time']
			];
			echo json_encode( $data );	//Send question
		}
	} else {
		echo json_encode(['api' => 6]);		//Failed to connect to database
	}
	
   
?>