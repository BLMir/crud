<?php

namespace BL\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BL\UserBundle\Entity\User;
use BL\UserBundle\Form\UserType;


class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BLUserBundle:User')->findAll();

        // $res = "User List <br />";

        // foreach ($users as $key => $user) {
        // 	$res .= 'Ususer : ' . $user->getUsername() . '- email: ' . $user->getEmail() . '<br/>';
        // }
        // return new Response($res);

        return $this->render('BLUserBundle:User:index.html.twig',  array('users' => $users ));
    }

    public function addAction()
    {
    	$user = new User();
    	$form = $this->createCreateForm($user);



    	return $this->render('BLUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }

    private function createCreateForm(User $entity)
    {
    	$form = $this->createForm(new UserType(), $entity, array(
    			'action' => $this->generateUrl('bl_user_create'),
    			'method' => 'POST'
    		));
    	return $form;
    }
  
    public function createAction(Request $request)
    {
    	$user = new User();
    	$form = $this->createCreateForm($user);
    	$form->handleRequest($request);

    	if($form->isValid())
    	{
    		$password = $form->get('password')->getData();
    		$encoder = $this->container->get('security.password_encoder');
    		$encoder = $encoder->encodePassword($user,$password);

    		$user->setPassword($encoder);

    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();

    		return $this->redirectToRoute('bl_user_index');
    	}

    	return $this->render('BLUserBundle:User:add.html.twig', array('form' => $form->createView()));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BLUserBundle:User')->find($id);

		$res = 'Ususer : ' . $user->getUsername() . '- email: ' . $user->getEmail() . '<br/>';

        return new Response($res);
    }

}
