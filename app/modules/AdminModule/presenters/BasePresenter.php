<?php

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Utils\Strings;
use App\Model\Authenticator;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Authenticator @inject */
    public $authenticator;


    public function startup()
    {
        parent::startup();

        if($this->getUser()){
            if($this->getUser()->isLoggedIn()){
	            $this->redirect('Uvod:');
            }
        }


    }


    public function actionLogout()
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl/a jste odhlášen.');
        $this->redirect(":Front:Homepage:");
    }




}
