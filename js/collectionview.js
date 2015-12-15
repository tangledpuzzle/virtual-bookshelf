/**
 * Created with webprojekti.
 * User: ME-varjoil
 * Date: 2015-12-14
 * Time: 09:25 AM
 * To change this template use Tools | Templates.
 */

function createCollectionView() {
    "use strict";
    var collection;
    // Is the global json array not undefined?
    if(typeof collection_json !== 'undefined') {
        // Copy the data to the local variable.
        collection = collection_json;
    } else {
        // Get the data from sessionStorage.
        collection = JSON.parse(sessionStorage.getItem('collection_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('collection_json');
    }
    console.log(collection[obj]);
    var title = document.createElement("h1");
    title.className = "first-content-element";
    title.innerHTML = collection.CollectionName;
    document.getElementById("collectionview").appendChild(title);
    var collection_id = document.createElement("div");
    collection_id.className = "hidden";
    collection_id.innerHTML = collection.CollectionID;
    document.getElementById("collectionview").appendChild(collection_id);
    var table = document.createElement("table");
    table.className = "table sortable last-content-element";
    document.getElementById("collectionview").appendChild(table);
    var thead = document.createElement("thead");
    table.appendChild(thead);
    var tr = document.createElement("tr");
    thead.appendChild(tr);
    var book_id = document.createElement("th");
    book_id.className = "hidden";
    book_id.innerHTML = "Book ID";
    tr.appendChild(book_id);
    var book_name = document.createElement("th");
    book_name.innerHTML = "Book Name";
    tr.appendChild(book_name);
    var publisher = document.createElement("th");
    publisher.innerHTML = "Publisher";
    tr.appendChild(publisher);
    var release_date = document.createElement("th");
    release_date.innerHTML = "Release Date";
    tr.appendChild(release_date);
    var tbody = document.createElement("tbody");
    table.appendChild(tbody);
    for(var obj in collection.Products) {
        console.log(collection.Products[obj].Name);
        tr = document.createElement("tr");
        tr.className = "table-row-link";
        tr.onclick = function () {
            window.location.href = "../collectionview/" + this.childNodes[0].innerHTML;
        };
        book_id = document.createElement("td");
        book_id.className = "hidden";
        book_id.innerHTML = collection.Products[obj].ProductID;
        tr.appendChild(book_id);
        book_name = document.createElement("td");
        book_name.innerHTML = collection.Products[obj].Name;
        tr.appendChild(book_name);
        publisher = document.createElement("td");
        publisher.innerHTML = collection.Products[obj].Publisher;
        tr.appendChild(publisher);
        release_date = document.createElement("td");
        release_date.innerHTML = collection.Products[obj].ReleaseDate;
        tr.appendChild(release_date);
        tbody.appendChild(tr);
    }
}