<?php 

abstract class Question {
	
	public function getQuestionHTML() {}
	
}

class IntroQuestion extends Question {
	
	public TarotCard $card;
	
	public function __construct( $card ) {
		$this->card = $card;
	}
	
	public function getQuestionHTML() {
		$cardName = $this->card->name;
		$cardImg = $this->card->imgLocation;
		$cardUpMeanings = $this->card->upMeanings;
		$answerHTML = "";
		foreach ($cardUpMeanings as $meaning) {
			$answerHTML .= "<span class='answer good' onclick='$(this).addClass(\"clicked\");'>$meaning</span>";
		}
		return "<div class='question'>
					<div class='questionText'><h2 id='questionText'>$cardName</h2></div>
					<div id='imgFrame'><img src='./img/$cardImg' /></div>
					<div id='answerFrame'>$answerHTML</div>
				</div>";
	}
}


class PracticeQuestion extends Question {
	
	public TarotCard $card;
	public $wrongMeanings;
	
	public function __construct( $card, $wrongMeanings ) {
		$this->card = $card;
		$this->wrongMeanings = $wrongMeanings;
	}
	
	public function getQuestionHTML() {
		$cardName = $this->card->name;
		$cardImg = $this->card->imgLocation;
		$cardUpMeanings = $this->card->upMeanings;
		$answerHTMLarray = [];
		$answerHTML = "";
		foreach ($cardUpMeanings as $meaning) {
			$answerHTMLarray[] = "<span class='answer good' onclick='$(this).addClass(\"clicked\");'>$meaning</span>";
		}
		foreach ($this->wrongMeanings as $meaning) {
			$answerHTMLarray[] = "<span class='answer bad' onclick='$(this).addClass(\"clicked\");'>$meaning</span>";
		}
		shuffle($answerHTMLarray);
		foreach ($answerHTMLarray as $answer) {
			$answerHTML .= $answer;
		}
		return "<div class='question'>
					<div class='questionText'><h2 id='questionText'>$cardName</h2></div>
					<div class='imgFrame'><img src='./img/$cardImg' /></div>
					<div class='answerFrame'>$answerHTML</div>
				</div>";
	}



}


class MasterQuestion extends Question {
	
	
	
	
}

?>