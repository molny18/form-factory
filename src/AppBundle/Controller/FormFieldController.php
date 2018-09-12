<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\FormField;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formfield controller.
 */
class FormFieldController extends Controller
{
    /**
     * Lists all formField entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formFields = $em->getRepository('AppBundle:FormField')->findAll();

        return $this->render('formfield/index.html.twig', [
            'formFields' => $formFields,
        ]);
    }

    /**
     * Creates a new formField entity.
     */
    public function newAction(Request $request)
    {
        $formField = new Formfield();
        $form = $this->createForm('AppBundle\Form\FormFieldType', $formField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formField);
            $em->flush();

            return $this->redirectToRoute('formfield_show', ['id' => $formField->getId()]);
        }

        return $this->render('formfield/new.html.twig', [
            'formField' => $formField,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a formField entity.
     */
    public function showAction(FormField $formField)
    {
        $deleteForm = $this->createDeleteForm($formField);

        return $this->render('formfield/show.html.twig', [
            'formField' => $formField,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing formField entity.
     */
    public function editAction(Request $request, FormField $formField)
    {
        $deleteForm = $this->createDeleteForm($formField);
        $editForm = $this->createForm('AppBundle\Form\FormFieldType', $formField);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formfield_edit', ['id' => $formField->getId()]);
        }

        return $this->render('formfield/edit.html.twig', [
            'formField' => $formField,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a formField entity.
     */
    public function deleteAction(Request $request, FormField $formField)
    {
        $form = $this->createDeleteForm($formField);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formField);
            $em->flush();
        }

        return $this->redirectToRoute('formfield_index');
    }

    /**
     * Creates a form to delete a formField entity.
     *
     * @param FormField $formField The formField entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormField $formField)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formfield_delete', ['id' => $formField->getId()]))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
