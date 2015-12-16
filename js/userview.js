/**
 * Created with webprojekti.
 * User: ME-varjoil
 * Date: 2015-12-11
 * Time: 09:37 AM
 * To change this template use Tools | Templates.
 */
var user_json;
var sessionStorage;
var document;
var window;

function createUserView(logged_in_user_id, source_page) {
    "use strict";
    var user;
    // Is the global json array not undefined?
    if('undefined' !== typeof user_json) {
        // Copy the data to the local variable.
        user = user_json;
    } else {
        // Get the data from sessionStorage.
        user = JSON.parse(sessionStorage.getItem('user_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('user_json');
    }
    var userview_name, userview_date, userview_brief, userview_country, userage, genderdiv, thead, tbody, fullname,
        hiddendiv, userview_userdivrow1, ihmediv, userview_userdivrow0,
        hvdiv, titlerow, userview_userdivtitle, userview_datetitle, userview_countrytitle, useragetitle, genderdivtitle, userview_title;
    hiddendiv = document.createElement("div");
    hiddendiv.id = "user_iddiv";
    hiddendiv.style.display = "none";
    hiddendiv.innerHTML = user.user_id;
    hvdiv = document.createElement("div");
    if(logged_in_user_id === user.user_id) {
        hvdiv.className = "col-md-10";
    } else {
        hvdiv.className = "col-md-12";
    }
    titlerow = document.createElement("div");
    titlerow.className = "row";
    userview_title = document.createElement("h1");
    userview_title.innerHTML = user.ScreenName + " <small> [" + user.user_id + "] </small>";
    hvdiv.appendChild(userview_title);
    titlerow.appendChild(hvdiv);
    if(logged_in_user_id === user.user_id) {
        var buttondiv = document.createElement("div");
        buttondiv.className = "col-md-2 no-pad-col";
        var button_edit = document.createElement("button");
        button_edit.innerHTML = "Edit Profile";
        buttondiv.appendChild(button_edit);
        button_edit.className = "btn btn-default btn-lg pull-right";
        titlerow.appendChild(buttondiv);
        button_edit.onclick = function() {
			if (source_page === "myprofile"){
				window.location = "profileedit";
			}
           else{
			   window.location = "../profileedit";
		   }
        };
    }
    document.getElementById("userview").appendChild(titlerow);
    document.getElementById("userview").appendChild(hiddendiv);
    userview_userdivtitle = document.createElement("tr");
    userview_name = document.createElement("th");
    userview_name.innerHTML = "Full name";
    userview_name.className = "col-md-4";
    userview_userdivtitle.appendChild(userview_name);
    userview_countrytitle = document.createElement("th");
    userview_countrytitle.innerHTML = "Country";
    userview_countrytitle.className = "col-md-3";
    userview_userdivtitle.appendChild(userview_countrytitle);
    useragetitle = document.createElement("th");
    useragetitle.innerHTML = "Age";
    useragetitle.className = "col-md-1";
    userview_userdivtitle.appendChild(useragetitle);
    genderdivtitle = document.createElement("th");
    genderdivtitle.innerHTML = "Gender";
    genderdivtitle.className = "col-md-1";
    userview_userdivtitle.appendChild(genderdivtitle);
    userview_datetitle = document.createElement("th");
    userview_datetitle.innerHTML = "Join date";
    userview_datetitle.className = "col-md-3";
    userview_userdivtitle.appendChild(userview_datetitle);
    userview_userdivrow0 = document.createElement("tr");
    fullname = document.createElement("td");
	var first = user.FirstName;
	if (first === null)
	{
		first= "";
	}
	var last = user.LastName;
	if (last === null)
	{
		last= "";
	}
	var full = first + " " + last;
    fullname.innerHTML = full.trim();
    fullname.className = "col-md-4";
    userview_userdivrow0.appendChild(fullname);
    userview_country = document.createElement("td");
    userview_country.innerHTML = user.CountryName;
    userview_country.className = "col-md-3";
    userview_userdivrow0.appendChild(userview_country);
    userage = document.createElement("td");
	if (user.Age === 0)
	{
    	userage.innerHTML = "";
	}
	else
	{
		userage.innerHTML = user.Age
	}
    userage.className = "col-md-1";
    userview_userdivrow0.appendChild(userage);
    genderdiv = document.createElement("td");
    genderdiv.innerHTML = user.GenderName;
    genderdiv.className = "col-md-1";
    userview_userdivrow0.appendChild(genderdiv);
    userview_date = document.createElement("td");
    userview_date.innerHTML = user.user_date;
    userview_date.className = "col-md-3";
    userview_userdivrow0.appendChild(userview_date);
    thead = document.createElement("thead");
    thead.appendChild(userview_userdivtitle);
    tbody = document.createElement("tbody");
    tbody.appendChild(userview_userdivrow0);
    ihmediv = document.createElement("table");
    ihmediv.className = "table";
    ihmediv.appendChild(thead);
    ihmediv.appendChild(tbody);
    userview_userdivrow1 = document.createElement("div");
    userview_userdivrow1.id = "user-div";
    userview_userdivrow1.className = "row";
    userview_brief = document.createElement("div");
    userview_brief.innerHTML = user.Bio;
    userview_brief.className = "col-md-12";
    userview_userdivrow1.appendChild(userview_brief);
    document.getElementById("userview").appendChild(ihmediv);
    document.getElementById("userview").appendChild(userview_userdivrow1);
}