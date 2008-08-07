<?php
$rootPath = dirname(dirname(__FILE__));

// Setup error reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
ini_set('log_errors', true);
ini_set('error_log', "{$rootPath}/data/logs/phperrors.log");

// Setup include path
set_include_path(
    get_include_path() .
    PATH_SEPARATOR .
    "{$rootPath}/library"
);

/** Zend_Loader */
require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();

// Setup environment
ini_set('display_errors', $application->getConfig()->display_errors);
date_default_timezone_set($application->getConfig()->timezone);

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

Zend_Controller_Front::getInstance()
                     ->setMode($_SERVER['REND_MODE']);
                     ->setPath($rootPath)
