<?php

namespace BL\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BLUserBundle:User')->findAll();

        $res = "User List <br />";

        foreach ($users as $key => $user) {
        	$res .= 'Ususer : ' . $user->getUsername() . '- email: ' . $user->getEmail() . '<br/>';
        }
        return new Response($res);
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BLUserBundle:User')->find($id);

		$res = 'Ususer : ' . $user->getUsername() . '- email: ' . $user->getEmail() . '<br/>';

        return new Response($res);
    }

}
