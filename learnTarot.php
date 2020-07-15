
<?php

include "user.php";
include "header.php";
include "lesson.php";
include "footer.php";
include "displayPage.php";
include "evaluate.php";

$myPage = ""; 
$myPage .= Load_Header();
$myPage .= Load_UserArea();

$myCards = new CardSet();

$myLessonType = "intro";
$myLesson = new IntroLesson($myCards);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$myPage .= "<div id='answerPostFrame'><h1>Answer</h1>".Answer_Evaluator($_POST)."</div>";
}
if (isset($_GET["lesson"])) {
	$myLessonType = $_GET["lesson"];
}
if ($myLessonType == "choose_meanings") {
	$myLesson = new PracticeLesson($myCards);
}
if ($myLessonType == "master") {
	$myLesson = new MasterLesson($myCards);
}

$myPage .= $myLesson->getLessonHTML();
$myPage .= Load_Footer();
Display_Page($myPage);

?>
