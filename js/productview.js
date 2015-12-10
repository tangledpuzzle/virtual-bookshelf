/**
* Created with webprojekti.
* User: ME-varjoil
* Date: 2015-12-09
* Time: 01:51 PM
* To change this template use Tools | Templates.
*/
console.log(json[0]);

var prodview_name, prodview_id, prodview_date, prodview_brief, prodview_description, prodview_publisher, prodview_proddivrow1, prodview_proddivrow2, prodview_title;




	prodview_title = document.createElement("h1");
	prodview_title.innerHTML = json[0].Name;
	
	
document.getElementById("productview").appendChild(prodview_title);


	prodview_proddivrow1 = document.createElement("div");
	prodview_proddivrow1.id = "product-div";
	prodview_proddivrow1.className = "row";

	prodview_id = document.createElement("div");
	prodview_id.innerHTML = json[0].ProductID;
	prodview_id.className = "col-md-1";
	prodview_proddivrow1.appendChild(prodview_id);

	prodview_brief = document.createElement("div");
	prodview_brief.innerHTML = json[0].Brief;
	prodview_brief.className = "col-md-8";
	prodview_proddivrow1.appendChild(prodview_brief);

	prodview_date = document.createElement("div");
	prodview_date.innerHTML = json[0].ReleaseDate;
	prodview_date.className = "col-md-2";
	prodview_proddivrow1.appendChild(prodview_date);

	prodview_publisher = document.createElement("div");
	prodview_publisher.innerHTML = json[0].PublisherID;
	prodview_publisher.className = "col-md-1";
	prodview_proddivrow1.appendChild(prodview_publisher);

	
	prodview_proddivrow2 = document.createElement("div");
	prodview_proddivrow2.id = "product-div";
	prodview_proddivrow2.className = "row";


	prodview_proddescription = document.createElement("div");
	prodview_proddescription.innerHTML = json[0].Description;
	prodview_proddescription.className = "col-md-12";
	prodview_proddivrow2.appendChild(prodview_proddescription);


document.getElementById("productview").appendChild(prodview_proddivrow1);
document.getElementById("productview").appendChild(prodview_proddivrow2);