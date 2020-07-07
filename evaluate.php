<?php

function Answer_Evaluator ( $post_array ) {
	$myHTML = "<div><pre>";
	
	foreach ( $post_array as $answer ) {
		$answerArray = explode("-", $answer);
		$card = $answerArray[0];
		$meaning = $answerArray[1];
		$truthValue = $answerArray[2];
		
	$myHTML .= "<span>$card, $meaning, $truthValue</span><br />";
	}
	
	//$myHTML .= var_export($post_array, TRUE)."</pre></div>";
	return $myHTML;
}








?>