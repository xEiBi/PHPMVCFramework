<?php
/**
 * User: xEiBi
 * Date: 21/12/2020
 * Time: 02:11 a. m.
 */

namespace app\core;

/**
 * Class Request
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\core
 */
class Request
{
    public function getPath()
    {
        // Obtain the actual url if not available select the main domain
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        // Obtain the info before the question mark
        $position = strpos($path, '?');
        // If not exist question mark with parameters return actual path
        if ($position === false) return $path;
        // If have parameters delete them an return that new path
        return substr($path, 0, $position);
    }

    public function method()
    {
        // Return the method (get, post) in lower cased string
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        // Return true or false is the method is the same
        return $this->method() === 'get';
    }

    public function isPost()
    {
        // Return true or false is the method is the same
        return $this->method() === 'post';
    }

    public function getBody()
    {
        $body = [];
        if ($this->isGet()) {
            // Obtain the value of the each key in the GET
            foreach ($_GET as $key => $value) {
                // Filter especial characters in the value of each key
                // Save all keys with their respective values inside body array
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            // Obtain the value of the each key in the GET
            foreach ($_POST as $key => $value) {
                // Filter especial characters in the value of each key
                // Save all keys with their respective values inside body array
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}