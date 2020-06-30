
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
if (isset($_POST[0])) {
	$myPage .= Answer_Evaluator($_POST);
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
