<?php

namespace Titan\KillerCrudBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Titan\KillerCrudBundle\Entity\Contract;
use Titan\KillerCrudBundle\Form\ContractType;

/**
 * Contract controller.
 *
 * @Route("/contract")
 */
class ContractController extends Controller
{

    /**
     * Lists all Contract entities.
     *
     * @Route("/", name="contract")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TitanKillerCrudBundle:Contract')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Creates a new Contract entity.
     *
     * @Route("/", name="contract_create")
     * @Method("POST")
     * @Template("TitanKillerCrudBundle:Contract:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Contract();
        $form = $this->createForm('contract_form', $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contract_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Contract entity.
     *
     * @Route("/new", name="contract_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Contract();
        $form   = $this->createForm('contract_form', $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Contract entity.
     *
     * @Route("/{id}", name="contract_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TitanKillerCrudBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Contract entity.
     *
     * @Route("/{id}/edit", name="contract_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TitanKillerCrudBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $editForm = $this->createForm('contract_form', $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Contract entity.
     *
     * @Route("/{id}", name="contract_update")
     * @Method("PUT")
     * @Template("TitanKillerCrudBundle:Contract:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TitanKillerCrudBundle:Contract')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contract entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm('contract_form', $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contract_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Contract entity.
     *
     * @Route("/{id}", name="contract_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TitanKillerCrudBundle:Contract')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contract entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contract'));
    }

    /**
     * Creates a form to delete a Contract entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
