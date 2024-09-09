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

$route['default_controller'] = 'login';

/* Employee */
$route['employee'] = 'employee'; 
$route['employee/orientation'] = 'employee/orientation'; 
$route['employee/payslip'] = 'employee/payslip'; 
$route['employee/attendance'] = 'employee/attendance'; 
$route['employee/leave'] = 'employee/leaves'; 
$route['employee/details'] = 'employee/personaldetails'; 
$route['employee/performance'] = 'employee/performance'; 

/* Manager/Supervisor */
$route['hr_head'] = 'manager'; 
$route['hr_head/department'] = 'manager/department'; 
$route['hr_head/employee'] = 'manager/employee'; 
$route['hr_head/orientation'] = 'manager/orientation'; 
$route['hr_head/performance'] = 'manager/performance'; 
$route['hr_head/position'] = 'manager/position'; 
$route['hr_head/details/(:any)'] = 'manager/employeedetails/$1'; 

/* Officer */
$route['hr_department'] = 'officer'; 
$route['hr_department/payroll'] = 'officer/payroll'; 
$route['hr_department/employeepayroll/(:any)'] = 'officer/employeepayroll/$1'; 
$route['hr_department/progress'] = 'officer/tpprogress'; 
$route['hr_department/performance'] = 'officer/performance'; 
$route['hr_department/employee'] = 'officer/employee'; 
$route['hr_department/undertime'] = 'officer/employeeundertime'; 
$route['hr_department/overtime'] = 'officer/employeeovertime'; 
$route['hr_department/orientation'] = 'officer/orientation'; 
$route['hr_department/leave'] = 'officer/leave'; 
$route['hr_department/request'] = 'officer/requestleave'; 
$route['hr_department/endofcontract'] = 'officer/allemployeeeoc'; 
$route['hr_department/awol'] = 'officer/allemployeeawol'; 
$route['hr_department/deactivatedemployee'] = 'officer/deactivated'; 
$route['hr_department/viewattendance/(:any)'] = 'officer/viewattendance/$1'; 
$route['hr_department/view/(:any)'] = 'officer/performanceview/$1'; 
$route['hr_department/edit/(:any)'] = 'officer/viewEditEmployeeDetails/$1'; 

$route['profile/details'] = 'profile';
$route['logout'] = 'profile/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
