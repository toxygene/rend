<?php
/**
 *
 */

/** Rend_Factory_Interface */
require_once 'Rend/Factory/Interface.php';

/**
 *
 */
abstract class Rend_Factory_Abstract implements Rend_Factory_Interface
{

    /**
     * Get the factory name
     *
     * @return string
     */
    public function getName()
    {
        $classname = get_class($this);

        if (preg_match('/.*_(.*)/', $classname, $matches)) {
            return $matches[1];
        }

        return $classname;
    }

}
