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
 * @package Factory
 * @copyright 2008 Justin Hendrickson
 * @license http://www.rendframework.com/license.html New BSD License
 * @link http://www.rendframework.com/
 * @since 2.0.0
 * @version $Id$
 */

/** Rend_Base_Abstract */
require_once "Rend/Base/Abstract.php";

/** Rend_Factory_AuthStorage_Interface */
require_once "Rend/Factory/AuthStorage/Interface.php";

/**
 * @category Rend
 * @package Factory
 */
class Rend_Factory_AuthStorage_NonPersistent extends Rend_Base_Abstract implements Rend_Factory_AuthStorage_Interface
{

    /**
     * Create a non-persistent storage
     *
     * @return Zend_Auth_Storage_NonPersistent
     */
    public function create()
    {
        /** Zend_Auth_Storage_NonPersistent */
        require_once "Zend/Auth/Storage/NonPersistent.php";

        return new Zend_Auth_Storage_NonPersistent();
    }

}
