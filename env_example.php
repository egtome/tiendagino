<?php
/* 
 * Create environment file: "env.php" . paste this file content and replace with your credentials
 * env.php file MUST BE EXCLUDED from repository   
 */

//SECURITY. Protect against direct access
define('SITE_LOADED',TRUE);

//CORE constants 
define('CORE_PATH','Core/');
define('TRAITS_PATH','Traits/');
define('CONTROLLERS_PATH','Controllers/');
define('MODELS_PATH','Models/');
define('SERVICES_PATH','Services/');
define('VIEWS_PATH','views/');

// Default controller
define('DEFAULT_CONTROLLER','Home');
define('DEFAULT_METHOD','index');

// Default not found controller
define('DEFAULT_NOT_FOUND_CONTROLLER','NotFound');
define('DEFAULT_NOT_FOUND_METHOD','index');

//Errors
define('SHOW_ERRORS',TRUE);

//Database
define('DB_HOST','localhost');
define('DB_NAME','test');
define('DB_USER','test');
define('DB_PASSWORD','test');


