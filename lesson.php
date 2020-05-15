<?php


function Load_Lesson() {
	$myLesson = "";
	//get lesson
	if (isset($_GET["lesson"])) {
		$myLesson = $_GET["lesson"];
	} 
	
	if ($myLesson = "") {
		$myLesson = "intro";
	}
	
	//load specific lesson 
	//$myCards = get_cards($myLesson);
	//$myQuestions = get_questions($myCards);
	//$lessonHTML = get_lessonHTML($myQuestions);
	//return $lessonHTML;

	$test = testData();
	$lessonHTML = "";
	foreach ($test as $card) {
		$lessonHTML .= "<div id='lessonFrame'><h2>".$card["name"]."</h2>
				<div id='imgFrame'><img src='./img/".$card["image"]."' /></div>
				<div id='answerFrame'>";
		foreach ($card["meanings"] as $meaning) {
			$lessonHTML .= "<span class='answer' >".$meaning."</span>"; 
		}
		$lessonHTML .= "</div></div>";
	}
	
	return "<div id='lessonFrame'>
				<div id='imgFrame'><img src='./img/ar08.jpg' /></div>
				<div id='answerFrame'>
				<span class='answer' >inner strength</span>
				<span class='answer' >bravery</span>
				<span class='answer' >compassion</span>
				<span class='answer' >focus</span>
				</div>
				</div>";
	//check level based on cookie 
	//var Level = check_Level()
	//display corresponding lesson
	//display_Lesson(Level);
	//a lesson is all the cards in a level
	//Any way you cut it, a lesson is an algorithm, generated from the data.
	//load the cards with php and run the lessons with javascript and ajax?
}


?>