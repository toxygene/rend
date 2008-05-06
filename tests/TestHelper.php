<?php
set_include_path(implode(
    PATH_SEPARATOR,
    array(
        get_include_path(),
        '../source/libraries',
        implode(
            PATH_SEPARATOR,
            glob('../source/application/*/models')
        )
    )
));

error_reporting(E_ALL | E_STRICT);

/** PHPUnit_Framework */
require_once 'PHPUnit/Framework.php';

/** PHPUnit_TextUI_TestRunner */
require_once 'PHPUnit/TextUI/TestRunner.php';

/** PHPUnit_Util_Filter */
require_once 'PHPUnit/Util/Filter.php';

/** Zend_Config_Ini */
require_once 'Zend/Config/Ini.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

PHPUnit_Util_Filter::addDirectoryToWhiteList('../source/libraries/Rend', '.php');

date_default_timezone_set('America/Chicago');

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');
