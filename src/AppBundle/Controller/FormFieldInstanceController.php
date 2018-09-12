<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\FormFieldInstance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formfieldinstance controller.
 */
class FormFieldInstanceController extends Controller
{
    /**
     * Lists all formFieldInstance entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formFieldInstances = $em->getRepository('AppBundle:FormFieldInstance')->findAll();

        return $this->render('formfieldinstance/index.html.twig', [
            'formFieldInstances' => $formFieldInstances,
        ]);
    }

    /**
     * Creates a new formFieldInstance entity.
     */
    public function newAction(Request $request)
    {
        $formFieldInstance = new Formfieldinstance();
        $form = $this->createForm('AppBundle\Form\FormFieldInstanceType', $formFieldInstance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formFieldInstance);
            $em->flush();

            return $this->redirectToRoute('formfieldinstance_show', ['id' => $formFieldInstance->getId()]);
        }

        return $this->render('formfieldinstance/new.html.twig', [
            'formFieldInstance' => $formFieldInstance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a formFieldInstance entity.
     */
    public function showAction(FormFieldInstance $formFieldInstance)
    {
        $deleteForm = $this->createDeleteForm($formFieldInstance);

        return $this->render('formfieldinstance/show.html.twig', [
            'formFieldInstance' => $formFieldInstance,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing formFieldInstance entity.
     */
    public function editAction(Request $request, FormFieldInstance $formFieldInstance)
    {
        $deleteForm = $this->createDeleteForm($formFieldInstance);
        $editForm = $this->createForm('AppBundle\Form\FormFieldInstanceType', $formFieldInstance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formfieldinstance_edit', ['id' => $formFieldInstance->getId()]);
        }

        return $this->render('formfieldinstance/edit.html.twig', [
            'formFieldInstance' => $formFieldInstance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a formFieldInstance entity.
     */
    public function deleteAction(Request $request, FormFieldInstance $formFieldInstance)
    {
        $form = $this->createDeleteForm($formFieldInstance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formFieldInstance);
            $em->flush();
        }

        return $this->redirectToRoute('formfieldinstance_index');
    }

    /**
     * Creates a form to delete a formFieldInstance entity.
     *
     * @param FormFieldInstance $formFieldInstance The formFieldInstance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormFieldInstance $formFieldInstance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formfieldinstance_delete', ['id' => $formFieldInstance->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
