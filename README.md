A web application project developed by a group of 2nd year students (Bayram Aslan, Ilkka Varjokunnas & me) of Metropolia University of Applied Sciences during 2015-11-24—2015-12-17.

# Project Requirements #
1. A working self-designed application e.g. a blog or a review platform.
	- Everything works as intended.
1. The back end must have a REST API.
	- Implemented. For example to view the reviews of product ID 1, send a GET request to the URI: `index.php/api/requests/products/1/reviews`
	- The API controller is at: `application/controllers/api/Requests.php`
1. The server must permanently save data.
	- Implemented with a MySQL database. The database model is at: `application/models/api/R2pdb_model.php`
1. The code must have unit tests and the coverage should be around 80%.
	- Some tests written using PHPUnit. See the folder: `application/tests/`
	- JavaScript is not tested because we could not find a way to do it. In our project JavaScript generates HTML code which is shown on the page. Based on manual website testing everything appears to be working.
1.  All self-written HTML code must be validated.
	- Everything has been validated with [WC3 Markup Validation Service](https://validator.w3.org/).
	- Additionally, the CSS3 code has also been validated.
	- JavaScript has been linted using [JSLint](http://jslint.com/) apart from a few `Object.keys` errors and a couple of other minor things.
	- Certain errors detected by the validator have been left in the code on purpose as removing them would break site functionality and we did not find an alternative way of doing them. For example `action=""` is used to send POST data to the same page on the user view page (`application/views/pages/userview.php`).
1. All user input data must be checked for potential attacks.
	- All user input data is not checked but SQL injections or writing JavaScript should not work anywhere and will at worst cause visual oddities on the page.
1. Code must be documented with PHPDoc or JSDoc.
	- PHP documentation is in: `doc/php/`
	- JavaScript documentation is in: `doc/js/`
	
# Usage #
The site requires a MySQL database. Run the following command in a MySQL command prompt to initialize the database: `source ~/virtual-bookshelf/dev/init.sql`

REST API documentation can be found at the root in `API_DOCUMENTATION.md` or in the wiki.

The three available HTTP POST requests require "Basic Auth" authentication.
At the moment there is only one set of valid, hardcoded authentication: `admin` : `1234`.
For example to send a new comment to user ID 2: `POST index.php/api/requests/users/2/comments`
The comment is sent with the key `text` where the value is the text of the comment.

# Hardcoded User Accounts #
- Regular users: `usr` : `asdASD123` & `public` : `salaSANA1`
- Several other users: `test4` : `asdASD123`, `test5` : `asdASD123`, and so on up to `test10`.
- A moderator: `mod` : `asdASD123`
	- No extra functionality over the user role.
- An admin: `adm` : `asdASD123` & `admin` : `salaSANA1`

# Resources Used In The Project#
## Technologies  ##
- HTML5
- CSS3
- JavaScript
- PHP5
- Apache2
- Bootstrap 3
- CodeIgniter 3
- CodeIgniter 3 REST Server
- MySQL
- 3rd Party CodeIgniter Library: Community Auth
- 3rd Party CodeIgniter Library: sorttable

## Tools ##
- Codio.com (development environment)
- Ubuntu
- Git
- GitLab
- Postman
- JSLint
- PHPDoc
- JSDoc
- PHPUnit
- MVC pattern