/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-11
* Time: 09:37 AM
* To change this template use Tools | Templates.
*/
"use strict";

var console, document, i, userlist_userdivrow1, userlist_usernamespan, userlist_useridspan, userlist_userdivrow2, userlist_userdiv , sectionHead, sectionBody, userlist_username,
	userlist_userid, userlist_country, userlist_year, userlist_userbrief, userage,
	thead, tbody, ihmediv, userlist_userdivrow0, userlist_userdivtitle,
	userlist_name, userlist_countrytitle, useragetitle, genderdivtitle, userlist_datetitle, userlist_id, userlist_usergender;



	ihmediv = document.createElement("table");
	ihmediv.className = "table last-content-element";
	thead = document.createElement("thead");
	userlist_userdivtitle = document.createElement("tr");
	thead.appendChild(userlist_userdivtitle);

	
	userlist_id = document.createElement("th");
	userlist_id.innerHTML = "User ID";
	userlist_id.className = "col-md-1";
	userlist_userdivtitle.appendChild(userlist_id);


	userlist_name = document.createElement("th");
	userlist_name.innerHTML = "Screen Name";
	userlist_name.className = "col-md-7";
	userlist_userdivtitle.appendChild(userlist_name);

	userlist_countrytitle = document.createElement("th");
	userlist_countrytitle.innerHTML = "Country";
	userlist_countrytitle.className = "col-md-1";
	userlist_userdivtitle.appendChild(userlist_countrytitle);

	useragetitle = document.createElement("th");
	useragetitle.innerHTML = "Age";
	useragetitle.className = "col-md-1";
	userlist_userdivtitle.appendChild(useragetitle);

	genderdivtitle = document.createElement("th");
	genderdivtitle.innerHTML = "Gender";
	genderdivtitle.className = "col-md-1";
	userlist_userdivtitle.appendChild(genderdivtitle);

	userlist_datetitle = document.createElement("th");
	userlist_datetitle.innerHTML = "Join Date";
	userlist_datetitle.className = "col-md-1";
	userlist_userdivtitle.appendChild(userlist_datetitle);

	ihmediv.appendChild(thead);



	tbody = document.createElement("tbody");
	ihmediv.appendChild(tbody);


for(var user in json){
	
	
	userlist_userdivrow1 = document.createElement("tr");
	
	
	userlist_userdivrow1.onclick = function() {	
	var idstring = this.childNodes[0].innerHTML;
		alert("Open " + idstring + " page.");
	};

		
	userlist_useridspan = document.createElement("td");
	userlist_useridspan.innerHTML =  json[user].user_id;
	userlist_userdivrow1.appendChild(userlist_useridspan);
	
	
	userlist_username = document.createElement("td");
	userlist_username.innerHTML = json[user].ScreenName;
	userlist_userdivrow1.appendChild(userlist_username);
	
	
	userlist_country = document.createElement("td");
	userlist_country.innerHTML = json[user].CountryName;
	userlist_userdivrow1.appendChild(userlist_country);
	
	
	userage = document.createElement("td");
	userage.innerHTML = json[user].Age;
	userlist_userdivrow1.appendChild(userage);
	
	
	userlist_usergender = document.createElement("td");
	userlist_usergender.innerHTML =  json[user].GenderName;
	userlist_userdivrow1.appendChild(userlist_usergender);
	
	
	userlist_year = document.createElement("td");
	userlist_year.innerHTML = json[user].user_date;
	userlist_userdivrow1.appendChild(userlist_year);
	
	
	tbody.appendChild(userlist_userdivrow1);
}

	document.getElementById("userlist").appendChild(ihmediv);



