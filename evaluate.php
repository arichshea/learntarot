<?php
require_once("cards.php");

function Answer_Evaluator ( $post_array ) {
	$myHTML = "<div><pre>";
	$points = 0;
	$possiblePoints = 0;
	//var_dump($post_array);
	foreach ( $post_array as $answer ) {
		if ($post_array["lessonType"] != $answer) {
			if ($post_array["lessonType"] == "Intro" || $post_array["lessonType"] == "Practice") {
				$answerArray = explode("-", $answer);
				$card = $answerArray[0];
				$meaning = $answerArray[1];
				$truthValue = $answerArray[2];
				$answer = new Answer($card, $meaning, $truthValue);
				if ($currentAnswer = $answer->checkAnswer()) { $points++; }
				$possiblePoints++;
				
				$myHTML .= "<span>$card, $meaning, $truthValue, evaluation: $currentAnswer</span><br />";
			}
			if ($post_array["lessonType"] == "Master") {
				$card = str_replace("_"," ",array_keys($post_array, $answer)[0]);
				$truthValue = "true";
				foreach( explode(",", $answer) as $meaning) {
					$answer = new Answer($card, $meaning, $truthValue);
					if ($currentAnswer = $answer->checkAnswer()) { $points++; }
					$possiblePoints++;
					
					$myHTML .= "<span>$card, $meaning, $truthValue, evaluation: $currentAnswer</span><br />";
				}
			}
		}
	}
	
	$myHTML .= "<span>Total score: $points / $possiblePoints</span><br />";
	
	//$myHTML .= var_export($post_array, TRUE)."</pre></div>";
	return $myHTML;
}


class Answer {
	
	public $name;
	public $meaning;
	public $truthValue;
	
	public function __construct( $name, $meaning, $truthValue) {
		$this->name = $name;	
		$this->meaning = $meaning;
		$this->truthValue = $truthValue;
	}
	
	public function checkAnswer() {
		$allCardset = new Cardset();
		$meanings = $allCardset->allCards[$this->name]->upMeanings;
		$searchResult = array_search($this->meaning, $meanings);
		if ($searchResult !== FALSE) {
			return $this->truthValue == "true";
		} else {
			return $this->truthValue == "false";
		}
	}
	
}




?>