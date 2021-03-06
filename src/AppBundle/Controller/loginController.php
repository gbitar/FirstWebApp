<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class loginController extends Controller
{
    /**
     * @Route("/Login", name="Login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationutils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationutils)
    {
        $errors = $authenticationutils->getLastAuthenticationError();

        $lastUserName = $authenticationutils->getLastUsername();

        return $this->render('login/login.html.twig', array(
            'errors' => $errors,
            'username' => $lastUserName
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {


    }
}
