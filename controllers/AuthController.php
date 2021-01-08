<?php
/**
 * User: xEiBi
 * Date: 23/12/2020
 * Time: 04:05 p. m.
 */

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

/**
 * Class AuthController
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\controllers
 */
class AuthController extends Controller
{
    public function login()
    {
        // Chains the main template
        $this->setLayout('auth');
        // Render content template login
        return $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        // Chains the main template
        $this->setLayout('auth');
        // Render content template register
        return $this->render('register');
    }
}