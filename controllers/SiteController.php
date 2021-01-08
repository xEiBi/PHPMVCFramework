<?php
/**
 * User: xEiBi
 * Date: 23/12/2020
 * Time: 04:55 a. m.
 */

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * Class SiteController
 *
 * @author Alejandro Rea <xeibij@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    // Contact form that past the information with post method
    public function home()
    {
        $params = [
            'name' => 'xEiBi'
        ];

        return $this->render('home', $params);
    }

    public function contact()
    {
        // Call application class an applied instance router
        // which contain router class an applied renderView method
        return $this->render('contact');
    }

    public function handleContact(Request $request)
    {
        // Obtain filter data in a associative array
        $body = $request->getBody();
        return 'Handling submitted data';
    }
}