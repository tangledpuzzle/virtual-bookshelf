/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-11
* Time: 01:42 PM
* To change this template use Tools | Templates.
* CommentID, PostDate, UserID, Text
*/
function createCommentList()
{
	
	"use strict";
	
	var comments;
	
	// Is the global json array not undefined?
	if (typeof comments_json !== 'undefined')
	{
		// Copy the data to the local variable.
  	comments = comments_json;
	}
	else
	{
		// Get the data from sessionStorage.
		comments = JSON.parse(sessionStorage.getItem('comments_json'));
		// Remove the item from storage as it is no longer needed.
		sessionStorage.removeItem('users_json');
	}
	
	var commenttitle = document.createElement("h3");
	commenttitle.innerHTML = "Comments";
	document.getElementById("commentlist").appendChild(commenttitle);
	

for(var i = comments.length; i > 0; i--){

	
	var usera = document.createElement("a");
	var userdiv = document.createElement("div");
	var infodiv = document.createElement("div");
	var maindiv = document.createElement("div");
	maindiv.className = "row";
	var commentdiv = document.createElement("div");
	var datediv = document.createElement("div");
	
	
	
	usera.href="./useview/"+ comments[i-1].user_id;
	usera.innerHTML = comments[i-1].ScreenName;
	userdiv.className = "col-md-4";
	userdiv.appendChild(usera);
	infodiv.className = "row";
	infodiv.appendChild(userdiv);
	
	datediv.innerHTML = comments[i-1].PostDate;
	datediv.className = "col-md-2 ";
	infodiv.appendChild(datediv);
	maindiv.appendChild(infodiv);
	
	commentdiv.innerHTML = comments[i-1].Text;
	commentdiv.className = "col-md-12";
	maindiv.appendChild(commentdiv);
	document.getElementById("commentlist").appendChild(maindiv);
	
	
}
}