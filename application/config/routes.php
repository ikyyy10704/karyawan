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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Beranda';
$route['programs'] = 'programs/index';
$route['gaji/edit/(:num)'] = 'gaji/edit/$1';
$route['gaji/edit/(:num)/(:any)'] = 'gaji/edit/$1/$2';
$route['gaji/delete/(:num)/(:any)'] = 'gaji/delete/$1/$2';
$route['default_controller'] = 'user/login';
$route['login'] = 'user/login';
$route['login_process'] = 'user/login_process';
$route['logout'] = 'user/logout';
$route['kinerja'] = 'kinerja/index';
$route['kinerja/create'] = 'kinerja/create';
$route['kinerja/edit/(:num)'] = 'kinerja/edit/$1';
$route['kinerja/delete/(:num)'] = 'kinerja/delete/$1';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/change_password'] = 'auth/change_password';
$route['auth/register'] = 'auth/register';
$route['auth/login'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$config['index_page'] ='';
$route['absensi/edit/(:any)'] = 'absensi/edit/$1';
$route['absensi/hapus/(:any)'] = 'absensi/hapus/$1';

