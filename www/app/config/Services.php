<?php

namespace App\config;

use App\controllers\ApiController;
use App\controllers\FrontController;
use App\services\ChatRepository;
use App\services\UserRepository;
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:10 PM
 */
class Services {

    public static function registerServices(Application &$app) {

        $app->register(new ServiceControllerServiceProvider());

        $app['UserRepository'] = function() use ($app) {
            return new UserRepository(
                $app['DB']
            );
        };

        $app['ChatRepository'] = function() use ($app) {
            return new ChatRepository(
                $app['DB']
            );
        };

        $app['FrontController'] = function() use ($app) {
            return new FrontController();
        };

        $app['ApiController'] = function() use ($app) {
            return new ApiController(
                $app['UserRepository'],
                $app['ChatRepository']
            );
        };

    }

}