/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-11
* Time: 09:37 AM
* To change this template use Tools | Templates.
*/
console.log(json[0]);

var userview_name, userview_id, userview_date, userview_brief, userview_description, userview_country, userage, language, genderdiv, thead, tbody, fullname,
	hiddendiv, userview_userdivrow1, userview_userdivrow2, ihmediv, userview_userdivrow0,
	hvdiv, titlerow, userview_userdivtitle, userview_datetitle, userview_countrytitle, useragetitle, genderdivtitle, userview_title;





	hiddendiv = document.createElement("div");
	hiddendiv.id = "user_iddiv";
	hiddendiv.style.display= "none";
	hiddendiv.innerHTML = json[0].UserID;


	hvdiv = document.createElement("div");
	hvdiv.className = "col-md-8";
	titlerow = document.createElement("div");
	titlerow.className="row";
	userview_title = document.createElement("h1");
	userview_title.innerHTML = json[0].ScreenName + " <small> [" + json[0].UserID + "] </small>";
	hvdiv.appendChild(userview_title);
	titlerow.appendChild(hvdiv);

	
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
	fullname.innerHTML = json[0].FirstName + json[0].LastName;
	fullname.className = "col-md-4";
	userview_userdivrow0.appendChild(fullname);

	userview_country = document.createElement("td");
	userview_country.innerHTML = json[0].CountryName;
	userview_country.className = "col-md-3";
	userview_userdivrow0.appendChild(userview_country);

	userage = document.createElement("td");
	userage.innerHTML = json[0].Age;
	userage.className = "col-md-1";
	userview_userdivrow0.appendChild(userage);

	genderdiv = document.createElement("td");
	genderdiv.innerHTML = json[0].GenderName;
	genderdiv.className = "col-md-1";
	userview_userdivrow0.appendChild(genderdiv);

	userview_date = document.createElement("td");
	userview_date.innerHTML = json[0].RegistrationDate;
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
	userview_brief.innerHTML = json[0].Bio;
	userview_brief.className = "col-md-12";
	userview_userdivrow1.appendChild(userview_brief);




document.getElementById("userview").appendChild(ihmediv);
document.getElementById("userview").appendChild(userview_userdivrow1);
