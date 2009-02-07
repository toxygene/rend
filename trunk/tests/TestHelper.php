<?php
date_default_timezone_set("America/Chicago");

$root = dirname(dirname(__FILE__)) . "/source";

// Setup include path
set_include_path(
    get_include_path() .
    PATH_SEPARATOR .
    "{$root}/library"
);

/** Zend_Loader */
require_once "Zend/Loader.php";
Zend_Loader::registerAutoload();

Zend_Session::start();

PHPUnit_Util_Filter::addDirectoryToWhiteList(
    "{$root}/library/Rend",
    ".php"
);

require_once "TestConfiguration.php";
