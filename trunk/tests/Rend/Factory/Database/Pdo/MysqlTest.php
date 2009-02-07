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

/** Rend_Factory_Database_Pdo_Mysql */
require_once "Rend/Factory/Database/Pdo/Mysql.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_Database_Pdo_MysqlTest extends PHPUnit_Framework_TestCase
{

    private $_factory;

    public function setUp()
    {
        if (!TESTS_ZEND_DB_ADAPTER_PDO_MYSQL_ENABLED) {
            $this->markTestSkipped("PDO MYSQL adapter not enabled");
        }

        $this->_factory = new Rend_Factory_Database_Pdo_Mysql();

        $this->_factory
             ->setHost(TESTS_ZEND_DB_ADAPTER_MYSQL_HOSTNAME)
             ->setSchema(TESTS_ZEND_DB_ADAPTER_MYSQL_DATABASE)
             ->setPassword(TESTS_ZEND_DB_ADAPTER_MYSQL_PASSWORD)
             ->setPort(TESTS_ZEND_DB_ADAPTER_MYSQL_PORT)
             ->setUsername(TESTS_ZEND_DB_ADAPTER_MYSQL_USERNAME);
    }

    public function testAllowLocalInfileIsConfigurable()
    {
        $this->markTestIncomplete();

        $database = $this->_factory
                         ->setAllowLocalInfile(true)
                         ->create();
    }

    public function testCharsetIsConfigurable()
    {
        $database = $this->_factory
                         ->setCharset("utf8")
                         ->create();

        $charset = $database->fetchRow("SHOW VARIABLES LIKE 'character_set_connection'");

        $this->assertEquals(
            "utf8",
            $charset["Value"]
        );
    }

    public function testInitCommandIsConfigurable()
    {
        $database = $this->_factory
                         ->setInitCommand("SET NAMES 'utf8'")
                         ->create();

        $charset = $database->fetchRow("SHOW VARIABLES LIKE 'character_set_connection'");

        $this->assertEquals(
            "utf8",
            $charset["Value"]
        );
    }

    public function testMaximumBufferSizeIsConfigurable()
    {
        $database = $this->_factory
                         ->setMaximumBufferSize(1)
                         ->create();

        $this->assertEquals(
            1,
            $database->getConnection()
                     ->getAttribute(PDO::MYSQL_ATTR_MAX_BUFFER_SIZE)
        );
    }

    public function testReadDefaultFileIsConfigurable()
    {
        $this->markTestIncomplete();

        $database = $this->_factory
                         ->setReadDefaultFile("???")
                         ->create();
    }

    public function testReadDefaultGroupIsConfigurable()
    {
        $this->markTestIncomplete();

        $database = $this->_factory
                         ->setReadDefaultGroup("???")
                         ->create();
    }

    public function testUnixSocketIsConfigurable()
    {
        if (!TESTS_ZEND_DB_ADAPTER_MYSQL_SOCKET) {
            $this->markTestIncomplete();
        }

        $this->markTestIncomplete();

        $database = $this->_factory
                         ->setUnixSocket(TESTS_ZEND_DB_ADAPTER_MYSQL_SOCKET)
                         ->create();
    }

    public function testUseBufferedQueriesIsConfigurable()
    {
        $database = $this->_factory
                         ->setUseBufferedQueries(true)
                         ->create();

        $this->assertEquals(
            1,
            $database->getConnection()
                     ->getAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY)
        );
    }

    public function testUseDirectQueriesIsConfigurable()
    {
        $database = $this->_factory
                         ->setUseDirectQueries(true)
                         ->create();

        $this->assertEquals(
            1,
            $database->getConnection()
                     ->getAttribute(PDO::MYSQL_ATTR_DIRECT_QUERY)
        );
    }

}
