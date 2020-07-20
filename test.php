<?php
include('cards.php');

$myCards = new CardSet([]);
$myList = "";
$count = 0;
foreach($myCards->allCards as $card) {
	$myList .= "\"".$card->name."\",";
	$count++;
}
echo $myList."<br />".$count;

?>