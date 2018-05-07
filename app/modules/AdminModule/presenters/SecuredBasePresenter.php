<?php

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Utils\Strings;
use App\Model\Services\UserService;


/**
 * Base presenter for all application presenters.
 */
abstract class SecuredBasePresenter extends Nette\Application\UI\Presenter
{

    public $firstName;
    public $lastName;

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

	public function startup()
    {
        parent::startup();

        if($this->user){
            if(!$this->getUser()->isLoggedIn()){
                $this->redirect('Sign:in');
            }
            if (!$this->user->isAllowed($this->name, $this->action)) {
                $this->flashMessage('Access denied');
                $this->redirect(Strings::substring($this->name.':', 6));
            }
        }
        else{
            $this->redirect('Sign:in');
        }




    }
    public function beforeRender()
    {
        parent::beforeRender();

	    $this->firstName = $this->user->getIdentity()->name;
        $this->lastName = $this->user->getIdentity()->surname;

        $this->template->firstName = $this->firstName;
        $this->template->lastName = $this->lastName;
    }

    public function actionLogout()
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl/a jste odhlášen.');
        $this->redirect(":Front:Homepage:");
    }

    public function afterRender()
    {
        if ($this->isAjax() && $this->hasFlashSession()) {
            $this->redrawControl('flashes');
        }
    }

    public function getUserName($name){
        $name == 'first' ? $this->firstName : $this->lastName;
    }

}
