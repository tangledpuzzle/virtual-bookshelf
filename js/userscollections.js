/**
 * Created with webprojekti.
 * User: ME-varjoil
 * Date: 2015-12-14
 * Time: 03:31 PM
 * To change this template use Tools | Templates.
 */

function createUsersCollections() {
    "use strict";
    var collections;
    // Is the global variable json not undefined?
    if(typeof collections_json !== 'undefined') {
        // Copy the data to the local variable.
        collections = collections_json;
    } else {
        // Get the data from localSessionStorage.
        collections = JSON.parse(sessionStorage.getItem('collections_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('collections_json');
    }
    var collectionstitle = document.createElement("h3");
    collectionstitle.innerHTML = "Shelves";
    document.getElementById("userscollections").appendChild(collectionstitle);
    var table = document.createElement("table");
    table.className = "table sortable last-content-element";
    document.getElementById("userscollections").appendChild(table);
    var thead = document.createElement("thead");
    table.appendChild(thead);
    var tr = document.createElement("tr");
    thead.appendChild(tr);
    var review_id = document.createElement("th");
    review_id.className = "hidden";
    review_id.innerHTML = "Collection ID";
    tr.appendChild(review_id);
    var collection_name = document.createElement("th");
    collection_name.innerHTML = "Shelves";
    tr.appendChild(collection_name);
    var rating = document.createElement("th");
    rating.innerHTML = "Book Count";
    tr.appendChild(rating);
    var tbody = document.createElement("tbody");
    table.appendChild(tbody);
    for(var obj in collections) {
        console.log(collections[obj]);
        tr = document.createElement("tr");
        tr.className = "table-row-link";
        tr.onclick = function () {
            window.location.href = "../collectionview/" + this.childNodes[0].innerHTML;
        };
        var collection_id = document.createElement("td");
        collection_id.className = "hidden";
        collection_id.innerHTML = collections[obj].CollectionID;
        tr.appendChild(collection_id);
        collection_name = document.createElement("td");
        collection_name.innerHTML = collections[obj].CollectionName;
        tr.appendChild(collection_name);
        rating = document.createElement("td");
        rating.innerHTML = collections[obj].ProductCount;
        tr.appendChild(rating);
        tbody.appendChild(tr);
    }
}