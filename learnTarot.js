function putQuestion2( question ) {
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
			$("#cardName").text(question["card"]["name"]);
			nextQuestion = parseInt($("#cardName").attr("number"))+1;
			$("#cardName").attr("number", nextQuestion);
			$("#imgFrame img").attr("src","./img/"+question["card"]["image"]);
			$("#answerFrame span").remove();
			$.each(question["card"]["meanings"], function( index, value ) {$("#answerFrame").append("<span class='answer good' onclick='$(this).addClass(\"clicked\");'>"+value+"</span>");});

			$("#nextButton").attr('onclick', 'putQuestion1(myGlob['+nextQuestion+'])');
}