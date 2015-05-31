<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'main';
$route['404_override'] = '/error/404';
$route['lists/(:any)'] = 'board/lists/$1';
$route['recent/(:any)'] = 'board/recent/$1';
$route['view/(:any)'] = 'board/view/$1';
$route['image/(:any)'] = 'file_handler/image/$1';
$route['thumbnail/(:any)'] = 'file_handler/thumbnail/$1';
$route['emblem/(:any)'] = 'file_handler/emblem/$1';
$route['logout'] = 'login/logout/$1';
$route['write/(:any)'] = 'submit/article/$1';

/* 접근금지 */
$route['board/'] = '/error/404';
$route['file_handler'] = '/error/404';
$route['login/logout'] = '/error/404';

/* End of file routes.php */
/* Location: ./application/config/routes.php */