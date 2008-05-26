<?php
$rendPath = dirname(dirname(__FILE__));

include 'common.php';

$front->setPath($rendPath);

if (isset($_SERVER['REND_MODE'])) {
    $front->setMode($_SERVER['REND_MODE']);
}

ini_set('display_errors', $front->getConfig()->display_errors);
date_default_timezone_set($front->getConfig()->timezone);

include 'setup.php';

$front->addModuleDirectory($rendPath . '/application')
      ->dispatch();
