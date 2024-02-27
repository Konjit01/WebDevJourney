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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['units/get_subcategories'] = 'units/get_subcategories';
$route['users/change_profile_pic'] = 'users/change_profile_pic';
$route['users/password_recovery'] = 'users/password_recovery';
$route['users/activate'] = 'users/activate/';
$route['users/delete_account'] = 'users/delete_account';
$route['users/change_password'] = 'users/change_password';
$route['users/profile_settings'] = 'users/profile_settings';

$route['users/user_details/'] = 'users/user_details/';
$route['units/search_units'] = 'units/search_units';
$route['units/index'] = 'units/index';
$route['units/about'] = 'units/about';
$route['units/aboutus'] = 'units/aboutus';
$route['categories/units/(:any)'] = 'categories/units/$1';
$route['categories/create'] = 'categories/create';
$route['categories'] = 'categories/index';
$route['units/create'] = 'units/create';
$route['units/update'] = 'units/update';
$route['units/(:any)'] = 'units/view/$1';
$route['units'] = 'units/index';
$route['(:any)'] = 'pages/view/$1'; 
$route['questions/index'] = 'questions/index';
$route['questions'] = 'questions/index';

$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
