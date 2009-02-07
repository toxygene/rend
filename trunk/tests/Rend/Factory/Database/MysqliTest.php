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

        $this->_factory
             ->setHost(TESTS_ZEND_DB_ADAPTER_MYSQL_HOSTNAME)
             ->setSchema(TESTS_ZEND_DB_ADAPTER_MYSQL_DATABASE)
             ->setPassword(TESTS_ZEND_DB_ADAPTER_MYSQL_PASSWORD)
             ->setPort(TESTS_ZEND_DB_ADAPTER_MYSQL_PORT)
             ->setUsername(TESTS_ZEND_DB_ADAPTER_MYSQL_USERNAME);
    }

    public function testAdapterCanBeConfigured()
    {
        $database = $this->_factory
                         ->setAutoQuoteIdentifiers(true)
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
                "host" => "test1",
                "port" => 2,
                "password" => "test3",
                "persistent" => true,
                "dbname" => "test4",
                "username" => "test7",
                "options" => array(
                    "autoQuoteIdentifiers" => true,
                    "caseFolding" => 0
                )
            ),
            $database->getConfig()
        );
    }

    public function testCaseFoldingCanBeSetToNatural()
    {
        $config = $this->_factory
                       ->setCaseFolding("natural")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::CASE_NATURAL,
            $config["caseFolding"]
        );
    }

    public function testCaseFoldingCanBeSetToUpper()
    {
        $config = $this->_factory
                       ->setCaseFolding("upper")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::CASE_UPPER,
            $config["caseFolding"]
        );
    }

    public function testCaseFoldingCanBeSetToLower()
    {
        $config = $this->_factory
                       ->setCaseFolding("lower")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::CASE_LOWER,
            $config["caseFolding"]
        );
    }

    public function testInvalidCaseFoldingThrowsAnException()
    {
        $this->setExpectedException("Rend_Factory_Database_Exception");

        $config = $this->_factory
                       ->setCaseFolding("asdf");
    }

    public function testFetchModeCanBeSetToLazy()
    {
        $config = $this->_factory
                       ->setFetchMode("lazy")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_LAZY,
            $config["fetchMode"]
        );
    }

    public function testFetchModeCanBeSetToAssoc()
    {
        $config = $this->_factory
                       ->setFetchMode("assoc")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_ASSOC,
            $config["fetchMode"]
        );
    }

    public function testFetchModeCanBeSetToNum()
    {
        $config = $this->_factory
                       ->setFetchMode("num")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_NUM,
            $config["fetchMode"]
        );
    }

    public function testFetchModeCanBeSetToBoth()
    {
        $config = $this->_factory
                       ->setFetchMode("both")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_BOTH,
            $config["fetchMode"]
        );
    }

    public function testFetchModeCanBeSetToNamed()
    {
        $config = $this->_factory
                       ->setFetchMode("named")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_NAMED,
            $config["fetchMode"]
        );
    }

    public function testFetchModeCanBeSetToObj()
    {
        $config = $this->_factory
                       ->setFetchMode("obj")
                       ->create()
                       ->getConfig();

        $this->assertEquals(
            Zend_Db::FETCH_OBJ,
            $config["fetchMode"]
        );
    }

    public function testInvalidFetchModeThrowsAnException()
    {
        $this->setExpectedException("Rend_Factory_Database_Exception");

        $config = $this->_factory
                       ->setFetchMode("asdf");
    }

    public function testCharsetCanBeConfigured()
    {
        if (!TESTS_ZEND_DB_ADAPTER_MYSQLI_ENABLED) {
            $this->markTestSkipped("MYSQLI adapter not enabled");
        }

        $database = $this->_factory
                         ->setCharset("UTF-8")
                         ->create();

        $this->assertEquals(
            "UTF-8",
            $database->getConnection()->get_charset()
        );
    }

}
