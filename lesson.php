<?php
require_once("cards.php");

abstract class Lesson {
	
	public $cardSet;
	public $questionSet;
	public function __construct($cardSet) {
	 $this->cardSet = $cardSet;
	 $this->questionSet = $this->getQuestions( $this->cardSet->setCards );
	}
	
	public function getLessonHTML() {
		return "<div id='lessonFrame'>
					<div><h2 number=1 id='cardName'></h2></div>
					<div id='imgFrame'><img src='./img/' /></div>
					<div id='answerFrame'></div>
					<div id='nextButtonFrame'><button id='nextButton' onclick='putQuestion(myGlob[1])'>Next Question</button></div>
					<div id='scoreFrame'>Score| Correct:<span id='scoreCorrect'>0</span> Wrong:<span id='scoreWrong'>0</span> Total:<span id='scoreTotal'>0</span></div>
				   </div>
					<script>var myGlob =".json_encode($this->questionSet)."; putQuestion(myGlob[0]);</script>";
	}
	public function getQuestions( $myCards ) {
	}
}

class IntroLesson extends Lesson {
	
	public function getQuestions ( $myCards ) {
		
		$myQuestions = array();
		shuffle($myCards);
		
		foreach ($myCards as $card) {
			$myQuestion = array();
			$myQuestion["card"] = $card;
			$myQuestions[] = $myQuestion;
		}
		return $myQuestions;
			
	}

}

class PracticeLesson extends Lesson {

	public function getQuestions ( $myCards ) {
		
		$myQuestions = array();
		shuffle($myCards);
		
		foreach ($myCards as $card) {
			$myQuestion = array();
			$wrongMeanings = array();
			foreach ($myCards as $card2) {
			if ($card2 != $card) {
					foreach ($card2->upMeanings as $meaning) {
						$wrongMeanings[] = $meaning;
					}
				}
			}
			$myQuestion["card"] = $card;
			shuffle($wrongMeanings);
			shuffle($wrongMeanings); //making it extra random so i can just slice off the first five with JS later
			$myQuestion["wrongMeanings"]= array_slice($wrongMeanings, 0, 5);
			$myQuestions[] = $myQuestion;
		}
		return $myQuestions;
			
	}

}

class MasterLesson extends Lesson {

}



?>