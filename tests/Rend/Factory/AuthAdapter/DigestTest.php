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

/** Rend_Factory_AuthAdapter_Digest */
require_once "Rend/Factory/AuthAdapter/Digest.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_AuthAdapter_DigestTest extends PHPUnit_Framework_TestCase
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
        $this->_factory = new Rend_Factory_AuthAdapter_Digest();
    }

    /**
     *
     */
    public function testFilenameIsConfigurable()
    {
        $adapter = $this->_factory
                        ->setFilename("filename")
                        ->create();

        $this->assertEquals(
            "filename",
            $adapter->getFilename()
        );
    }

    /**
     *
     */
    public function testPasswordIsConfigurable()
    {
        $adapter = $this->_factory
                        ->setPassword("password")
                        ->create();

        $this->assertEquals(
            "password",
            $adapter->getPassword()
        );
    }

    /**
     *
     */
    public function testRealmIsConfigurable()
    {
        $adapter = $this->_factory
                        ->setRealm("realm")
                        ->create();

        $this->assertEquals(
            "realm",
            $adapter->getRealm()
        );
    }

    /**
     *
     */
    public function testUsernameIsConfigurable()
    {
        $adapter = $this->_factory
                        ->setUsername("username")
                        ->create();

        $this->assertEquals(
            "username",
            $adapter->getUsername()
        );
    }

}
