<?php

namespace BL\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function indexAction()
    {
        return new Response("welcome my fist model");
    }

    
}
