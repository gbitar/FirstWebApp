<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\user;
use AppBundle\Form\userType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     * @param Request $Request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $Request, UserPasswordEncoderInterface $encoder)
    {
        $em =$this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($Request);

        if($form->isSubmitted() &&  $form->isValid()){
            // Create the user
            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('Login');
        }

        return $this->render('register/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
