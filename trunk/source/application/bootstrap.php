<?php
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'application');

// Setup include path
set_include_path(
    get_include_path() .
    PATH_SEPARATOR .
    ROOT_PATH . '/library' .
    PATH_SEPARATOR .
    APP_PATH
);

/** Zend_Loader */
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

Rend_Controller_Front::getInstance()
                     ->addControllerDirectory(APP_PATH . '/controllers', 'default')
                     ->addModuleDirectory(APP_PATH . '/modules')
                     ->setMode($_SERVER['REND_MODE'])
                     ->setPath(ROOT_PATH);

$config = Rend_Controller_Front::getInstance()
                               ->getConfig();

// Setup error reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', $config->display_errors);
ini_set('error_log', ROOT_PATH . '/data/logs/phperrors.log');
ini_set('log_errors', true);
date_default_timezone_set($config->timezone);
Rend_Controller_Front::getInstance()
                     ->throwExceptions($config->display_errors);

try {
    Rend_Controller_Front::getInstance()
                         ->dispatch();
} catch (Exception $e) {
?>
<html>
    <head>
        <title>Unhandled Exception</title>
    </head>
    <body>
        <h1>Unhandled Exception</h1>
        <h2>Message</h2>
        <p><?php echo $e->getMessage(); ?></p>
        <h2>Basic Stack Trace</h2>
        <pre><?php echo $e; ?></pre>
        <h2>Full Stack Trace</h2>
        <pre><?php var_dump($e); ?></pre>
    </body>
</html>
<?php
}
