<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Bookmark;
use AppBundle\Form\BookmarkType;

/**
 * Bookmark controller.
 *
 * @Route("/bookmark")
 */
class BookmarkController extends Controller
{
    /**
     * Lists all Bookmark entities.
     *
     * @Route("/", name="bookmark")
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Bookmark')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bookmark entity.
     *
     * @Route("/", name="bookmark_create")
     * @Method("POST")
     * @Template("AppBundle:Bookmark:new.html.twig")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createAction(Request $request)
    {
        $entity = new Bookmark();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bookmark_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bookmark entity.
     *
     * @param Bookmark $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    private function createCreateForm(Bookmark $entity)
    {
        $form = $this->createForm(new BookmarkType(), $entity, array(
            'action' => $this->generateUrl('bookmark_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bookmark entity.
     *
     * @Route("/new", name="bookmark_new")
     * @Method("GET")
     * @Template()
     *
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction()
    {
        $entity = new Bookmark();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bookmark entity.
     *
     * @Route("/{id}", name="bookmark_show")
     * @Method("GET")
     * @Template()
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bookmark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bookmark entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bookmark entity.
     *
     * @Route("/{id}/edit", name="bookmark_edit")
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bookmark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bookmark entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Bookmark entity.
    *
    * @param Bookmark $entity The entity
    * @Security("has_role('ROLE_ADMIN')")
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bookmark $entity)
    {
        $form = $this->createForm(new BookmarkType(), $entity, array(
            'action' => $this->generateUrl('bookmark_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bookmark entity.
     *
     * @Route("/{id}", name="bookmark_update")
     * @Method("PUT")
     * @Template("AppBundle:Bookmark:edit.html.twig")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bookmark')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bookmark entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bookmark_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bookmark entity.
     *
     * @Route("/{id}", name="bookmark_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bookmark')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bookmark entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bookmark'));
    }

    /**
     * Creates a form to delete a Bookmark entity by id.
     *
     * @param mixed $id The entity id
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookmark_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
