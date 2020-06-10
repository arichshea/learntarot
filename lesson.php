<?php
require_once("cards.php");
require_once("question.php");

abstract class Lesson {
	
	public $cardSet;
	public $questionSet;
	public function __construct($cardSet) {
	 $this->cardSet = $cardSet;
	 $this->questionSet = $this->getQuestions( $this->cardSet->setCards );
	}
	
	public function getLessonHTML() {
		$questionsHTML = "";
		foreach ($this->questionSet as $question) {
			$questionsHTML .= $question->getQuestionHTML();
		}
		return "<div id='lessonFrame'>
					<form name='lesson' id='lesson'>
					$questionsHTML
					<div class='submit'> <input type='submit' value='Submit Answers' /></div>
					</form>
				   </div>";
	}
	public function getQuestions( $myCards ) {
	}
}

class IntroLesson extends Lesson {
	
	public function getQuestions ( $myCards ) {
		
		$myQuestions = array();
		shuffle($myCards);
		
		foreach ($myCards as $card) {
			$myQuestion = new IntroQuestion( $card );
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
			$wrongMeanings = array();
			foreach ($myCards as $card2) {
				if ($card2 != $card) {
					foreach ($card2->upMeanings as $meaning) {
						$wrongMeanings[] = $meaning;
					}
				}
			}
			
			shuffle($wrongMeanings);
			shuffle($wrongMeanings); //making it extra random so i can just slice off the first five with JS later
			$fiveWrongMeanings = array_slice($wrongMeanings, 0, 5);
			$myQuestion = new PracticeQuestion( $card, $fiveWrongMeanings );
			$myQuestions[] = $myQuestion;
		}
		return $myQuestions;
			
	}

}

class MasterLesson extends Lesson {
	
	public function getQuestions( $myCards ) {
	}

}



?>