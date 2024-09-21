<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'users';
$route['users'] = 'users/index';
$route['users/create'] = 'users/create';
$route['users/edit/(:any)'] = 'users/edit/$1';
$route['users/delete/(:any)'] = 'users/delete/$1';
$route['users/index/(:num)'] = 'users/index/$1';

