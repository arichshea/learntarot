<?php

function Load_Header() {
	return "<html>
		<head>
		<title>Tarot Card Learner</title>
		<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
		<style>
			
			#lessonFrame img {
			  max-height: 75vh;
			}

			.answer {
			  border: black 1px solid;
			  margin:10px;
			  padding:10px;
			}
			
			.answer.good {
				background-color:rgb(200, 255, 200);
			}
			.answer.bad{
				background-color:rgb(255, 200, 200);
			}
			
			div {
				float:left;
				position: relative;
				display: block;
				margin: 20px;
			}
		
		</style>
		</head>
		<body>";
}

?>