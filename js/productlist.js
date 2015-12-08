"use strict";

var console, document, i, prodlist_productdiv, title, sectionHead, sectionBody, prodlist_productname, prodlist_productid, prodlist_publisher, prodlist_year, prodlist_productbrief;

for(var product in json){
	console.log(json[product]);
	prodlist_productdiv = document.createElement("div");
	prodlist_productdiv.id = "product-div";
	
	prodlist_productdiv.onclick = function() {
		alert("Open " + this.childNodes[0].innerHTML + " page.")
	};
	
	prodlist_productid = document.createElement("div");
	prodlist_productid.id = "product-id";
	prodlist_productid.innerHTML = json[product].ProductID;
	prodlist_productdiv.appendChild(prodlist_productid);
	
	prodlist_productname = document.createElement("div");
	prodlist_productname.id = "product-name";
	prodlist_productname.innerHTML = json[product].Name;
	prodlist_productdiv.appendChild(prodlist_productname);
	
	prodlist_productbrief = document.createElement("div");
	prodlist_productbrief.id = "product-brief";
	prodlist_productbrief.innerHTML = json[product].Description;
	prodlist_productdiv.appendChild(prodlist_productbrief);
	
	prodlist_year = document.createElement("div");
	prodlist_year.id = "product-year";
	prodlist_year.innerHTML = json[product].Name;
	prodlist_productdiv.appendChild(prodlist_year);
	
	prodlist_publisher = document.createElement("div");
	prodlist_publisher.id = "product-publisher";
	prodlist_publisher.innerHTML = json[product].PublisherName;
	prodlist_productdiv.appendChild(prodlist_publisher);
	
	document.getElementById("productlist").appendChild(prodlist_productdiv);
}
