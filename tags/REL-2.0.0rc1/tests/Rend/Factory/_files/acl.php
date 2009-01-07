<?php
$acl->addRole(new Zend_Acl_Role("role1"))
    ->add(new Zend_Acl_Resource("resource"))
    ->allow("role1", "resource", "privilege");