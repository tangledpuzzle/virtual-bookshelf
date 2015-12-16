/**
 * User: joseu
 */
var document, sessionStorage, window, reviews_json;

/**
 * Creates  HTML list of reviews in the database from the sessionStorage data.
 * @author Ilkka
 */
function createReviewList() {
    "use strict";
    var reviews;
    // Is the global variable json not undefined?
    if('undefined' !== typeof reviews_json) {
        // Copy the data to the local variable.
        reviews = reviews_json;
    } else {
        // Get the data from localSessionStorage.
        reviews = JSON.parse(sessionStorage.getItem('reviews_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('reviews_json');
    }
    var table = document.createElement("table");
    table.className = "table sortable last-content-element";
    document.getElementById("reviewlist").appendChild(table);
    var thead = document.createElement("thead");
    table.appendChild(thead);
    var tr = document.createElement("tr");
    thead.appendChild(tr);
    var review_id = document.createElement("th");
    review_id.className = "hidden";
    review_id.innerHTML = "Review ID";
    tr.appendChild(review_id);
    var screen_name = document.createElement("th");
    screen_name.innerHTML = "Reviewer";
    tr.appendChild(screen_name);
    var rating = document.createElement("th");
    rating.innerHTML = "Rating";
    tr.appendChild(rating);
    var review_date = document.createElement("th");
    review_date.innerHTML = "Date";
    tr.appendChild(review_date);
    var tbody = document.createElement("tbody");
    table.appendChild(tbody);
	var obj;
    for(obj in reviews) {
        tr = document.createElement("tr");
        tr.className = "table-row-link";
        tr.onclick = function() {
            window.location.href = "../review/" + this.childNodes[0].innerHTML;
        };
        review_id = document.createElement("td");
        review_id.className = "hidden";
        review_id.innerHTML = reviews[obj].ReviewID;
        tr.appendChild(review_id);
        screen_name = document.createElement("td");
        screen_name.innerHTML = reviews[obj].ScreenName;
        tr.appendChild(screen_name);
        rating = document.createElement("td");
        rating.innerHTML = reviews[obj].Rating + " / 5";
        tr.appendChild(rating);
        review_date = document.createElement("td");
        review_date.innerHTML = reviews[obj].ReviewDate;
        tr.appendChild(review_date);
        tbody.appendChild(tr);
    }
}