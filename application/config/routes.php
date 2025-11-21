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

$route['default_controller'] = 'login';
$route['login'] = 'login/index';
$route['login/proses'] = 'login/proses';
$route['logout'] = 'login/logout';

$route['kegiatan'] = 'kegiatan/index';
$route['kegiatan/create'] = 'kegiatan/create';
$route['kegiatan/store'] = 'kegiatan/store';
$route['kegiatan/edit/(:any)'] = 'kegiatan/edit/$1';
$route['kegiatan/update/(:any)'] = 'kegiatan/update/$1';
$route['kegiatan/delete/(:any)'] = 'kegiatan/delete/$1';

$route['instrumen'] = 'instrumen/index';
$route['instrumen/create'] = 'instrumen/create';
$route['instrumen/store'] = 'instrumen/store';
$route['instrumen/edit/(:any)'] = 'instrumen/edit/$1';
$route['instrumen/update/(:any)'] = 'instrumen/update/$1';
$route['instrumen/delete/(:any)'] = 'instrumen/delete/$1';

$route['tahun-akademik'] = 'tahun_akademik/index';
$route['tahun-akademik/update'] = 'tahun_akademik/update';

$route['sub-kegiatan'] = 'subkegiatan/index';
$route['sub-kegiatan/create'] = 'subkegiatan/create';
$route['sub-kegiatan/store'] = 'subkegiatan/store';
$route['sub-kegiatan/edit/(:any)'] = 'subkegiatan/edit/$1';
$route['sub-kegiatan/update/(:any)'] = 'subkegiatan/update/$1';
$route['sub-kegiatan/delete/(:any)'] = 'subkegiatan/delete/$1';

$route['sub-kegiatan-detail'] = 'subkegiatan_detail';
$route['sub-kegiatan-detail/page'] = 'subkegiatan_detail/index/0';
$route['sub-kegiatan-detail/page/(:num)'] = 'subkegiatan_detail/index/$1';
$route['sub-kegiatan-detail/create'] = 'subkegiatan_detail/create';
$route['sub-kegiatan-detail/store'] = 'subkegiatan_detail/store';
$route['sub-kegiatan-detail/edit/(:num)'] = 'subkegiatan_detail/edit/$1';
$route['sub-kegiatan-detail/update/(:num)'] = 'subkegiatan_detail/update/$1';
$route['sub-kegiatan-detail/delete/(:num)'] = 'subkegiatan_detail/delete/$1';
$route['sub-kegiatan-detail/(:num)'] = 'subkegiatan_detail/show/$1';

$route['sub-kegiatan-detail/(:num)/files/(:num)'] = 'fileDetail/index/$1/$2';
$route['sub-kegiatan-detail/file/store'] = 'subkegiatan_detail/store_file';
$route['sub-kegiatan-detail/file/update/(:num)'] = 'subkegiatan_detail/update_file/$1';
$route['sub-kegiatan-detail/file/delete/(:num)'] = 'subkegiatan_detail/delete_file/$1';

$route['sub-kegiatan-detail/(:num)/files/(:num)/add'] = 'FileDetail/store/$1/$2';
$route['sub-kegiatan-detail/file_detail/update/(:num)'] = 'FileDetail/update/$1';
$route['sub-kegiatan-detail/file_detail/delete/(:num)'] = 'FileDetail/delete/$1';
$route['sub-kegiatan-detail/file_detail/view/(:num)'] = 'FileDetail/view/$1';

$route['akses'] = 'akses/index';
$route['akses/insert'] = 'akses/insert';
$route['akses/update'] = 'akses/update';
$route['akses/delete/(:any)'] = 'akses/delete/$1';

$route['rekapitulasi'] = 'explorer/index';
$route['rekapitulasi/subkegiatan/(:num)'] = 'explorer/subkegiatan/$1';
$route['rekapitulasi/subkegiatandetail/(:num)'] = 'explorer/subkegiatandetail/$1';
$route['rekapitulasi/file/(:num)'] = 'explorer/file/$1';
$route['rekapitulasi/file_detail/(:num)'] = 'explorer/file_detail/$1';
$route['rekapitulasi/open_file/(:num)'] = 'explorer/open_file/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
