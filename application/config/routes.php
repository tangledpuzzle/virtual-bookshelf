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
$route['default_controller'] = 'Rest_server';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4';
$route['api/example/users/(:num)'] = 'api/example/users/id/$1';

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
$route['api/requests/users/(:num)/collections/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/collectionid/$2/format/$3$4';
$route['api/requests/users/(:num)/collections/(:num)']['GET'] = 'api/requests/userdata/userid/$1/collectionid/$2';

// GET users/#/comments/# > userdata_get(userid, commentid);
$route['api/requests/users/(:num)/comments/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/commentid/$2/format/$3$4';
$route['api/requests/users/(:num)/comments/(:num)']['GET'] = 'api/requests/userdata/userid/$1/commentid/$2';

// GET users/#/collections/ > userdata_get(userid, datatype);
$route['api/requests/users/(:num)/collections(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/datatype/collections/format/$2$3';
$route['api/requests/users/(:num)/collections']['GET'] = 'api/requests/userdata/userid/$1/datatype/collections';

// GET users/#/comments/ > userdata_get(userid, datatype);
$route['api/requests/users/(:num)/comments(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/userdata/userid/$1/datatype/comments/format/$2$3';
$route['api/requests/users/(:num)/comments']['GET'] = 'api/requests/userdata/userid/$1/datatype/comments';

// GET users > users_get();
// GET users/# > users_get(userid);
$route['api/requests/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/users/userid/$1/format/$2$3';
$route['api/requests/users/(:num)']['GET'] = 'api/requests/users/userid/$1';

// -- HTTP GET: PRODUCTS (No Login) --

// GET products/reviews/comments
$route['api/requests/products/(:num)/reviews/(:num)/comments/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productreviews/productid/$1/reviewid/$2/commentid/$3/format/$4$5';
$route['api/requests/products/(:num)/reviews/(:num)/comments/(:num)']['GET'] = 'api/requests/productreviews/productid/$1/reviewid/$2/commentid/$3';

// GET products/comments
$route['api/requests/products/(:num)/comments/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productcomments/productid/$1/commentid/$2/format/$3$4';
$route['api/requests/products/(:num)/comments/(:num)']['GET'] = 'api/requests/productcomments/productid/$1/commentid/$2';

// GET products/reviews
$route['api/requests/products/(:num)/reviews/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/productreviews/productid/$1/reviewid/$2/format/$3$4';
$route['api/requests/products/(:num)/reviews/(:num)']['GET'] = 'api/requests/productreviews/productid/$1/reviewid/$2';

// GET products
$route['api/requests/products/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']['GET'] = 'api/requests/products/productid/$1/format/$2$3';
$route['api/requests/products/(:num)']['GET'] = 'api/requests/products/productid/$1';