<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ParamSanctions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Paramsanction controller.
 */
class ParamSanctionsController extends Controller
{
    /**
     * Lists all paramSanction entities.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"sanction"})
     * @Rest\Get("/api/sanctions")
     */
    public function getSanctionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paramSanctions = $em->getRepository('ParamAdminBundle:ParamSanctions')->findByAssociation($request->headers->get('X-Auth-Association'));

        return $paramSanctions;
    }

    /**
     * Creates a new paramSanction entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"sanction"})
     * @Rest\Post("/api/sanctions")
     */
    public function postSanctionAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paramSanction = new ParamSanctions();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamSanctionsType', $paramSanction);
        $form->submit($request->request->all());

        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        $paramSanction->setAssociation($association);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($paramSanction);
            $em->flush();

            return $paramSanction;
        }

        return $form;
    }

    /**
     * Finds and displays a paramSanction entity.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"sanction"})
     * @Rest\Get(
     *      path = "/api/sanctions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getSanctionAction(ParamSanctions $paramSanction)
    {
        if (empty($paramSanction)) {
            $this->sanctionNotFound();
        }
        return $paramSanction;
    }

    /**
     * Displays a form to edit an existing paramSanction entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"sanction"})
     * @Rest\Put(
     *      path = "/api/sanctions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putSanctionAction(Request $request, ParamSanctions $paramSanction)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamSanctionsType', $paramSanction);
        $editForm->submit($request->request->all());

        if (empty($paramSanction)) {
            $this->sanctionNotFound();
        }

        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        $paramSanction->setAssociation($association);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $paramSanction;
        }

        return $editForm;
    }

    /**
     * Deletes a paramSanction entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"sanction"})
     * @Rest\Delete(
     *      path = "/api/sanctions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteSanctionAction(Request $request, ParamSanctions $paramSanction)
    {
        if (empty($paramSanction)) {
            $this->sanctionNotFound();
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

    private function sanctionNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Sanction not found'], Response::HTTP_NOT_FOUND);
    }
}
