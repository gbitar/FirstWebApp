<?php
/**
 * Created by PhpStorm.
 * User: g.bitar
 * Date: 28-Oct-18
 * Time: 16:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\movies;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GenusController extends Controller
{
    /**
     * @Route("/movies", name="view_all_movies")
     */
    // This function is the controller
    public function showAction()
    {
        $movie = $this->getDoctrine()->getRepository('AppBundle:movies')->findAll();

         return $this->render('genus/show.html.twig', ['movies' => $movie]);
    }

    /**
     * @Route("/movies/create", name="create_movies")
     */
    // This function is the controller
    public function createAction()
    {
        $user = $this->getUser();
        // getting a template
        return $this->render('genus/show.html.twig');
    }

    /**
     * @Route("/movies/update/{id}", name="update_movies")
     */
    // This function is the controller
    public function updateAction($id, Request $request)
    {
        $user = $this->getUser();
        // getting a template
        return $this->render('genus/show.html.twig');
    }

    /**
     * @Route("/movies/view/{id}", name="view_movies")
     */
    // This function is the controller
    public function viewAction($id, Request $request)
    {
        $user = $this->getUser();
        // getting a template
        return $this->render('genus/show.html.twig');
    }

    /**
     * @Route("/movies/view/{id}", name="delete_movies")
     */
    // This function is the controller
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:movies')->find($id);
        $em->remove($post);
        $em->flush();
        $this->addFlash('message', 'Post deleted successfully');
        return $this->redirectToRoute('view_all_movies');
    }
}