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
        $factory = $this->getMock("Rend_FactoryLoader_Factory_Interface");

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

}
