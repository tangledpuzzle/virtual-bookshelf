/**
 * User: ME-varjoil
 */

function createBookList() {
    "use strict";
    var books;
    // Is the global json array not undefined?
    if(typeof books_json !== 'undefined') {
        // Copy the data to the local variable.
        books = books_json;
    } else {
        // Get the data from sessionStorage.
        books = JSON.parse(sessionStorage.getItem('books_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('books_json');
    }
    var i, prodlist_productdivrow1, prodlist_productnamespan, prodlist_productidspan, prodlist_productdivrow2, prodlist_productdiv, sectionHead, sectionBody, prodlist_productname, prodlist_productid, prodlist_publisher, prodlist_year, prodlist_productbrief, prodean;
    for(var product in books) {
        prodlist_productdiv = document.createElement("a");
        prodlist_productdiv.className = "list-group-item";
        prodlist_productdiv.href = "./bookview/" + books[product].ProductID;
        prodlist_productdivrow1 = document.createElement("div");
        prodlist_productdivrow1.className = "row";
        prodlist_productname = document.createElement("div");
        prodlist_productnamespan = document.createElement("span");
        prodlist_productnamespan.id = "product-name";
        prodlist_productnamespan.innerHTML = books[product].Name;
        prodlist_productname.appendChild(prodlist_productnamespan);
        prodlist_productidspan = document.createElement("span");
        prodlist_productidspan.id = "productid";
        prodlist_productidspan.innerHTML = " [" + books[product].ProductID + "]";
        prodlist_productname.appendChild(prodlist_productidspan);
        prodlist_productname.className = "col-md-3";
        prodlist_productdivrow1.appendChild(prodlist_productname);
        prodlist_year = document.createElement("div");
        prodlist_year.innerHTML = books[product].ReleaseDate;
        prodlist_year.className = "col-md-2";
        prodlist_productdivrow1.appendChild(prodlist_year);
        prodlist_publisher = document.createElement("div");
        prodlist_publisher.innerHTML = books[product].PublisherName;
        prodlist_publisher.className = "col-md-2";
        prodlist_productdivrow1.appendChild(prodlist_publisher);
        prodean = document.createElement("div");
        prodean.innerHTML = books[product].EAN13;
        prodean.className = "col-md-1";
        prodlist_productdivrow1.appendChild(prodean);
        prodlist_productdivrow2 = document.createElement("div");
        prodlist_productdivrow2.className = "row";
        prodlist_productbrief = document.createElement("div");
        prodlist_productbrief.innerHTML = books[product].Brief;
        prodlist_productbrief.className = "col-md-12";
        prodlist_productdivrow2.appendChild(prodlist_productbrief);
        prodlist_productdiv.appendChild(prodlist_productdivrow1);
        prodlist_productdiv.appendChild(prodlist_productdivrow2);
        document.getElementById("productlist").appendChild(prodlist_productdiv);
    }
}