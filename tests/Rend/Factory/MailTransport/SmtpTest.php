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
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Factory_MailTransport_Smtp */
require_once "Rend/Factory/MailTransport/Smtp.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_MailTransport_SmtpTest extends PHPUnit_Framework_TestCase
{

    private $_factory;

    public function setUp()
    {
        $this->_factory = new Rend_Factory_MailTransport_Smtp();
    }

    public function testAuthCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setAuth('login')
                          ->create();

        $this->assertAttributeContains(
            "login",
            "_auth",
            $transport
        );
    }

    public function testConnectionCanBeConfigured()
    {
        $connection = new Zend_Mail_Protocol_Smtp();

        $transport = $this->_factory
                          ->setConnection($connection)
                          ->create();

        $this->assertSame(
            $connection,
            $transport->getConnection()
        );
    }

    public function testHostCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setAuth('login')
                          ->create();

        $this->assertAttributeEquals(
            "127.0.0.1",
            "_host",
            $transport
        );
    }

    public function testNameCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setName('test')
                          ->create();

        $this->assertAttributeEquals(
            "test",
            "_name",
            $transport
        );
    }

    public function testPasswordCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setPassword('test')
                          ->create();

        $this->assertAttributeEquals(
            array("password" => "test"),
            "_config",
            $transport
        );
    }

    public function testPortCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setPort(123)
                          ->create();

        $this->assertAttributeEquals(
            123,
            "_port",
            $transport
        );
    }

    public function testUsernameCanBeConfigured()
    {
        $transport = $this->_factory
                          ->setHost('127.0.0.1')
                          ->setUsername('test')
                          ->create();

        $this->assertAttributeEquals(
            array("username" => "test"),
            "_config",
            $transport
        );
    }

}
