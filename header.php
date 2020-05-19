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
EOT;

}

?>