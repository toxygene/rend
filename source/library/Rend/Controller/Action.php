<?php
/**
 * Rend
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.rendframework.com/license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category Rend
 * @package Controller
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Zend_Controller_Action */
require_once "Zend/Controller/Action.php";

/**
 * @deprecated
 * @category Rend
 * @package Controller
 */
abstract class Rend_Controller_Action extends Zend_Controller_Action
{

    /**
     * Get the config object
     *
     * @return Zend_Config
     */
    public function getConfig()
    {
        return $this->_helper
                    ->config();
    }

    /**
     * Get the factory loader
     *
     * @return Rend_FactoryLoader
     */
    public function getFactoryLoader()
    {
        return $this->_helper
                    ->factoryLoader();
    }

}