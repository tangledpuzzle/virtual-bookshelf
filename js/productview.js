/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-09
* Time: 01:51 PM
* To change this template use Tools | Templates.
*/
console.log(json[0]);

var prodview_name, prodview_id, prodview_date, prodview_brief, prodview_description, prodview_publisher, prodview_proddivrow1, prodview_proddivrow2, prodview_title, prodean, prodview_proddivrow0, language, languagediv, prodview_proddivtitle, prodview_datetitle, prodview_publishertitle, prodeantitle, languagedivtitle, ihmediv, titlerow, button1, button2, buttonit, hiddendiv, hvdiv;





	hiddendiv = document.createElement("div");
	hiddendiv.id = "product_iddiv";
	hiddendiv.style.display= "none";
	hiddendiv.innerHTML = json[0].ProductID;


	hvdiv = document.createElement("div");
	hvdiv.className = "col-md-8";
	titlerow = document.createElement("div");
	titlerow.className="row";
	prodview_title = document.createElement("h1");
	prodview_title.innerHTML = json[0].Name + " <small> [" + json[0].ProductID + "] </small>";
	hvdiv.appendChild(prodview_title);
	titlerow.appendChild(hvdiv);
	buttonit = document.createElement("div");
	buttonit.className = "col-md-4 buttonit";
	button1 = document.createElement("button");
	button2 = document.createElement("button");
	button1.id = "button1";
	button1.className = "btn-lg btn-primary pull-right";
	button2.className = "btn-lg btn-success pull-right";
	button1.innerHTML = "Add to collection";
	button2.innerHTML = "Review";
	buttonit.appendChild(button1);
	buttonit.appendChild(button2);
	titlerow.appendChild(buttonit);


	button1.onclick = function() {	
	var idstring = document.getElementById("product_iddiv").innerHTML;
		alert("Add " + idstring );
	};

	button2.onclick = function() {	
	var idstring = document.getElementById("product_iddiv").innerHTML;
		alert("Review " + idstring );
	};

	
document.getElementById("productview").appendChild(titlerow);
document.getElementById("productview").appendChild(hiddendiv);


	prodview_proddivtitle = document.createElement("div");
	prodview_proddivtitle.id = "product-title";
	prodview_proddivtitle.className = "row";

	prodview_datetitle = document.createElement("div");
	prodview_datetitle.innerHTML = "Julkaisupäivä";
	prodview_datetitle.className = "col-md-3";
	prodview_proddivtitle.appendChild(prodview_datetitle);

	prodview_publishertitle = document.createElement("div");
	prodview_publishertitle.innerHTML = "Julkaisija";
	prodview_publishertitle.className = "col-md-3";
	prodview_proddivtitle.appendChild(prodview_publishertitle);

	prodeantitle = document.createElement("div");
	prodeantitle.innerHTML = "EAN";
	prodeantitle.className = "col-md-4";
	prodview_proddivtitle.appendChild(prodeantitle);

	languagedivtitle = document.createElement("div");
	languagedivtitle.innerHTML = "Kieli";
	languagedivtitle.className = "col-md-2";
	prodview_proddivtitle.appendChild(languagedivtitle);


	prodview_proddivrow0 = document.createElement("div");
	prodview_proddivrow0.id = "product-title";
	prodview_proddivrow0.className = "row";

	prodview_date = document.createElement("div");
	prodview_date.innerHTML = json[0].ReleaseDate;
	prodview_date.className = "col-md-3";
	prodview_proddivrow0.appendChild(prodview_date);

	prodview_publisher = document.createElement("div");
	prodview_publisher.innerHTML = json[0].PublisherName;
	prodview_publisher.className = "col-md-3";
	prodview_proddivrow0.appendChild(prodview_publisher);

	prodean = document.createElement("div");
	prodean.innerHTML = json[0].EAN13;
	prodean.className = "col-md-4";
	prodview_proddivrow0.appendChild(prodean);

	languagediv = document.createElement("div");
	languagediv.innerHTML = json[0].LanguageName;
	languagediv.className = "col-md-2";
	prodview_proddivrow0.appendChild(languagediv);


	ihmediv = document.createElement("div");
	ihmediv.className = "row";
	ihmediv.appendChild(prodview_proddivtitle);
	ihmediv.appendChild(prodview_proddivrow0);



	prodview_proddivrow1 = document.createElement("div");
	prodview_proddivrow1.id = "product-div";
	prodview_proddivrow1.className = "row";

	prodview_brief = document.createElement("div");
	prodview_brief.innerHTML = json[0].Brief;
	prodview_brief.className = "col-md-12";
	prodview_proddivrow1.appendChild(prodview_brief);

	
	prodview_proddivrow2 = document.createElement("div");
	prodview_proddivrow2.id = "product-div";
	prodview_proddivrow2.className = "row";

	prodview_proddescription = document.createElement("div");
	prodview_proddescription.innerHTML = json[0].Description;
	prodview_proddescription.className = "col-md-12";
	prodview_proddivrow2.appendChild(prodview_proddescription);



document.getElementById("productview").appendChild(ihmediv);
document.getElementById("productview").appendChild(prodview_proddivrow1);
document.getElementById("productview").appendChild(prodview_proddivrow2);