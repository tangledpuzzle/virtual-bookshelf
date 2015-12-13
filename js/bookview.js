/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-09
* Time: 01:51 PM
* To change this template use Tools | Templates.
*/
function createBookView()
{
	"use strict";
	
	var book;
	
	// Is the global json array not undefined?
	if (typeof book_json !== 'undefined')
	{
		// Copy the data to the local variable.
    	book = book_json;
	}
	else
	{
		// Get the data from sessionStorage.
		book = JSON.parse(sessionStorage.getItem('book_json'));
		// Remove the item from storage as it is no longer needed.
		sessionStorage.removeItem('book_json');
	}

var prodview_name, prodview_id, prodview_date, prodview_brief, prodview_description, prodview_proddescription, prodview_publisher, prodview_proddivrow1, prodview_proddivrow2, prodview_title, prodean, prodview_proddivrow0, language, languagediv, prodview_proddivtitle, prodview_datetitle, prodview_publishertitle, prodeantitle, languagedivtitle, ihmediv, titlerow, button1, button2, buttonit, hiddendiv, hvdiv, thead, tbody;





	hiddendiv = document.createElement("div");
	hiddendiv.id = "product_iddiv";
	hiddendiv.style.display= "none";
	hiddendiv.innerHTML = book.ProductID;


	hvdiv = document.createElement("div");
	hvdiv.className = "col-md-8";
	titlerow = document.createElement("div");
	titlerow.className="row";
	prodview_title = document.createElement("h1");
	prodview_title.innerHTML = book.Name + " <small> [" + book.ProductID + "] </small>";
	hvdiv.appendChild(prodview_title);
	titlerow.appendChild(hvdiv);
	buttonit = document.createElement("div");
	buttonit.className = "col-md-4 buttonit";
	button1 = document.createElement("button");
	button2 = document.createElement("button");
	button1.className = "btn-lg btn-primary pull-right";
	button2.className = "btn-lg btn-success pull-right";
	button1.innerHTML = "Add to collection";
	button2.innerHTML = "Review";
	buttonit.appendChild(button2);
	buttonit.appendChild(button1);
	titlerow.appendChild(buttonit);


	button1.onclick = function() {	
	var idstring = document.getElementById("product_iddiv").innerHTML;
		alert("Add " + idstring );
	};

	button2.onclick = function() {
		window.location.href="../writereview/" + document.getElementById("product_iddiv").innerHTML;
	};

	
document.getElementById("productview").appendChild(titlerow);
document.getElementById("productview").appendChild(hiddendiv);


	prodview_proddivtitle = document.createElement("tr");

	prodview_datetitle = document.createElement("th");
	prodview_datetitle.innerHTML = "Julkaisupäivä";
	prodview_datetitle.className = "col-md-3";
	prodview_proddivtitle.appendChild(prodview_datetitle);

	prodview_publishertitle = document.createElement("th");
	prodview_publishertitle.innerHTML = "Julkaisija";
	prodview_publishertitle.className = "col-md-3";
	prodview_proddivtitle.appendChild(prodview_publishertitle);

	prodeantitle = document.createElement("th");
	prodeantitle.innerHTML = "EAN";
	prodeantitle.className = "col-md-4";
	prodview_proddivtitle.appendChild(prodeantitle);

	languagedivtitle = document.createElement("th");
	languagedivtitle.innerHTML = "Kieli";
	languagedivtitle.className = "col-md-2";
	prodview_proddivtitle.appendChild(languagedivtitle);


	prodview_proddivrow0 = document.createElement("tr");

	prodview_date = document.createElement("td");
	prodview_date.innerHTML = book.ReleaseDate;
	prodview_date.className = "col-md-3";
	prodview_proddivrow0.appendChild(prodview_date);

	prodview_publisher = document.createElement("td");
	prodview_publisher.innerHTML = book.PublisherName;
	prodview_publisher.className = "col-md-3";
	prodview_proddivrow0.appendChild(prodview_publisher);

	prodean = document.createElement("td");
	prodean.innerHTML = book.EAN13;
	prodean.className = "col-md-4";
	prodview_proddivrow0.appendChild(prodean);

	languagediv = document.createElement("td");
	languagediv.innerHTML = book.LanguageName;
	languagediv.className = "col-md-2";
	prodview_proddivrow0.appendChild(languagediv);


	thead = document.createElement("thead");
	thead.appendChild(prodview_proddivtitle);

	tbody = document.createElement("tbody");
	tbody.appendChild(prodview_proddivrow0);


	ihmediv = document.createElement("table");
	ihmediv.className = "table";
	ihmediv.appendChild(thead);
	ihmediv.appendChild(tbody);


	prodview_proddivrow1 = document.createElement("div");
	prodview_proddivrow1.id = "product-div";
	prodview_proddivrow1.className = "row";

	prodview_brief = document.createElement("div");
	prodview_brief.innerHTML = book.Brief;
	prodview_brief.className = "col-md-12";
	prodview_proddivrow1.appendChild(prodview_brief);

	
	prodview_proddivrow2 = document.createElement("div");
	prodview_proddivrow2.id = "product-div";
	prodview_proddivrow2.className = "row";

	prodview_proddescription = document.createElement("div");
	prodview_proddescription.innerHTML = book.Description;
	prodview_proddescription.className = "col-md-12";
	prodview_proddivrow2.appendChild(prodview_proddescription);



document.getElementById("productview").appendChild(ihmediv);
document.getElementById("productview").appendChild(prodview_proddivrow1);
document.getElementById("productview").appendChild(prodview_proddivrow2);
}