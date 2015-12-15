/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-11
* Time: 01:42 PM
* To change this template use Tools | Templates.
* CommentID, PostDate, UserID, Text
*/


var commentdiv, usera, datediv, maindiv, userdiv, infodiv;


for(var comment in json){

	
	usera = document.createElement("a");
	userdiv = document.createElement("div");
	infodiv = document.createElement("div");
	maindiv = document.createElement("div");
	commentdiv = document.createElement("div");
	datediv = document.createElement("div");
	
	
	usera.href="./userview/"+ json[comment].user_id;
	usera.innerHTML = json[comment].ScreenName;
	userdiv.className = "col-md-3";
	userdiv.appendChild(usera);
	infodiv.className = "row";
	infodiv.appendChild(userdiv);
	
	datediv.innerHTML = json[comment].PostDate;
	datediv.className = "row";
	infodiv.appendChild(datediv);
	maindiv.appendChild(infodiv);
	
	
	commentdiv.innerHTML = json[comment].Text;
	commentdiv.className = "col-md-6";
	maindiv.appendChild(commentdiv);
	document.getElementById("commentlist").appendChild(maindiv);
	
	
}
