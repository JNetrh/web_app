<?php

namespace App\Model;

use Nette\Security\Permission;

class AuthorizatorFactory {

    /**
    * @return \Nette\Security\IAuthorizator
    */
    public function create() {
        $permission = new Permission();

        // public boolean isAllowed( string $role, string $resource, string $privilege )

        /* seznam uživatelských rolí */
	    $permission->addRole('admin');
        $permission->addRole('authenticated');

        /* seznam zdrojů */
        $permission->addResource('Admin:Uvod');
        $permission->addResource('Admin:');


	    /* zákldní pole zdrojů */
        $basicArray = array('Admin:', 'Admin:Uvod');


	    /* zákldní pole práv */
        $defaultPrivileges = array('default', 'detail', 'logout');

	    /* přiřazení základních oprávnění */
	    $permission->allow('admin', $basicArray, $defaultPrivileges);



        $managePrivileges = array('create','delete','edit', 'handle', 'new');

	    /* ADMIN má práva na všechno */
	    $permission->allow('admin', $basicArray, $managePrivileges);
	    $permission->allow('admin', Permission::ALL, Permission::ALL);


        return $permission;
    }

}