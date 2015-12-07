
"use strict";
var console, document, i, productdiv, title, sectionHead, sectionBody, productlist_productname, productlist_productid, productlist_publisher, productlist_year, productlist_productbrief;

console.log(json);

var data = JSON.parse(json);
console.log(data);

for(var product in data ){
	console.log(data[product]);
	productdiv = document.createElement("div");
	productdiv.style.display = "block";
	//productdiv.style.width = "500%";
	productdiv.onclick = function() {
		var p = document.querySelector("p");
		if (!p) {
			p = document.createElement("p");
			var div = document.createElement("div");
			div.appendChild(p);
			document.body.insertBefore(div, document.body.firstChild);
		}
		p.innerHTML = this.childNodes[0].innerHTML;

	};
	
	productlist_productname = document.createElement("div");
	productlist_productname.innerHTML = data[product].Name;
	productdiv.appendChild(productlist_productname);
	productlist_productid = document.createElement("div");
	productlist_productid.innerHTML = data[product].ProductID;
	productdiv.appendChild(productlist_productid);
	productlist_productbrief = document.createElement("div");
	productlist_productbrief.innerHTML = data[product].Description;
	productdiv.appendChild(productlist_productbrief);
	productlist_year = document.createElement("div");
	productlist_year.innerHTML = data[product].Name;
	productdiv.appendChild(productlist_year);
	productlist_publisher = document.createElement("div");
	productlist_publisher.innerHTML = data[product].PublisherName;
	productdiv.appendChild(productlist_publisher);
	
	document.getElementById("productlist").appendChild(productdiv);
}
