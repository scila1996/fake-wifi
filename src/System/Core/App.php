<?php

namespace System\Core;

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;
use Illuminate\Database\Capsule\Manager;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use System\Libraries\View\View;
use ErrorException;
use Exception;

class App
{

    /** @var array */
    public static $path = [
        'view' => 'src/App/Views',
        'controller' => '\\App\\Controllers'
    ];

    /** @var array */
    public static $config = [
        'route' => 'src/App/Config/Route.php',
        'database' => 'src/App/Config/Database.php'
    ];

    /**
     * Run Application
     * 
     * @return void
     */
    public static function run()
    {
        set_error_handler(function($severity, $message, $file, $line) {
            throw new ErrorException($message, $severity, $severity, $file, $line);
        });

        include_once 'src/App/Config/System.php';
        self::sysconfig();

        try
        {
            $container = new Container();
            $request = $container->request = ServerRequest::fromGlobals();
            $response = $container->response = new Response();
            $view = $container->view = (new View())->setTemplateDir(self::$path['view']);
            $container->session = new Session();

            Config::$route = new RouteCollector();

            foreach (self::$config as $config)
            {
                require $config;
            }

            if (Config::$database)
            {
                self::databaseconfig();
            }

            $handler = new Handler($container, self::$path['controller']);
            $dispatcher = new Dispatcher(Config::$route->getData(), $handler);
            $data = $dispatcher->dispatch(
                    $request->getMethod(), $request->getUri()->getPath()
            );

            if ($data instanceof Response)
            {
                $response = $data;
            }
            else
            {
                $response->getBody()->write($data ? strval($data) : $handler->controller->view->getContent());
            }

            if ($response->getStatusCode() == 404)
            {
                throw new HttpRouteNotFoundException($response->getReasonPhrase());
            }
        }
        catch (HttpRouteNotFoundException $e)
        {
            $response = $response->withStatus(404);
            $response->getBody()->write($view->setFileExtension('php')->set('error/404')->render());
        }
        catch (Exception $e)
        {
            $view->setFileExtension('php');
            $view->set('error/' . ['log', 'debug'][intval(boolval(Config::$debug))])['e'] = $e;
            $response->getBody()->write($view->render());
        }

        self::send($response);
    }

    protected static function sysconfig()
    {
        // TimeZone
        date_default_timezone_set(Config::$timezone);
    }

    protected static function databaseconfig()
    {

        $capsule = new Manager;

        $capsule->addConnection(Config::$database);

        $capsule->setEventDispatcher(new \Illuminate\Events\Dispatcher(
                new \Illuminate\Container\Container()
        ));

        $capsule->setAsGlobal();

        $capsule->bootEloquent();
    }

    /**
     * 
     * @param Response $response
     * @return void
     */
    protected static function send(Response $response)
    {
        // STATUS CODE
        http_response_code($response->getStatusCode());

        // Headers
        foreach ($response->getHeaders() as $name => $values)
        {
            foreach ($values as $value)
            {
                header("{$name}: {$value}", false);
            }
        }

        // content
        echo $response->getBody();
        return;
    }

}
