<?php

function Load_UserArea() {
	$user = "briarmoss";
	$level = 1;
	if(!isset($_COOKIE["user"])) {
		setcookie("user",$user, 0, "/");
		setcookie("level",$level, 0, "/");
	} else {
		$user = htmlspecialchars($_COOKIE["user"]);
		$level = intval($_COOKIE["level"]);
	}
	$myCookie = [$user,$level];
	
		
	$userHTML = "<div id='userFrame'><input type='text' id='userName' length='10' value='".$myCookie[0]."' />
	<input type='text' id='userLevel' length='10' value='".$myCookie[1]."' />
	<button id='User Update' onclick=\"document.cookie='user='+$('#userName').prop('value')+'; path=/';document.cookie='level='+$('#userLevel').prop('value')+'; path=/';\">Update User</button></div>";
	
	return $userHTML;
	//get user and level from cookie
	//if no cookie, set to guest, set level to intro
	//Add register and login options
	
}

?>
