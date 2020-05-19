<?php

function Load_Lesson() {
	$myLesson = "";
	//get lesson
	if (isset($_GET["lesson"])) {
		$myLesson = $_GET["lesson"];
	} 
	
	if ($myLesson == "") {
		$myLesson = "intro";
	}
	
	//load specific lesson 
	//$myCards = get_cards($myLesson);
	//$myQuestions = get_questions($myCards);
	//$lessonHTML = get_lessonHTML($myQuestions);
	//return $lessonHTML;

	$myCards = testData();
	$lessonHTML = "";
	$myQuestions = array();
	if ($myLesson == "intro") {
		foreach ($myCards as $card) {
			$lessonHTML .= "<div id='lessonFrame'><h2>".$card["name"]."</h2>
					<div id='imgFrame'><img src='./img/".$card["image"]."' /></div>
					<div id='answerFrame'>";
			foreach ($card["meanings"] as $meaning) {
				$lessonHTML .= "<span class='answer' >".$meaning."</span>"; 
			}
			$lessonHTML .= "</div></div>";
		}
	}
	
	if ($myLesson == "choose_meanings") {
		
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
			shuffle($wrongMeanings); //making the wrong meanings list extra random so i can just slice off the first five with JS later
			$myQuestion["wrongMeanings"]= $wrongMeanings;
			$myQuestions[] = $myQuestion;
		}
		
		$lessonHTML .= "<div id='lessonFrame'><h2 number=1 id='cardName'>".$myQuestions[0]["card"]["name"]."</h2>
				<div id='imgFrame'><img src='./img/".$myQuestions[0]["card"]["image"]."' /></div>
				<div id='answerFrame'>";		
		foreach ($myQuestions[0]["card"]["meanings"] as $meaning) {
			$lessonHTML .= "<span class='answer good' >".$meaning."</span>"; 
		}
		$fiveWrongIndices = array_rand($myQuestions[0]["wrongMeanings"],5);
		foreach ($fiveWrongIndices as $index) {
			$lessonHTML .= "<span class='answer bad' >".$myQuestions[0]["wrongMeanings"][$index]."</span>"; 
		}
		$lessonHTML .= "</div><button id='nextButton' onclick='putQuestion(myGlob[1])'>Next Question</button></div>";
		$myScript = <<<'EOT'
		function putQuestion( question ) {
			$("#cardName").text(question["card"]["name"]);
			nextQuestion = parseInt($("#cardName").attr("number"))+1;
			$("#cardName").attr("number", nextQuestion);
			$("#imgFrame img").attr("src","./img/"+question["card"]["image"]);
			$("#answerFrame span").remove();
			$.each(question["card"]["meanings"], function( index, value ) {$("#answerFrame").append("<span class='answer good'>"+value+"</span>");});
			$.each(question["wrongMeanings"].slice(0,5), function( index, value ) {$("#answerFrame").append("<span class='answer bad'>"+value+"</span>");});
			$("#nextButton").attr('onclick', 'putQuestion(myGlob['+nextQuestion+'])');
		}
		

EOT;
			
		$lessonHTML .= "<script>var myGlob =".json_encode($myQuestions).";".$myScript."</script>";
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

function testData () { 

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