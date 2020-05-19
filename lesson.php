<?php

function Load_Lesson() {
	$myLesson = "intro";
	if (isset($_GET["lesson"])) {
		$myLesson = $_GET["lesson"];
	} 
	
	$myCards = getCards();
	

	
	$myQuestions = getQuestions( $myCards );
	
	$lessonHTML = "";
	if ($myLesson == "intro") {
		$lessonHTML .= getLessonHTML( $myQuestions, 1);
	}
	
	if ($myLesson == "choose_meanings") {	
		$lessonHTML .= getLessonHTML( $myQuestions, 2);
	}
	
	if ($myLesson == "choose_cards") {
		
	}
	if ($myLesson == "write_cards_and_meanings") {
		
	}
	
	return $lessonHTML;
	//check level based on cookie 
	//var Level = check_Level()
	//display corresponding lesson
	//display_Lesson(Level);
	//a lesson is all the cards in a level
	//Any way you cut it, a lesson is an algorithm, generated from the data.
	//load the cards with php and run the lessons with javascript and ajax?
}

function getLessonHTML ( $myQuestions, $type ) {
	$myHTML = "<div id='lessonFrame'>
				<div><h2 number=1 id='cardName'></h2></div>
				<div id='imgFrame'><img src='./img/' /></div>
				<div id='answerFrame'></div>
				<div id='nextButtonFrame'><button id='nextButton' onclick='putQuestion$type(myGlob[1])'>Next Question</button></div>
			   </div>
				<script>var myGlob =".json_encode($myQuestions)."; putQuestion$type(myGlob[0]);</script>";
	return $myHTML;
}

function getQuestions ( $myCards ) {
	
	$myQuestions = array();
	shuffle($myCards);
	
	foreach ($myCards as $card) {
		$myQuestion = array();
		$wrongMeanings = array();
		foreach ($myCards as $card2) {
		if ($card2 != $card) {
				foreach ($card2["meanings"] as $meaning) {
					$wrongMeanings[] = $meaning;
				}
			}
		}
		$myQuestion["card"] = $card;
		shuffle($wrongMeanings);
		shuffle($wrongMeanings); //making it extra random so i can just slice off the first five with JS later
		$myQuestion["wrongMeanings"]= $wrongMeanings;
		$myQuestions[] = $myQuestion;
	}
	return $myQuestions;
		
}

function getCards () { 

	$cardArray = ["The World,fulfillment,harmony,completion,Reversed: incompletion,no closure,image: ar21.jpg",
	"Judgement,reflection,reckoning,awakening,Reversed: lack of self awareness,doubt,self loathing,image: ar20.jpg",
	"The Sun,joy,success,celebration,positivity,Reversed: negativity,depression,sadness,image: ar19.jpg",
	"The Moon,unconscious,illusions,intuition,Reversed: confusion,fear,misinterpretation,image: ar18.jpg",
	"The Star,hope,faith,rejuvenation,Reversed: faithlessness,discouragement,insecurity,image: ar17.jpg",
	"The Tower,sudden upheaval,broken pride,disaster,Reversed: disaster avoided,delayed disaster,fear of suffering,image: ar16.jpg",
	"The Devil,addiction,materialism,playfulness,Reversed: freedom,release,restoring control,image: ar15.jpg",
	"Temperance,middle path,patience,finding meaning,Reversed: extremes,excess,lack of balance,image: ar14.jpg",
	"Death,end of cycle,beginnings,change,metamorphosis,Reversed: fear of change,holding on,stagnation,decay,image: ar13.jpg",
	"The Hanged Man,sacrifice,release,martyrdom,Reversed: stalling,needless sacrifice,fear of sacrifice,image: ar12.jpg",
	"Justice,cause and effect,clarity,truth,Reversed: dishonesty,unaccountability,unfairness,image: ar11.jpg",
	"The Wheel of Fortune,change,cycles,inevitable fate,Reversed: no control,clinging to control,bad luck,image: ar10.jpg",
	"The Hermit,contemplation,search for truth,inner guidance,Reversed: loneliness,isolation,lost your way,image: ar09.jpg",
	"Strength,inner strength,bravery,compassion,focus,Reversed: self doubt,weakness,insecurity,image: ar08.jpg",
	"The Chariot,direction,control,willpower,Reversed: lack of control,lack of direction,aggression,image: ar07.jpg",
	"The Lovers,partnerships,duality,union,Reversed: loss of balance,one-sidedness,disharmony,image: ar06.jpg",
	"The Hierophant,tradition,conformity,morality,ethics,Reversed: rebellion,subversiveness,new approaches,image: ar05.jpg",
	"The Emperor,authority,structure,control,fatherhood,Reversed: tyranny,rigidity,coldness,image: ar04.jpg",
	"The Empress,motherhood,fertility,nature,Reversed: dependence,smothering,emptiness,nosiness,image: ar03.jpg",
	"The High Priestess,intuitive,unconscious,inner voice,Reversed: lack of center,lost inner voice,repressed feelings,image: ar02.jpg",
	"The Magician,willpower,desire,creation,manifestation,Reversed: trickery,illusions,out of touch,image: ar01.jpg",
	"The Fool,innocence,new beginnings,free spirit,Reversed: recklessness,taken advantage of,inconsideration,image: ar00.jpg"];

	$newArray = array();
		
	 foreach ($cardArray as $card) {
			$upright = explode(",Reversed",$card)[0];
			$uprightArray = explode(",",$upright);
			$reversedImage = explode(",Reversed: ",$card)[1];
			$reversed = explode(",image: ",$reversedImage)[0];
			$image = explode(",image: ",$reversedImage)[1];
			$name = array_shift($uprightArray);
			$reversedArray = explode(",",$reversed);
			array_push($newArray, ["name" => $name, "meanings" => $uprightArray, "reversed" => $reversedArray, "image"=> $image]);
		}

	return $newArray;

}

?>