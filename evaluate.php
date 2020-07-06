<?php

function Answer_Evaluator ( $post_array ) {
	$myHTML = "<pre>".http_build_query($post_array)."</pre>";
	return $myHTML;
}








?>