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
			$answerHTML .= "<label for='$cardName-$meaning'><span class='answer good' onclick='$(this).addClass(\"clicked\");' ><input type='checkbox' name='$cardName' id='$cardName-$meaning' value='$meaning' />$meaning</span></label>";
		}
		return "<div class='question'>
					<div class='questionText'><h2 id='questionText'>$cardName</h2></div>
					<div class='imgFrame'><img src='./img/$cardImg' /></div>
					<div class='answerFrame'>$answerHTML</div>
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
		foreach (array_merge($cardUpMeanings,$this->wrongMeanings) as $meaning) {
			$answerHTMLarray[] = "<label for='$cardName-$meaning'><span class='answer good' onclick='$(this).addClass(\"clicked\");' ><input type='checkbox' name='$cardName' id='$cardName-$meaning' value='$meaning' />$meaning</span></label>";
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
	public TarotCard $card;
	
	public function __construct( $card ) {
		$this->card = $card;
	}
	
	public function getQuestionHTML() {
		$cardName = $this->card->name;
		$cardImg = $this->card->imgLocation;
		$cardUpMeanings = $this->card->upMeanings;
		$answerHTML = "<label for='text$cardName'><span class='answer good' onclick='' >meanings:<br/><textarea rows='5' cols='20' name='$cardName' id='text$cardName' /></textarea></span></label>";

		return "<div class='question'>
					<div class='questionText'><h2 id='questionText'>$cardName</h2></div>
					<div class='imgFrame'><img src='./img/$cardImg' /></div>
					<div class='answerFrame'>$answerHTML</div>
				</div>";
	}	
	
	
	
}

?>