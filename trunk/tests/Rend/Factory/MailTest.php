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

/** Rend_Factory_Mail */
require_once "Rend/Factory/Mail.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_Factory_MailTest extends PHPUnit_Framework_TestCase
{

    private $_factory;

    public function setUp()
    {
        $this->_factory = new Rend_Factory_Mail();
    }

    public function testCcIsConfigurable()
    {
        $mail = $this->_factory
                     ->setCcs(array("cc1@example.org", "cc2@example.org"))
                     ->create();

        $this->assertEquals(
            array("cc1@example.org", "cc2@example.org"),
            $mail->getRecipients()
        );
    }

    public function testCcEmailAndNameAreConfigurable()
    {
        $mail = $this->_factory
                     ->setCcs(array(array("email" => "cc1@example.org", "name" => "Test")))
                     ->create();

        $this->assertEquals(
            array("cc1@example.org"),
            $mail->getRecipients()
        );
    }

    public function testBccIsConfigurable()
    {
        $mail = $this->_factory
                     ->setBccs(array("bcc1@example.org", "bcc2@example.org"))
                     ->create();

        $this->assertEquals(
            array("bcc1@example.org", "bcc2@example.org"),
            $mail->getRecipients()
        );
    }

    public function testDateIsConfigurable()
    {

        $mail = $this->_factory
                     ->setDate("Wed, 01 Jan 1992 00:00:00 -0600")
                     ->create();

        $this->assertEquals(
            "Wed, 01 Jan 1992 00:00:00 -0600",
            $mail->getDate()
        );
    }

    public function testCreateReturnsMailObject()
    {
        $this->assertType(
            "Zend_Mail",
            $this->_factory
                 ->create()
        );
    }

    public function testCharsetIsConfigurable()
    {
        $mail = $this->_factory
                     ->setCharset("UTF-8")
                     ->create();

        $this->assertEquals(
            "UTF-8",
            $mail->getCharset()
        );
    }

    public function testFromAddressIsConfigurable()
    {
        $mail = $this->_factory
                     ->setFrom("jhendric@rendframework.com")
                     ->create();

        $this->assertEquals(
            "jhendric@rendframework.com",
            $mail->getFrom()
        );
    }

    public function testFromAddressAndNameIsConfigurable()
    {
        $mail = $this->_factory
                     ->setFrom(array("email" => "jhendric@rendframework.com", "name" => "Justin Hendrickson"))
                     ->create();

        $this->assertEquals(
            "jhendric@rendframework.com",
            $mail->getFrom()
        );

        $headers = $mail->getHeaders();

        $this->assertEquals(
            "Justin Hendrickson <jhendric@rendframework.com>",
            $headers["From"][0]
        );
    }

    public function testHeadersAreConfigurable()
    {
        $mail = $this->_factory
                     ->setHeaders(array("X-Test" => "asdf"))
                     ->create();

        $headers = $mail->getHeaders();

        $this->assertEquals(
            "asdf",
            $headers["X-Test"][0]
        );
    }

    public function testReturnPathIsConfigurable()
    {
        $mail = $this->_factory
                     ->setReturnPath("jhendric@rendframework.com")
                     ->create();

        $this->assertEquals(
            "jhendric@rendframework.com",
            $mail->getReturnPath()
        );
    }

    public function testSubjectIsConfigurable()
    {
        $mail = $this->_factory
                     ->setSubject("subject")
                     ->create();

        $this->assertEquals(
            "subject",
            $mail->getSubject()
        );
    }

    public function testToIsConfigurable()
    {
        $mail = $this->_factory
                     ->setTos(array("to1@example.org", "to2@example.org"))
                     ->create();

        $this->assertEquals(
            array("to1@example.org", "to2@example.org"),
            $mail->getRecipients()
        );
    }

    public function testToAndNameIsConfigurable()
    {
        $mail = $this->_factory
                     ->setTos(array(array("email" => "to@example.org", "name" => "To!")))
                     ->create();

        $this->assertEquals(
            array("to@example.org"),
            $mail->getRecipients()
        );

        $headers = $mail->getHeaders();

        $this->assertEquals(
            "To! <to@example.org>",
            $headers["To"][0]
        );
    }

}
