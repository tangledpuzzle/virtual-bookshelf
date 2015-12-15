/**
 * Created with webprojekti.
 * User: ME-varjoil
 * Date: 2015-12-09
 * Time: 01:51 PM
 * To change this template use Tools | Templates.
 */

function createBookView(logged_in_user_id) {
    "use strict";
    var book;
    // Is the global json array not undefined?
    if(typeof book_json !== 'undefined') {
        // Copy the data to the local variable.
        book = book_json;
    } else {
        // Get the data from sessionStorage.
        book = JSON.parse(sessionStorage.getItem('book_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('book_json');
    }
    var prodview_name, prodview_id, prodview_date, prodview_brief, prodview_description, prodview_proddescription, prodview_publisher, prodview_proddivrow1, prodview_proddivrow2, prodview_title, prodean, prodview_proddivrow0, language, languagediv, prodview_proddivtitle, prodview_datetitle, prodview_publishertitle, prodeantitle, languagedivtitle, ihmediv, titlerow, button1, button2, buttonit, hiddendiv, hvdiv, thead, tbody;
    hiddendiv = document.createElement("div");
    hiddendiv.className = "product_iddiv";
    hiddendiv.style.display = "none";
    hiddendiv.innerHTML = book.ProductID;
    hvdiv = document.createElement("div");
    if(logged_in_user_id > 0) {
        hvdiv.className = "col-md-10";
    } else {
        hvdiv.className = "col-md-12";
    }
    titlerow = document.createElement("div");
    titlerow.className = "row";
    prodview_title = document.createElement("h1");
    prodview_title.innerHTML = book.Name + " <small> [" + book.ProductID + "] </small>";
    hvdiv.appendChild(prodview_title);
    titlerow.appendChild(hvdiv);
    document.getElementById("productview").appendChild(titlerow);
    // If the user is logged in, create the shelf controls row.
    // And the review button.
    if(logged_in_user_id > 0) {
        var collectionrow = document.createElement("div");
        collectionrow.className = "row";
        var collectionformdiv = document.createElement("div");
        collectionformdiv.className = "col-md-12";
        collectionrow.appendChild(collectionformdiv);
        var form = document.createElement("form");
        var colnamefield = document.createElement("input");
        var hiddencolid = document.createElement("input");
        var select = document.createElement("select");
        //var userCollections = book.UserCollection;
        //FIXME!!! Get data from database        
        var userCollections = {
            123: "asd",
            52: "b"
        };
        form.onsubmit = function () {
            // Check if the text field and list select contents are identical.	
            if(colnamefield.value == userCollections[select.value]) {
                // Use ID from the JSON.
                hiddencolid.value = select.value;
            } else {
                // User wants to add a product to a a new collection.
                // 0 is an invalid ID value.
                hiddencolid.value = 0;
            }
        }
        // Posts to the same page.
        form.action = "";
        form.method = "post";
        collectionformdiv.appendChild(form);
        var informdiv = document.createElement("div");
        informdiv.className = "form-group";
        form.appendChild(informdiv);
        var colnamediv = document.createElement("div");
        colnamediv.className = "form-group col-md-3 inline-form-col required";
        informdiv.appendChild(colnamediv);
        colnamefield.type = "text";
        colnamefield.name = "collection-name";
        colnamefield.placeholder = "New or Existing Shelf Name";
        colnamefield.className = "form-control required";
        colnamediv.appendChild(colnamefield);
        hiddencolid.type = "number";
        hiddencolid.name = "collection-id";
        hiddencolid.className = "form-control hidden";
        colnamediv.appendChild(hiddencolid);
        var colselectdiv = document.createElement("div");
        colselectdiv.className = "form-group col-md-3 inline-form-col";
        informdiv.appendChild(colselectdiv);
        select.className = "form-control";
        select.id = "collection-select";
        colselectdiv.appendChild(select);
        select.onchange = function () {
            colnamefield.value = userCollections[document.getElementById("collection-select").value];
        };
        for(var item in userCollections) {
            var option = document.createElement("option");
            option.value = item;
            option.innerHTML = userCollections[item];
            select.appendChild(option);
        }
        var buttoncol = document.createElement("input");
        buttoncol.className = "btn btn-default";
        buttoncol.type = "submit";
        buttoncol.name = "submit";
        buttoncol.value = "Add to Shelf";
        informdiv.appendChild(buttoncol);
        var brev = document.createElement("div");
        brev.className = "col-md-2 no-pad-col";
        var buttonrev = document.createElement("button");
        buttonrev.className = "btn-lg btn-success pull-right";
        buttonrev.innerHTML = "Review";
        brev.appendChild(buttonrev);
        titlerow.appendChild(brev);
        buttonrev.onclick = function () {
            window.location.href = "../writereview/" + document.getElementById("product_iddiv").innerHTML;
        };
        document.getElementById("productview").appendChild(collectionrow);
    }
    document.getElementById("productview").appendChild(hiddendiv);
    prodview_proddivtitle = document.createElement("tr");
    prodview_datetitle = document.createElement("th");
    prodview_datetitle.innerHTML = "Release Date";
    prodview_datetitle.className = "col-md-3";
    prodview_proddivtitle.appendChild(prodview_datetitle);
    prodview_publishertitle = document.createElement("th");
    prodview_publishertitle.innerHTML = "Publisher";
    prodview_publishertitle.className = "col-md-3";
    prodview_proddivtitle.appendChild(prodview_publishertitle);
    prodeantitle = document.createElement("th");
    prodeantitle.innerHTML = "EAN13";
    prodeantitle.className = "col-md-4";
    prodview_proddivtitle.appendChild(prodeantitle);
    languagedivtitle = document.createElement("th");
    languagedivtitle.innerHTML = "Language";
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
    prodview_proddivrow1.className = "product-div";
    prodview_proddivrow1.className = "row";
    prodview_brief = document.createElement("div");
    prodview_brief.innerHTML = book.Brief;
    prodview_brief.className = "col-md-12";
    prodview_proddivrow1.appendChild(prodview_brief);
    prodview_proddivrow2 = document.createElement("div");
    prodview_proddivrow2.className = "product-div";
    prodview_proddivrow2.className = "row";
    prodview_proddescription = document.createElement("div");
    prodview_proddescription.innerHTML = book.Description;
    prodview_proddescription.className = "col-md-12";
    prodview_proddivrow2.appendChild(prodview_proddescription);
    document.getElementById("productview").appendChild(ihmediv);
    document.getElementById("productview").appendChild(prodview_proddivrow1);
    document.getElementById("productview").appendChild(prodview_proddivrow2);
}