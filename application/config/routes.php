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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['initialize-speci-report'] = 'ReportsController/initializeSpeciReport';
$route['generate-speci-report'] = 'ReportsController/displaySpeciReport';

$route['custom-rainfall-report'] = 'ReportsController/initializeRainfallCustomReport';
$route['generate-custom-rainfall-report'] = 'DisplayCustomRainfallReport/DisplayCustomRainfallReport';


$route['custom-temperature-report'] = 'ReportsController/initializeTemperatureCustomReport';
$route['generate-custom-temp-report'] = 'DisplayCustomRainfallReport/DisplayCustomTemperatureReport';

$route['metar-report'] = 'ReportsController/initializeMetarReport';
$route['generate-metar-report'] = 'ReportsController/displaymetarreport';


$route['user-registration-form'] = 'Users/DisplayStationUsersForm';
$route['registered-users'] = 'Users/index';
$route['register-user'] = 'Users/insertUser';
$route['update-user-form'] = 'Users/DisplayStationUsersFormForUpdate';
$route['update-user'] = 'Users/updateUser';
$route['delete-user'] = 'Users/deleteUser';


$route['observationslip-report'] = 'ReportsController/initialiseObservationSlipReport';
$route['generate-observationslip-report'] = 'ReportsController/displayobservationslipreport';

$route['synoptic-report'] = 'ReportsController/initializeSynopticReport';
$route['generate-synoptic-report'] = 'SynopticReport/displaysynopticreport';

$route['update-user-form/(:num)'] = 'Users/DisplayStationUsersFormForUpdate/$userdetailsid';

$route['monthlyrainfall-report'] = 'ReportsController/initializeMonthlyRainfallReport';
$route['generate-monthlyrainfall-report'] = 'ReportsController/displaymonthlyrainfallreport';

$route['yearly-rainfall-report'] = 'ReportsController/initializeRainfallYearlyReport';
$route['generate-yearlyrainfall-report'] = 'YearlyRainfallReport/displayyearlyrainfallreport';

$route['WeatherSummary-report'] = 'ReportsController/initializeWeatherSummnaryReport';
$route['generate-WeatherSummary-report'] = 'WeatherSummaryReport/displayweathersummaryreport';

$route['dekadal-report'] = 'ReportsController/initializeDekadalReport';
$route['generate-dekadal-report'] = 'ReportsController/displaydekadalreport';

$route['ObservationSlipform/showWebmobiledata/(:any)'] = 'ObservationSlipform/showWebmobiledata/$1';






