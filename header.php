<?php

function Load_Header() {
	return <<<'EOT'
	<html>
		<head>
			<title>Tarot Card Learner</title>
			<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
			<script src='./learnTarot.js'></script>
			<link rel="stylesheet" type="text/css" href="learnTarot.css">
		</head>
		<body>
		<div id='navigationFrame'><ul>
			<li><a href='?lesson=intro'>Intro Lesson</a></li>
			<li><a href='?lesson=choose_meanings'>Advanced Lesson</a></li>
			<li><a href='?lesson=master'>Master Lesson</a></li></ul>
		</div>
EOT;

}

?>