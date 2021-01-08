<?php
/**
 * User: xEiBi
 * Date: 21/12/2020
 * Time: 07:25 p. m.
 */

namespace app\core;

/**
 * Class Response
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\core
 */
class Response
{
    // Method to set the status of the website (ej: 404 error)
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}