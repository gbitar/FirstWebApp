<?php
/**
 * Created by PhpStorm.
 * User: g.bitar
 * Date: 28-Oct-18
 * Time: 16:10
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    // to add a route we will be using annotations
    // @Route("/tracker") is a hard coded path we add { to make it dynamic
    /**
     * @Route("/tracker")
     */
    // This function is the controller
    public function showAction()
    {
        $user = $this->getUser();
        $notes = [
        'bisi bisi miaw',
        'oume dawwi l daw'
    ];
        // getting a template
         return $this->render('genus/show.html.twig', [
             'notes' => $notes
         ]);
    }
}