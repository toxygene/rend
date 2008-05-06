<?php
$rendPath = dirname(dirname(__FILE__));

include 'common.php';

$front->setParam('rendPath', $rendPath)
      ->setParam('rendMode', isset($_SERVER['REND_MODE']) ? $_SERVER['REND_MODE'] : Rend_Controller_Front::PRODUCTION);

ini_set('display_errors', $front->getConfig()->display_errors);
date_default_timezone_set($front->getConfig()->timezone);

include 'setup.php';

$front->addModuleDirectory($rendPath . '/application')
      ->dispatch();
