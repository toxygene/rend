<?php
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
ini_set('log_errors', true);
ini_set('error_log', $rendPath . '/logs/phperrors.log');

/** Rend_Controller_Front */
require_once 'Rend/Controller/Front.php';

/** Zend_Controller_Action_HelperBroker */
require_once 'Zend/Controller/Action/HelperBroker.php';

$front = Rend_Controller_Front::getInstance();

Zend_Controller_Action_HelperBroker::addPrefix('Rend_Controller_Action_Helper');
