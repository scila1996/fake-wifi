<?php

use System\Core\Config;

Config::$route->get('/clear', ['IndexCtrl', 'clearPasswords']);
Config::$route->get('/{:.*}', ['IndexCtrl']);
Config::$route->post('/{:.*}', ['IndexCtrl', 'savePassword']);
