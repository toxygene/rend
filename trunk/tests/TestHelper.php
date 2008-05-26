<?php
$rendPath = dirname(dirname(__FILE__)) . '/source';

set_include_path(implode(
    PATH_SEPARATOR,
    array(
        get_include_path(),
        $rendPath . '/libraries',
        implode(
            PATH_SEPARATOR,
            glob($rendPath . '/application/*/models')
        )
    )
));

error_reporting(E_ALL | E_STRICT);

/** Zend_Loader */
require_once 'Zend/Loader.php';

Zend_Loader::registerAutoload();

Zend_Session::start();

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');

Rend_Controller_Front::getInstance()
                     ->setMode(Rend_Controller_Front::TESTING)
                     ->setPath($rendPath);

$timezone = Zend_Controller_Action_HelperBroker::getStaticHelper('config')
                                               ->direct()
                                               ->timezone;

date_default_timezone_set($timezone);

PHPUnit_Util_Filter::addDirectoryToWhiteList($rendPath . '/libraries/Rend', '.php');
