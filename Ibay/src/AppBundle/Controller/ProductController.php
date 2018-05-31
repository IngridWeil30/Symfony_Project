<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bidding;
use AppBundle\Entity\Product_Rating;
use AppBundle\Repository\Product_RatingRepository;
use AppBundle\Repository\ProductRepository;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        } else {
            $em = $this->getDoctrine()->getManager();

            $products = $em->getRepository('AppBundle:Product')->findAll();

            return $this->render('product/index.html.twig', array(
                'products' => $products,
            ));
        }

    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('AppBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        $product_Rating = new Product_Rating();
        $product_Rating->setUser($this->getUser());
        $product_Rating->setProduct($product);
        $rating_form = $this->createForm('AppBundle\Form\Product_RatingType', $product_Rating);
        $rating_form->handleRequest($request);

        if ($rating_form->isSubmitted() && $rating_form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product_Rating);
            $em->flush();
        }

        $bidding = new Bidding();
        $bidding->setProducts($product);
        $bidding->setUserBidder($this->getUser());
        $bidding_form = $this->createForm('AppBundle\Form\BiddingType', $bidding);
        $bidding_form->handleRequest($request);

        if ($bidding_form->isSubmitted() && $bidding_form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bidding);
            $em->flush();
        }


        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
            'rating_form' => $rating_form->createView(),
            'bidding_form' => $bidding_form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('AppBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
