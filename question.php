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
		foreach ($cardUpMeanings as $key=>$meaning) {
			$answerHTML .= "<span class='answer good' onclick='$(this).addClass(\"clicked\");' >
							<label for='$cardName-$meaning-true'>
							$meaning
							<input type='radio' name='$cardName-$meaning' id='$cardName-$meaning-true' value='$cardName-$meaning-true'>true</input>
							</label>
							<label for='$cardName-$meaning-false'>
							<input type='radio' name='$cardName-$meaning' id='$cardName-$meaning-false' value='$cardName-$meaning-false'  checked='checked'>false</input>
							</label>
							</span>";
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
			$answerHTMLarray[] = "<span class='answer good' onclick='$(this).addClass(\"clicked\");' >
							<label for='$cardName-$meaning-true'>
							$meaning
							<input type='radio' name='$cardName-$meaning' id='$cardName-$meaning-true' value='$cardName-$meaning-true'>true</input>
							</label>
							<label for='$cardName-$meaning-false'>
							<input type='radio' name='$cardName-$meaning' id='$cardName-$meaning-false' value='$cardName-$meaning-false'  checked='checked'>false</input>
							</label>
							</span>";
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
		$answerHTML = "<label for='text$cardName'><span class='answer good' onclick='' >meanings:<br/><input type='text' name='$cardName' id='text$cardName' /></span></label>";

		return "<div class='question'>
					<div class='questionText'><h2 id='questionText'>$cardName</h2></div>
					<div class='imgFrame'><img src='./img/$cardImg' /></div>
					<div class='answerFrame'>$answerHTML</div>
				</div>";
	}	
	
	
	
}

?>