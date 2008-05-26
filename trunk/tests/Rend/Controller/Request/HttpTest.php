<?php
/**
 * Rend
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://rend.superglobals.com/License
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to justin.hendrickson+rend@gmail.com so I can send you a copy immediately.
 *
 * @category   Rend
 * @package    Tests
 * @copyright  Copyright (c) 2005-2007 Zend Technologies USA Inc. (http://rend.superglobals.com)
 * @license    http://rend.superglobals.com/License New BSD License
 * @version    $Id$
 */

/** TestHelper */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/TestHelper.php';

/**
 *
 */
class Rend_Controller_Request_HttpTest extends PHPUnit_Framework_TestCase
{

    private $_files;

    private $_request;

    private $_server;

    public function setUp()
    {
        $this->_files   = $_FILES;
        $this->_server  = $_SERVER;

        $this->_request = new Rend_Controller_Request_Http();
    }

    public function tearDown()
    {
        $_FILES  = $this->_files;
        $_SERVER = $this->_server;

        unset($this->_files);
        unset($this->_request);
        unset($this->_server);
    }

    public function testIssetChecksForDataInTheFilesSuperglobal()
    {
        $_FILES['test'] = 'asdf';

        $this->assertFalse(isset($this->_request->nonexistant));
        $this->assertTrue(isset($this->_request->test));
    }

    public function testFileDataCanBeRetrievedViaAccessors()
    {
        $_FILES['test'] = 'asdf';

        $this->assertSame($_FILES['test'], $this->_request->test);
        $this->assertSame($_FILES['test'], $this->_request->getFile('test'));
    }

    public function testDefaultDataIsReturnedWhenNoFileIsFound()
    {
        $this->assertEquals('asdf', $this->_request->getFile('test', 'asdf'));
    }

    public function testAllDataCanBeRetrieved()
    {
        $_FILES = array('asdf');

        $this->assertSame($_FILES, $this->_request->getFile());
    }

    public function testSslStatusCanBeRetrieved()
    {
        $_SERVER['HTTPS'] = 'on';
        $this->assertTrue($this->_request->isSsl());

        $_SERVER['HTTPS'] = 'off';
        $this->assertFalse($this->_request->isSsl());

        unset($_SERVER['HTTPS']);
        $this->assertFalse($this->_request->isSsl());
    }

}
