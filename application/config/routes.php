<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/

/*
| -------------------------------------------------------------------------
| Project Routes
| -------------------------------------------------------------------------
*/
// SPECIFIC CONTROLLERS
$route['writereview/(:num)'] = 'review/write_review/$1';
$route['register'] = 'register/show_register';
$route['profileedit'] = 'profileedit/update_user';
$route[LOGIN_PAGE] = 'login/login';
$route['logout'] = 'login/logout';

// GENERIC CONTROLLER
$route['(:any)/(:any)'] = 'my_projekti/view/$1/$2';
$route['(:any)'] = 'my_projekti/view/$1';

/*
| -------------------------------------------------------------------------
| Project Routes: Do not change
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'my_projekti/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| Project REST API Routes
| -------------------------------------------------------------------------
| 
| Note
| Route rules are not filters! Setting a rule of e.g. ‘foo/bar/(:num)’ will not prevent controller Foo and method bar to be called with a non-numeric value if that is a valid route.
*/

// -- HTTP GET: USERS (No Login) --

// GET users/#/collections/# > userdata_get(userid, collectionid);
//$route['api/requests/users/(:num)/collections/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/collectionid/$2/format/$3$4';
//$route['api/requests/users/(:num)/collections/(:num)']['GET'] = 'api/requests/userdata/userid/$1/collectionid/$2';

// GET users/#/comments/# > userdata_get(userid, commentid);
//$route['api/requests/users/(:num)/comments/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/commentid/$2/format/$3$4';
//$route['api/requests/users/(:num)/comments/(:num)']['GET'] = 'api/requests/userdata/userid/$1/commentid/$2';

// GET users/#/collections > userdata_get(userid, datatype);
$route['api/requests/users/(:num)/collections(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/datatype/collections/format/$2$3';
$route['api/requests/users/(:num)/collections']['GET'] = 'api/requests/userdata/userid/$1/datatype/collections';

// GET users/#/comments > userdata_get(userid, datatype);
$route['api/requests/users/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/datatype/comments/format/$2$3';
$route['api/requests/users/(:num)/comments']['GET'] = 'api/requests/userdata/userid/$1/datatype/comments';

// GET users/#/reviews > userdata_get(userid, datatype);
$route['api/requests/users/(:num)/reviews(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/datatype/reviews/format/$2$3';
$route['api/requests/users/(:num)/reviews']['GET'] = 'api/requests/userdata/userid/$1/datatype/reviews';


// GET users/# > users_get(userid);
// GET users > users_get();
$route['api/requests/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/users/userid/$1/format/$2$3';
$route['api/requests/users/(:num)']['GET'] = 'api/requests/users/userid/$1';

// -- HTTP GET: PRODUCTS (No Login) --

// GET products/#/comments/# > productdata_get(productid, commentid);
//$route['api/requests/products/(:num)/comments/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productdata/productid/$1/commentid/$2/format/$3$4';
//$route['api/requests/products/(:num)/comments/(:num)']['GET'] = 'api/requests/productdata/productid/$1/commentid/$2';

// GET products/#/reviews > productdata_get(productid, datatype);
$route['api/requests/products/(:num)/reviews(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productdata/productid/$1/datatype/reviews/format/$2$3';
$route['api/requests/products/(:num)/reviews']['GET'] = 'api/requests/productdata/productid/$1/datatype/reviews';

// GET products/#/comments > productdata_get(productid, datatype);
$route['api/requests/products/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productdata/productid/$1/datatype/comments/format/$2$3';
$route['api/requests/products/(:num)/comments']['GET'] = 'api/requests/productdata/productid/$1/datatype/comments';

// GET products/# > products_get(productid);
// GET products > products_get();
$route['api/requests/products/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/products/productid/$1/format/$2$3';
$route['api/requests/products/(:num)']['GET'] = 'api/requests/products/productid/$1';

// -- HTTP GET: REVIEWS (No Login) --

// GET reviews/#/comments > reviewdata_get(reviewid, datatype);
$route['api/requests/reviews/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/reviewdata/reviewid/$1/datatype/comments/format/$2$3';
$route['api/requests/reviews/(:num)/comments']['GET'] = 'api/requests/reviewdata/reviewid/$1/datatype/comments';

// GET reviews/# > reviews_get(reviewid);
// GET reviews > reviews_get();
$route['api/requests/reviews/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/reviews/reviewid/$1/format/$2$3';
$route['api/requests/reviews/(:num)']['GET'] = 'api/requests/reviews/reviewid/$1';


// -- HTTP POST: PRODUCTS & USERS (Login Required) --
// TODO: Login functionality not yet implemented.

// TODO: Technically the product ID is not needed here.
// POST products/#/reviews/#/comments > comments_post(productid, reviewid, text);
//$route['api/requests/products/(:num)/reviews/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['POST'] = 'api/requests/comments/productid/$1/reviewid/$2/format/$3$4';
//$route['api/requests/products/(:num)/reviews/(:num)/comments']['POST'] = 'api/requests/comments/productid/$1/reviewid/$2';

// POST products/#/comments > comments_post(productid, text);
//$route['api/requests/products/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['POST'] = 'api/requests/comments/productid/$1/format/$2$3';
//$route['api/requests/products/(:num)/comments']['POST'] = 'api/requests/comments/productid/$1';

// POST users/#/comments > comments_post(userid, text);
//$route['api/requests/users/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['POST'] = 'api/requests/comments/userid/$1/format/$2$3';
//$route['api/requests/users/(:num)/comments']['POST'] = 'api/requests/comments/userid/$1';


// -- HTTP PUT: COLLECTIONS (Login Required) --
// TODO: Login functionality not yet implemented.

// TODO: Technically the user ID is not needed here as it comes from the login details.
// POST products/#/reviews/#/comments > comments_post(productid, reviewid, text);
//$route['api/requests/users/(:num)/collections/(:num)/products/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['PUT'] = 'api/requests/userdata/userid/$1/collectionid/$2/productid/$3/format/$4$5';
//$route['api/requests/users/(:num)/collections/(:num)/products/(:num)']['PUT'] = 'api/requests/userdata/userid/$1/collectionid/$2/productid/$3';

// -- HTTP DELETE: REVIEWS & COLLECTIONS (Login Required) --
// TODO: Login functionality not yet implemented.
// TODO: Implement later if necessary.


// -- HTTP POST: RAW DATABASE ACCESS --
//$route['api/requests/db/(:any)(\.)([a-zA-Z0-9_-]+)(.*)']['POST'] = 'api/requests/db/args/$1/format/$2$3';
//$route['api/requests/db/(:any)']['POST'] = 'api/requests/db/args/$1';
