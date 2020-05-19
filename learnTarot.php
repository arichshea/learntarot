
<?php

include "user.php";
include "header.php";
include "lesson.php";
include "footer.php";
include "displayPage.php";

$myPage = ""; 
$myPage .= Load_Header();
$myPage .= Load_UserArea();
$myPage .= Load_Lesson();
$myPage .= Load_Footer();
Display_Page($myPage);

?>
