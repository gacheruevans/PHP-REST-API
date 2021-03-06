<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'Applications'.DS.'Ampps'.DS.'www'.DS.'PHP-REST-API');

    //Ampps/wwww/php-rest-api/includes
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');
    defined('AUTH_PATH') ? null : define('AUTH_PATH', SITE_ROOT.DS.'core'.DS.'authentication');

    //Load DB config files first
    require_once(INC_PATH.DS.'config.php');

    //Core classes
    require_once(CORE_PATH.DS.'post.php');

    //Authenticate classes
    require_once(AUTH_PATH.DS.'authenticate.php');
?>
