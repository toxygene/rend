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

/** Rend_FactoryLoader */
require_once "Rend/FactoryLoader.php";

/** Zend_Config */
require_once "Zend/Config.php";

/**
 * @category Rend
 * @subpackage UnitTest
 */
class Rend_FactoryLoaderTest extends PHPUnit_Framework_TestCase
{

    private $_factoryLoader;

    protected function setUp()
    {
        $this->_factoryLoader = new Rend_FactoryLoader();
    }

    public function testPrefixPathsAreCustomizable()
    {
        $config = new Zend_Config(array(
            "prefixPaths" => array("Test" => "Test"),
            "factories"   => array(
            )
        ));

        $factoryLoader = new Rend_FactoryLoader($config);

        $this->assertEquals(
            array("Test/"),
            $factoryLoader->getPaths("Test")
        );

        $factoryLoader = new Rend_FactoryLoader($config->toArray());

        $this->assertEquals(
            array("Test/"),
            $factoryLoader->getPaths("Test")
        );
    }

    public function testFactoriesCanBeManuallyAdded()
    {
        $factory = $this->getMock("Rend_Factory_Interface");

        $factoryLoader = new Rend_FactoryLoader(array(
            "factories" => array(
                "test" => $factory
            )
        ));

        $this->assertSame(
            $factory,
            $factoryLoader->getFactory("test")
        );
    }

    public function testFactoriesCanBeBuiltFromArrayDefinitions()
    {
        $factory = $this->getMock(
            "Rend_Factory_Interface",
            array(),
            array(),
            "Test_Factory_TestOne"
        );

        $factoryLoader = new Rend_FactoryLoader(array(
            "prefixPaths" => array("Test_Factory" => "Test/Factory"),
        	"factories" => array(
                "test" => array(
                    "type" => "TestOne"
                )
            )
        ));

        $this->assertType(
            "Test_Factory_TestOne",
            $factoryLoader->getFactory("test")
        );
    }

    public function testFactoriesCanBeSetAndFetchedFromTheMagicMethods()
    {
        $factory = $this->getMock(
            "Rend_Factory_Interface",
            array(),
            array(),
            "Test_Factory_TestTwo"
        );

        $factoryLoader = new Rend_FactoryLoader(array(
            "prefixPaths" => array("Test_Factory" => "Test/Factory")
        ));

        $factoryLoader->test = $factory;

        $this->assertTrue(
            isset($factoryLoader->test)
        );

        $this->assertEquals(
            $factory,
            $factoryLoader->test
        );
    }

    public function testObjectsCanBeLoadedDirectlyFromTheirFactories()
    {
        $mock = $this->getMock(
            "Rend_Factory_Interface",
            array("create"),
            array(),
            "Test_Factory_TestThree"
        );

        $mock->expects($this->once())
             ->method("create")
             ->will($this->returnValue("test"));

        $factoryLoader = new Rend_FactoryLoader(array(
            "factories" => array(
                "test" => $mock
            )
        ));

        $factoryLoader->test();
    }

    public function testFactoriesCanBeCreatedWithOptions()
    {
        $factoryLoader = new Rend_FactoryLoader(array(
        	"factories" => array(
                "test" => array(
                    "type" => "TestFour",
                    "options" => array(
                        "test" => "test"
                    )
                )
            ),
            "prefixPaths" => array("Test_Factory" => "Test/Factory")
        ));

        $this->assertEquals(
            "test",
            $factoryLoader->test()
        );
    }

    public function testGettingANonExistantFactoryThrowsAnException()
    {
        $this->setExpectedException("Rend_FactoryLoader_Exception");
        $factoryLoader = new Rend_FactoryLoader();
        $factoryLoader->getFactory("test");
    }

    public function testFactoriesCanBeRemoved()
    {
        $this->setExpectedException("Rend_FactoryLoader_Exception");

        $factory = $this->getMock("Rend_Factory_Interface");

        $factoryLoader = new Rend_FactoryLoader(array(
            "factories" => array(
                "test" => $factory
            )
        ));

        unset($factoryLoader->test);

        $factoryLoader->test;
    }

}

class Test_Factory_TestFour extends Rend_Base_Abstract implements Rend_Factory_Interface
{

    public $test;

    public function create()
    {
        return $this->test;
    }

    public function setTest($test)
    {
        $this->test = $test;
    }

}
