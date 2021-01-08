<?php
/**
 * User: xEiBi
 * Date: 21/12/2020
 * Time: 01:19 a. m.
 */

namespace app\core;

/**
 * Class Router
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\core
 */
class Router
{
    public Request $request;
    public Response $response;
    // This is an Associative array. ej:
    protected array $routes;
    //$routes = [
    //    'get' => [
    //        '/' => some callback,
    //        '/contact' => other callback
    //    ],
    //    'post' => [same]
    //];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        // Instance class with their methods
        $this->response = $response;
        $this->request = $request;
    }

    // Method allow to get the url and applied a corresponded function
    public function get($path, $callback)
    {
        // $routes = ['get' => [$path => $callback]]
        $this->routes['get'][$path] = $callback;
    }

    // Method allow to post the url and applied a corresponded function
    public function post($path, $callback)
    {
        // $routes = ['post' => [$path => $callback]]
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        // Obtain clear path
        $path = $this->request->getPath();
        // Obtain lower cased method
        $method = $this->request->method();
        // Obtain corresponded function. Ej: $routes['get']['/create'];
        $callback = $this->routes[$method][$path] ?? false;
        // if no exist corresponded function render error template
        if ($callback === false) {
            // Call method into response instance and send status of the page
            $this->response->setStatusCode(404);
            // return 404 error content template
            return $this->renderView('_404');
        }
        // Is the variable callback is a string applied this method
        if (is_string($callback)) {
            // Call method to obtain template
            return $this->renderView($callback);
        }
        // Is the variable callback is a array/function applied this method
        if (is_array($callback)) {
            // Save public variables of the class in controller variable
            Application::$app->controller = new $callback[0]();
            // Rewrite the class for a instance of that class in the same position
            $callback[0] = Application::$app->controller;
        }
        // This applied the function inside the object class in the array
        // Ej: [object/instance with the method, function of that class]
        // Request is for avoid error for few parameters
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        // Call layout template before content with the method
        $layoutContent = $this->layoutContent();
        // Call template content with the method
        $viewContent = $this->renderOnlyView($view, $params);
        // Replace {{content}} with the content template inside the layout and returned
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        // Call value of the layout variable in the controller
        $layout = Application::$app->controller->layout;
        // Save in a buffer the content after is declared
        ob_start();
        // Call the main template (header, footer)
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        // Return the buffer an cleaned
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        // The include will see the variables declares
        foreach ($params as $key => $value) {
            // $$key create a variable with the value of key
            $$key = $value;
        }
        // Save in a buffer the content after is declared
        ob_start();
        // Call the content template (body)
        include_once Application::$ROOT_DIR."/views/$view.php";
        // Return the buffer an cleaned
        return ob_get_clean();
    }
}