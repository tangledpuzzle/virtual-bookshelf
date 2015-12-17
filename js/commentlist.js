/**
 * Common global variable explicitly defined to shut up JSLint.
 */
var sessionStorage, document;
/**
 * Comment list JSON data defined in the commentlist.php file. Used if browser does not support sessionStorage.
 */
var comments_json;
/**
 * Creates an HTML list of comments from the data returned by the database model.
 * @author Ilkka & Jose
 * @param {int} user_is_admin Is the current users admin status. 1 = user is admin, 0 = user is not admin or is not logged in.
 */

function createCommentList(user_is_admin) {
    "use strict";
    var comments;
    // Is the global json array not undefined?
    if('undefined' !== typeof comments_json) {
        // Copy the data to the local variable.
        comments = comments_json;
    } else {
        // Get the data from sessionStorage.
        comments = JSON.parse(sessionStorage.getItem('comments_json'));
        // Remove the item from storage as it is no longer needed.
        sessionStorage.removeItem('comments_json');
    }
    var commenttitle = document.createElement("h3");
    commenttitle.innerHTML = "Comments";
    document.getElementById("commentlist").appendChild(commenttitle);
    var usera, infodiv, maindiv, datediv, userdiv, commentdiv, deldiv, delform, delbtn, delid, i;
    for(i = comments.length; i > 0; i--) {
        usera = document.createElement("a");
        userdiv = document.createElement("div");
        infodiv = document.createElement("div");
        maindiv = document.createElement("div");
        maindiv.className = "row";
        commentdiv = document.createElement("div");
        datediv = document.createElement("div");
        usera.href = "../userview/" + comments[i - 1].user_id;
        usera.innerHTML = comments[i - 1].ScreenName;
        userdiv.className = "col-md-4";
        userdiv.appendChild(usera);
        infodiv.className = "row";
        infodiv.appendChild(userdiv);
        datediv.innerHTML = comments[i - 1].PostDate;
        datediv.className = "col-md-2";
        infodiv.appendChild(datediv);
        if(user_is_admin === 1) {
            deldiv = document.createElement("div");
            deldiv.className = "col-md-2";
            delform = document.createElement("form");
            delform.action = "";
            delform.method = "post";
            delid = document.createElement("input");
            delid.type = "number";
            delid.name = "delete_comment_id";
            delid.className = "hidden";
            delid.value = comments[i - 1].CommentID;
            delbtn = document.createElement("input");
            delbtn.value = "Delete Comment";
            delbtn.className = "btn btn-danger btn-xs";
            delbtn.type = "submit";
            delbtn.name = "submit";
            delform.appendChild(delid);
            delform.appendChild(delbtn);
            deldiv.appendChild(delform);
            infodiv.appendChild(deldiv);
        }
        maindiv.appendChild(infodiv);
        commentdiv.innerHTML = comments[i - 1].Text;
        commentdiv.className = "col-md-12";
        maindiv.appendChild(commentdiv);
        document.getElementById("commentlist").appendChild(maindiv);
    }
}