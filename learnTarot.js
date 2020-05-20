function putQuestion2( question ) {
	updateScore();
	$("#cardName").text(question["card"]["name"]);
	nextQuestion = parseInt($("#cardName").attr("number"))+1;
	$("#cardName").attr("number", nextQuestion);
	$("#imgFrame img").attr("src","./img/"+question["card"]["image"]);
	$("#answerFrame span").remove();
	$.each(question["card"]["meanings"], function( index, value ) {$("#answerFrame").append("<span class='answer good' onclick='$(this).addClass(\"clicked\");'>"+value+"</span>");});
	$.each(question["wrongMeanings"].slice(0,5), function( index, value ) {$("#answerFrame").append("<span class='answer bad' onclick='$(this).addClass(\"clicked\")';>"+value+"</span>");});
	$("#nextButton").attr('onclick', 'putQuestion2(myGlob['+nextQuestion+'])');
}

function putQuestion1( question ) {
	updateScore();
	$("#cardName").text(question["card"]["name"]);
	nextQuestion = parseInt($("#cardName").attr("number"))+1;
	$("#cardName").attr("number", nextQuestion);
	$("#imgFrame img").attr("src","./img/"+question["card"]["image"]);
	$("#answerFrame span").remove();
	$.each(question["card"]["meanings"], function( index, value ) {$("#answerFrame").append("<span class='answer good' onclick='$(this).addClass(\"clicked\");'>"+value+"</span>");});
	$("#nextButton").attr('onclick', 'putQuestion1(myGlob['+nextQuestion+'])');
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