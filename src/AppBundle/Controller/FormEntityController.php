<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\FormEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formentity controller.
 */
class FormEntityController extends Controller
{
    /**
     * Lists all formEntity entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formEntities = $em->getRepository('AppBundle:FormEntity')->findAll();

        return $this->render('formentity/index.html.twig', [
            'formEntities' => $formEntities,
        ]);
    }

    /**
     * Creates a new formEntity entity.
     */
    public function newAction(Request $request)
    {
        $formEntity = new Formentity();
        $form = $this->createForm('AppBundle\Form\FormEntityType', $formEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formEntity);
            $em->flush();

            return $this->redirectToRoute('base_form_show', ['id' => $formEntity->getId()]);
        }

        return $this->render('formentity/new.html.twig', [
            'formEntity' => $formEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a formEntity entity.
     */
    public function showAction(FormEntity $formEntity)
    {
        $deleteForm = $this->createDeleteForm($formEntity);

        return $this->render('formentity/show.html.twig', [
            'formEntity' => $formEntity,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing formEntity entity.
     */
    public function editAction(Request $request, FormEntity $formEntity)
    {
        $deleteForm = $this->createDeleteForm($formEntity);
        $editForm = $this->createForm('AppBundle\Form\FormEntityType', $formEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('base_form_edit', ['id' => $formEntity->getId()]);
        }

        return $this->render('formentity/edit.html.twig', [
            'formEntity' => $formEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a formEntity entity.
     */
    public function deleteAction(Request $request, FormEntity $formEntity)
    {
        $form = $this->createDeleteForm($formEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formEntity);
            $em->flush();
        }

        return $this->redirectToRoute('base_form_index');
    }

    /**
     * Creates a form to delete a formEntity entity.
     *
     * @param FormEntity $formEntity The formEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormEntity $formEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('base_form_delete', ['id' => $formEntity->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
