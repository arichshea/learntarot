

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

function putQuestion ( question ) {
	updateScore();
	$("#cardName").text(question["card"]["name"]);
	nextQuestion = parseInt($("#cardName").attr("number"))+1;
	$("#cardName").attr("number", nextQuestion);
	$("#imgFrame img").attr("src","./img/"+question["card"]["imgLocation"]);
	$("#answerFrame span").remove();
	newAnswers = [];
	$.each(question["card"]["upMeanings"], function( index, value ) {newAnswers.push("<span class='answer good' onclick='$(this).addClass(\"clicked\");'>"+value+"</span>");});
	if ( typeof question["wrongMeanings"] !== 'undefined' ) {
		$.each(question["wrongMeanings"].slice(0,5), function( index, value ) {newAnswers.push("<span class='answer bad' onclick='$(this).addClass(\"clicked\")';>"+value+"</span>");});
	}
	shuffle(newAnswers);
	$.each(newAnswers, function( index, value ) {
		$("#answerFrame").append(value);
	});
	
	nextScript = "";
	if (typeof myGlob[nextQuestion] !== 'undefined') {
		nextScript = 'putQuestion(myGlob['+nextQuestion+'])';
	} else {
		nextScript = 'evaluateLesson()';
	}
	$("#nextButton").attr('onclick', nextScript);
}

function updateScore( score ) {
	var goodTotal = $(".answer.good").length;
	var goodClicked = $(".answer.good.clicked").length;
	var badTotal = $(".answer.bad").length;
	var badClicked = $(".answer.bad.clicked").length;
	var numCorrect = goodClicked + badTotal - badClicked;
	var numWrong = badClicked + goodTotal - goodClicked;
	var Total = goodTotal + badTotal;
	$("#scoreCorrect").text(parseInt($("#scoreCorrect").text())+numCorrect); 
	$("#scoreWrong").text(parseInt($("#scoreWrong").text())+numWrong); 
	$("#scoreTotal").text(parseInt($("#scoreTotal").text())+Total);
}

function evaluateLesson() {

 alert('lesson over! Check your score');	
}

function findDuplicates() {
	myMeanings = [];
	$.each(myGlob, function( index, question ) {
		$.each(question["card"]["meanings"], function( index, value ) {
			myMeanings.push(value);
		});
	});
	myDuplicates = [];
	$.each(myMeanings, function( index, value ) {
		$.each(myMeanings, function(index2, value2) {
			if (value == value2 && index !== index2 && !myDuplicates.includes(value)) {
				myDuplicates.push(value);
			}
		});
	});
	$.each(myDuplicates, function (index, value) {console.log(value);});
}