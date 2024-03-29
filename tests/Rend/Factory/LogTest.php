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
 * @subpackage UnitTest
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link  http://www.rendframework.com/
 * @since 2.0.0
 * @version  $Id$
 */

/** Rend_Factory_Log */
require_once "Rend/Factory/Log.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_LogTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Rend_Factory_Log
     */
    private $_factory;

    /**
     *
     */
    public function setUp()
    {
        $this->_factory = new Rend_Factory_Log();
    }

    /**
     *
     */
    public function testConfigurationFileSetsUpTheLog()
    {
        $log = $this->_factory
                    ->setConfigFile("./_files/log-config.php")
                    ->create();

        $this->assertAttributeContainsOnly(
            "Zend_Log_Writer_Null",
            "_writers",
            $log
        );
    }

    /**
     *
     */
    public function testNonexistantConfigFileThrowsAnException()
    {
        $this->setExpectedException("Rend_Factory_Log_Exception");

        $log = $this->_factory
                    ->create();
    }

}
