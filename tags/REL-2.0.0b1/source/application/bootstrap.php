<?php
if (isset($bootstrap) && $bootstrap) {
    // Setup include path
    set_include_path(
        get_include_path() .
        PATH_SEPARATOR .
        "../library"
    );

    /** Zend_Loader */
    require_once "Zend/Loader.php";
    Zend_Loader::registerAutoload();
}

$setup = new Rend_Controller_Plugin_Setup();

Zend_Controller_Front::getInstance()
                     ->setParam("env", $_SERVER["REND_MODE"])
                     ->registerPlugin($setup, 0)
                     ->addControllerDirectory("../application/controllers", "default")
                     ->addModuleDirectory("../application/modules");
