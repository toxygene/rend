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
 * @package Base
 * @copyright 2008-2009 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Interface */
require_once "Rend/Base/Interface.php";

/**
 * @category Rend
 * @package Base
 */
abstract class Rend_Base_Abstract implements Rend_Base_Interface
{

    /**
     * Constructor
     *
     * @param array|Zend_Config $config
     */
    public function __construct($config = null)
    {
        if ($config instanceof Zend_Config) {
            $this->setConfig($config);
        } elseif (is_array($config)) {
            $this->setOptions($config);
        }
    }

    /**
     * Set the options from a Zend_Config object
     *
     * @param Zend_Config $config
     * @return Rend_Base_Abstract
     */
    public function setConfig(Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set the options from an array
     *
     * @param array $options
     * @return Rend_Base_Abstract
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = "set" . ucFirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}
