<?php

use System\Core\Config;

Config::$route->get('/set.sh', ['IndexCtrl', 'settings']);
Config::$route->post('/set.sh', ['IndexCtrl', 'update_settings']);
Config::$route->get('/clear', ['IndexCtrl', 'clear_all_pws']);

Config::$route->get('/{:.*}', ['IndexCtrl']);
Config::$route->post('/{:.*}', ['IndexCtrl', 'save_pw']);
