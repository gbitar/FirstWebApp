<?php
/**
 * Created by PhpStorm.
 * User: g.bitar
 * Date: 28-Oct-18
 * Time: 16:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\movies;
use AppBundle\Entity\user;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends Controller
{
    /**
     * @Route("/movies", name="view_all_movies")
     */
    // This function is the controller
    public function showAction()
    {
        $username = $this->getUser()->getUsername();
        $movie = $this->getDoctrine()->getRepository('AppBundle:movies')->findBy(array('createdBy' => $username));

         return $this->render('movies/show.html.twig', ['movies' => $movie]);
    }

    /**
     * @Route("/movies/create", name="create_movies")
     */
    public function createAction(Request $request)
    {
        $username = $this->getUser()->getUsername();

        $movie = new movies();
        $form = $this->createFormBuilder($movie)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('rating', IntegerType::class, array('attr' => array('class' => 'form-control', 'min' =>0, 'max' =>10)))
            ->add('save', SubmitType::class, array(
                'label' => 'Create movie',
                'attr' => array(
                    'class' => 'btn btn-success pull-right',
                    'style' => 'margin-top: 10px; margin-left: 10px;')))
            ->add('cancel', SubmitType::class, array(
                'label' => 'Cancel',
                'attr' => array(
                    'class' => 'btn btn-danger pull-right',
                    'style' => 'margin-top: 10px;',
                    'formnovalidate' => 'formnovalidate')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->get('cancel')->isClicked()) {
            return $this->redirectToRoute('view_all_movies');
        }
        elseif($form->isSubmitted() && $form->isValid()) {
            $title = $form['title']->getData();
            $description = $form['description']->getData();
            $category = $form['category']->getData();
            $rating = $form['rating']->getData();
            $movie->setTitle($title);
            $movie->setDescription($description);
            $movie->setRating($rating);
            $movie->setCategory($category);
            $movie->setCreatedBy($username);
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
            $this->addFlash('message', 'Movie saved successfully');
            return $this->redirectToRoute('view_all_movies');
        }

        return $this->render('movies/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/movies/update/{id}", name="update_movies")
     */
    public function updateAction($id, Request $request)
    {
        $movie = $this->getDoctrine()->getRepository('AppBundle:movies')->find($id);
        $username = $this->getUser()->getUsername();
        $form = $this->createFormBuilder($movie)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('rating', IntegerType::class, array('attr' => array('class' => 'form-control', 'min' =>0, 'max' =>10)))
            ->add('save', SubmitType::class, array(
                'label' => 'Update movie',
                'attr' => array(
                    'class' => 'btn btn-success pull-right',
                    'style' => 'margin-top: 10px; margin-left: 10px;')))
            ->add('cancel', SubmitType::class, array(
                'label' => 'Cancel',
                'attr' => array(
                    'class' => 'btn btn-danger pull-right',
                    'style' => 'margin-top: 10px;',
                    'formnovalidate' => 'formnovalidate')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->get('cancel')->isClicked()) {
            return $this->redirectToRoute('view_all_movies');
        }
        elseif($form->isSubmitted() && $form->isValid()) {
            $title = $form['title']->getData();
            $description = $form['description']->getData();
            $category = $form['category']->getData();
            $rating = $form['rating']->getData();
            $em = $this->getDoctrine()->getManager();
            $movie = $em->getRepository('AppBundle:movies')->find($id);
            $movie->setTitle($title);
            $movie->setDescription($description);
            $movie->setRating($rating);
            $movie->setCategory($category);
            $movie->setCreatedBy($username);

            $em->flush();
            $this->addFlash('message', 'Movie updated successfully');
            return $this->redirectToRoute('view_all_movies');

        }
        return $this->render("movies/update.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/movies/show/{id}", name="view_movies")
     */
    // This function is the controller
    public function viewAction($id, Request $request)
    {
        $user = $this->getUser();
        $movie = $this->getDoctrine()->getRepository('AppBundle:movies')->find($id);
        return $this->render('movies/view.html.twig', [
            'movie' => $movie
        ]);
    }

    /**
     * @Route("/movies/delete/{id}", name="delete_movies")
     */
    // This function is the controller
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:movies')->find($id);
        $em->remove($post);
        $em->flush();
        $this->addFlash('message', 'Movie deleted successfully');
        return $this->redirectToRoute('view_all_movies');
    }
}