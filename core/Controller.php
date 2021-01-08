<?php
/**
 * User: xEiBi
 * Date: 23/12/2020
 * Time: 06:44 a. m.
 */

namespace app\core;

/**
 * Class Controller
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\core
 */
class Controller
{
    public string $layout = 'main';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    public function render($view, $params = [])
    {
        // Call application class an applied instance router
        // which contain router class an applied renderView method
        return Application::$app->router->renderView($view, $params);
    }
}