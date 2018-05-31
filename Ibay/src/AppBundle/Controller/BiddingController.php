<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bidding;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Bidding controller.
 *
 * @Route("bidding")
 */
class BiddingController extends Controller
{
    /**
     * Lists all bidding entities.
     *
     * @Route("/", name="bidding_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $biddings = $em->getRepository('AppBundle:Bidding')->findAll();

        return $this->render('bidding/index.html.twig', array(
            'biddings' => $biddings,
        ));
    }

    /**
     * Creates a new bidding entity.
     *
     * @Route("/new", name="bidding_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bidding = new Bidding();
        $form = $this->createForm('AppBundle\Form\BiddingType', $bidding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bidding);
            $em->flush();

            return $this->redirectToRoute('bidding_show', array('id' => $bidding->getId()));
        }

        return $this->render('bidding/new.html.twig', array(
            'bidding' => $bidding,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bidding entity.
     *
     * @Route("/{id}", name="bidding_show")
     * @Method("GET")
     */
    public function showAction(Bidding $bidding)
    {
        $deleteForm = $this->createDeleteForm($bidding);

        return $this->render('bidding/show.html.twig', array(
            'bidding' => $bidding,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bidding entity.
     *
     * @Route("/{id}/edit", name="bidding_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bidding $bidding)
    {
        $deleteForm = $this->createDeleteForm($bidding);
        $editForm = $this->createForm('AppBundle\Form\BiddingType', $bidding);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bidding_edit', array('id' => $bidding->getId()));
        }

        return $this->render('bidding/edit.html.twig', array(
            'bidding' => $bidding,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bidding entity.
     *
     * @Route("/{id}", name="bidding_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Bidding $bidding)
    {
        $form = $this->createDeleteForm($bidding);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bidding);
            $em->flush();
        }

        return $this->redirectToRoute('bidding_index');
    }

    /**
     * Creates a form to delete a bidding entity.
     *
     * @param Bidding $bidding The bidding entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bidding $bidding)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bidding_delete', array('id' => $bidding->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
