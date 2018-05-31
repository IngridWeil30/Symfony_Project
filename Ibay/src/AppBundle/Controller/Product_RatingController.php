<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product_Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Product_rating controller.
 *
 * @Route("product_rating")
 */
class Product_RatingController extends Controller
{
    /**
     * Lists all product_Rating entities.
     *
     * @Route("/", name="product_rating_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $product_Ratings = $em->getRepository('AppBundle:Product_Rating')->findAll();

        return $this->render('product_rating/index.html.twig', array(
            'product_Ratings' => $product_Ratings,
        ));
    }

    /**
     * Creates a new product_Rating entity.
     *
     * @Route("/new", name="product_rating_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product_Rating = new Product_rating();

        $form = $this->createForm('AppBundle\Form\Product_RatingType', $product_Rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product_Rating);
            $em->flush();

            return $this->redirectToRoute('product_rating_show', array('id' => $product_Rating->getId()));
        }

        return $this->render('product_rating/new.html.twig', array(
            'product_Rating' => $product_Rating,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product_Rating entity.
     *
     * @Route("/{id}", name="product_rating_show")
     * @Method("GET")
     */
    public function showAction(Product_Rating $product_Rating)
    {
        $deleteForm = $this->createDeleteForm($product_Rating);

        return $this->render('product_rating/show.html.twig', array(
            'product_Rating' => $product_Rating,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product_Rating entity.
     *
     * @Route("/{id}/edit", name="product_rating_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product_Rating $product_Rating)
    {
        $deleteForm = $this->createDeleteForm($product_Rating);
        $editForm = $this->createForm('AppBundle\Form\Product_RatingType', $product_Rating);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_rating_edit', array('id' => $product_Rating->getId()));
        }

        return $this->render('product_rating/edit.html.twig', array(
            'product_Rating' => $product_Rating,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product_Rating entity.
     *
     * @Route("/{id}", name="product_rating_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product_Rating $product_Rating)
    {
        $form = $this->createDeleteForm($product_Rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product_Rating);
            $em->flush();
        }

        return $this->redirectToRoute('product_rating_index');
    }

    /**
     * Creates a form to delete a product_Rating entity.
     *
     * @param Product_Rating $product_Rating The product_Rating entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product_Rating $product_Rating)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_rating_delete', array('id' => $product_Rating->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
