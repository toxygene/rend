<?php
/**
 *
 */

/**
 *
 */
class Rend_RandomTest extends PHPUnit_Framework_TestCase
{

    public function testSomething()
    {
        $random = new Rend_Random();
        
        $this->assertEquals(
            8,
            strlen($random->getString())
        );
    }

}
