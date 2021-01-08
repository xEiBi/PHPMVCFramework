<?php
/**
 * User: xEiBi
 * Date: 20/12/2020
 * Time: 09:08 p. m.
 */

namespace app\core;

/**
 * Class Application
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    // Call al Router class with their methods
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;

    public function __construct($rootPath)
    {
        // Save in static variable the root path of the website
        self::$ROOT_DIR = $rootPath;
        // Instance the self class for use in others classes
        self::$app = $this;
        // Instance of the object Request
        $this->request = new Request();
        // Instance of the object Response
        $this->response = new Response();
        // Pass request and response instance as a parameter of Router class
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        // Applied the resolve method of router
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}