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
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html    New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Factory_Database_Mysqli */
require_once "Rend/Factory/Database/Mysqli.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_Database_MysqliTest extends PHPUnit_Framework_TestCase
{

    private $_factory;

    public function setUp()
    {
        $this->_factory = new Rend_Factory_Database_Mysqli();
    }

    public function testAdapterCanBeConfigured()
    {
        $database = $this->_factory
                         ->setAutoQuoteIdentifiers(true)
                         ->setCaseFolding("lower")
                         ->setFetchMode("assoc")
                         ->setHost("test1")
                         ->setPort(2)
                         ->setPassword("test3")
                         ->setPersistent(true)
                         ->setSchema("test4")
                         ->setStatementClass("test6")
                         ->setUsername("test7")
                         ->create();

        $this->assertEquals(
            array(
                "driver_options" => array(),
                "autoQuoteIdentifiers" => true,
                "caseFolding" => Zend_Db::CASE_LOWER,
                "fetchMode" => Zend_Db::FETCH_ASSOC,
                "host" => "test1",
                "port" => 2,
                "password" => "test3",
                "persistent" => true,
                "dbname" => "test4",
                "username" => "test7",
                "options" => array(
                    "caseFolding" => 0,
                    "autoQuoteIdentifiers" => true
                )
            ),
            $database->getConfig()
        );
    }

}
