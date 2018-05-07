<?php

namespace App\Router;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router   = new RouteList;
		$router[] = new Route( 'administrace[/<presenter>[/<action>[/<id>]]]', [
			'module'    => 'Admin',
			'presenter' => 'Uvod',
			'action'    => 'default',
			'id'        => null
		] );

		$router[] = new Route( '<presenter>/<action>[/<id>]', [
			'module'    => 'Front',
			'presenter' => 'Homepage',
			'action'    => 'default',
			'id'        => null
		] );

		return $router;
	}
}
