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

/** Rend_Factory */
require_once 'Rend/Utilities.php';

/**
 *
 */
class Rend_UtilitiesTest extends PHPUnit_Framework_TestCase
{

    public function testGenerateRandomStringReturnsAnEightCharacterRandomStringOfPrintableCharacters()
    {
        $result = Rend_Utilities::generateRandomString();

        $this->assertTrue(strlen($result) == 8);
        for ($i = 0; $i < strlen($result); ++$i) {
            $this->assertTrue(in_array($result[$i], str_split(Rend_Utilities::$printableCharacters)));
        }
    }

    public function testGenerateRandomStringSizeIsChangable()
    {
        $this->assertTrue(strlen(Rend_Utilities::generateRandomString(2)) == 2);
    }

    public function testGenerateRandomStringCharactersIsChangable()
    {
        $characters = 'a(2c';
        $result = Rend_Utilities::generateRandomString(8, $characters);

        $this->assertTrue(strlen($result) == 8);
        for ($i = 0; $i < strlen($result); ++$i) {
            $this->assertTrue(in_array($result[$i], str_split($characters)));
        }
    }

}
