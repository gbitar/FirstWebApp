<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class loginController extends Controller
{
    /**
     * @Route("/Login", name="Login")
     */
    public function showAction()
    {
        return $this->render('login/login.html.twig', array(
            // ...
        ));
    }

}
