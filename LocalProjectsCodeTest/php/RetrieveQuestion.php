<?php
	require('../FinalPHP/common.php');
	
	function freak_out($message) {
		echo 'ER.'.$message."\n";
		exit;
	}
    $questions = GetAllQuestions(QUESTIONS_TABLE);
    if(empty($questions)) 
	{
        echo 'questions not returned';
    }
    else
    {   
        echo $questions;
    }
?>