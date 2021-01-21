<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('WEBSITE_TITLE')                    or define('WEBSITE_TITLE', 'Skanray');
/* Format Constants*/
defined('DB_DATE_FORMAT') 					or define('DB_DATE_FORMAT', "%d-%M-%Y");
defined('DB_DATE_TIME_FORMAT') 				or define('DB_DATE_TIME_FORMAT', "%d-%M-%Y %l:%i %p");
defined('PHP_DATE_FORMAT') 					or define('PHP_DATE_FORMAT', "d M, Y H:m A");


/* RESPONSE STATUS */
defined('STATUS_SUCCESS') 					or define('STATUS_SUCCESS', "success");
defined('STATUS_FAILED') 					or define('STATUS_FAILED', "failed");


define('RESPONSE_STATUS_OK', 200);
define('RESPONSE_INVALID_REQUEST', 400);
define('RESPONSE_UNAUTHORIZED', 401);
define('RESPONSE_NOT_FOUND', 404);
define('RESPONSE_INTERNAL_ERROR', 500);


/* Database Tables Constants */
defined('TABLE_USERS')                 OR define('TABLE_USERS', 'users');
defined('TABLE_ACCESS_TOKEN')          OR define('TABLE_ACCESS_TOKEN', 'access_token');
defined('TABLE_ADDRESS')               OR define('TABLE_ADDRESS', 'address');
defined('TABLE_CART')                  OR define('TABLE_CART', 'cart');
defined('TABLE_CATEGORIES')            OR define('TABLE_CATEGORIES', 'categories');
defined('TABLE_COUPONS')               OR define('TABLE_COUPONS', 'coupons');
defined('TABLE_ORDERS')                OR define('TABLE_ORDERS', 'orders');
defined('TABLE_PRODUCTS')              OR define('TABLE_PRODUCTS', 'products');
defined('TABLE_PRODUCTS_ADDITIONAL')   OR define('TABLE_PRODUCTS_ADDITIONAL', 'product_additional');
defined('TABLE_TRANSACTION')           OR define('TABLE_TRANSACTION', 'transaction');
defined('TABLE_RECENTLY_VIEWED')       OR define('TABLE_RECENTLY_VIEWED', 'recently_viewed');


defined('TABLE_SPECIALITIES')          OR define('TABLE_SPECIALITIES', 'specialities');
defined('TABLE_ADD_TO_CART')          OR define('TABLE_ADD_TO_CART', 'add_to_card');
defined('TABLE_ALL_ORDER')          OR define('TABLE_ALL_ORDER', 'all_order');
defined('TABLE_ORDER_PRODUCT')          OR define('TABLE_ORDER_PRODUCT', 'oreder_product');
defined('TABLE_ALL_ORDER')          OR define('TABLE_ALL_ORDER', 'all_order');

/*
 * Roles
 * For Admin 1 
 */ 
defined('ROLE_ADMIN')                   OR define('ROLE_ADMIN', 1);
defined('ROLE_DELIVERY')                OR define('ROLE_DELIVERY', 2);
defined('ROLE_USER')                    OR define('ROLE_USER', 3);
