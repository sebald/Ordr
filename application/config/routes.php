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

$route['admin/users/view'] = 'admin/users_view';
$route['admin/users/view/(:any)'] = 'admin/users_view/$1';
$route['admin/users/view/(:any)/(:any)'] = 'admin/users_view/$1/$2';
$route['admin/users/view/(:any)/(:any)/(asc|desc)'] = 'admin/users_view/$1/$2/$3';
$route['admin/users/view/(:any)/(:any)/(asc|desc)/(:num)'] = 'admin/users_view/$1/$2/$3/$4';

$route['admin/users/actions'] = 'admin/users_actions';

$route['admin/users/delete'] = 'admin/users_delete';
$route['admin/users/delete/(:any)'] = 'admin/users_delete/$1';

$route['admin/users/role'] = 'admin/users_role';

$route['admin/users/edit/(:any)'] = 'admin/users_edit/$1';

$route['admin/users/search'] = 'admin/users_search';
$route['admin/users/filter'] = 'admin/users_filter';

$route['admin/users/changeview'] = 'admin/users_change_view';

$route['orders/new'] = 'orders/new_order';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */