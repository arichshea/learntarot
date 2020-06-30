<?php

function Answer_Evaluator ( $post_array ) {
	$myHTML = "<table><tr><td>Answer Table";
	$myHTML .= implode("</td></tr><tr></td>", $post_array);
	$myHTML .= "</td></tr></table>";
	console.log($myHTML);
	return $myHTML;
}








?>