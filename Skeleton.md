# Zend Framework Skeleton #

Currently, the Zend Framework does not have an automatic tool for setting up a Zend Framework based project. While they are creating tools to solve this problem ([Zend\_Tool](http://framework.zend.com/wiki/display/ZFPROP/Zend_Tool+-+General)), Rend provides a simple directory structure out of the box.

The structure of the Rend source code files and directories is setup to match the new, [proposed Zend Controller modular directory structure](http://framework.zend.com/wiki/display/ZFPROP/Zend+Framework+Default+Project+Structure+-+Wil+Sinclair).

  * application
    * apis
    * config
    * controllers
      * helpers
    * layouts
      * filters
      * helpers
      * scripts
    * models
    * _modules_
    * view
      * filters
      * helpers
      * scripts
    * bootstrap.php
  * data
    * cache
    * indexes
    * locales
    * logs
    * sessions
    * uploads
  * docs
  * library
    * Project
    * Rend
    * Zend
  * public
    * css
    * js
    * images
    * .htaccess
    * index.php
  * scripts
    * jobs
    * build
  * temp
  * tests

All this allows you to begin developing your application immediately, without having to do the setup of a Zend Framework site.