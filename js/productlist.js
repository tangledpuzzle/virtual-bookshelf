"use strict";

var console, document, i, prodlist_productdivrow1, prodlist_productnamespan, prodlist_productidspan, prodlist_productdivrow2, prodlist_productdiv , sectionHead, sectionBody, prodlist_productname, prodlist_productid, prodlist_publisher, prodlist_year, prodlist_productbrief;

for(var product in json){
	
	
	prodlist_productdiv = document.createElement("div");
	prodlist_productdiv.id = "product-div";
	prodlist_productdiv.className = "row";
	
	prodlist_productdiv.onclick = function() {
	
		console.log("tekstiä");
	var idstring = this.childNodes[0].childNodes[0].childNodes[1].innerHTML;
	idstring = idstring.substring(2); 
	idstring = idstring.split("").reverse().join("");
	idstring = idstring.substring(1);
	idstring = idstring.split("").reverse().join("");
		console.log(idstring);
		alert("Open " + idstring + " page.");
	};
	
	
	prodlist_productdivrow1 = document.createElement("div");
	prodlist_productdivrow1.className = "row";
	
	
	
	
	prodlist_productname = document.createElement("div");
	prodlist_productnamespan = document.createElement("span");
	prodlist_productnamespan.id="product-name";
	prodlist_productnamespan.innerHTML = json[product].Name;
	prodlist_productname.appendChild(prodlist_productnamespan);
	
	prodlist_productidspan = document.createElement("span");
	prodlist_productidspan.id="productid";
	prodlist_productidspan.innerHTML = " [" + json[product].ProductID + "]";
	prodlist_productname.appendChild(prodlist_productidspan);
	
	prodlist_productname.className = "col-md-4";
	prodlist_productdivrow1.appendChild(prodlist_productname);
	
	
	prodlist_productid = document.createElement("div");
	
	prodlist_productid.className = "col-md-1";
	prodlist_productdivrow1.appendChild(prodlist_productid);
	
	
	prodlist_year = document.createElement("div");
	prodlist_year.innerHTML = json[product].ReleaseDate;
	prodlist_year.className = "col-md-2";
	prodlist_productdivrow1.appendChild(prodlist_year);
	
	
	prodlist_publisher = document.createElement("div");
	prodlist_publisher.innerHTML = json[product].PublisherName;
	prodlist_publisher.className = "col-md-2";
	prodlist_productdivrow1.appendChild(prodlist_publisher);
	
	
	prodlist_productdivrow2 = document.createElement("div");
	prodlist_productdivrow2.className = "row";
	
	
	prodlist_productbrief = document.createElement("div");
	prodlist_productbrief.innerHTML = json[product].Brief;
	prodlist_productbrief.className = "col-md-12";
	prodlist_productdivrow2.appendChild(prodlist_productbrief);
	
	
	prodlist_productdiv.appendChild(prodlist_productdivrow1);
	prodlist_productdiv.appendChild(prodlist_productdivrow2);
	
	
	document.getElementById("productlist").appendChild(prodlist_productdiv);
}
