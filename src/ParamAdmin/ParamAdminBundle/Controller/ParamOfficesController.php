<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ParamOffices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Paramoffice controller.
 */
class ParamOfficesController extends Controller
{
    /**
     * Lists all paramOffice entities.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"office"})
     * @Rest\Get("/api/offices")
     */
    public function getOfficesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paramOffices = $em->getRepository('ParamAdminBundle:ParamOffices')->findByAssociations($request->headers->get('X-Auth-Association'));

        return $paramOffices;
    }

    /**
     * Creates a new paramOffice entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"office"})
     * @Rest\Post("/api/offices")
     */
    public function postOfficesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paramOffice = new ParamOffices();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamOfficesType', $paramOffice);
        $form->submit($request->request->all());

        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        $paramOffice->setAssociations($association);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($paramOffice);
            $em->flush();

            return $paramOffice;
        }

        return $form;
    }

    /**
     * Finds and displays a paramOffice entity.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"office"})
     * @Rest\Get(
     *      path = "/api/offices/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getOfficeAction(ParamOffices $paramOffice)
    {
        if (empty($paramOffice)) {
            $this->officesNotFound();
        }
        return $paramOffice;
    }

    /**
     * Displays a form to edit an existing paramOffice entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"office"})
     * @Rest\Put(
     *      path = "/api/offices/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putOfficeAction(Request $request, ParamOffices $paramOffice)
    {
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamOfficesType', $paramOffice);
        $editForm->submit($request->request->all());
        if (empty($paramOffice)) {
            $this->officesNotFound();
        }
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        $paramOffice->setAssociations($association);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $paramOffice;
        }

        return $editForm;
    }

    /**
     * Deletes a paramOffice entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"office"})
     * @Rest\Delete(
     *      path = "/api/offices/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteOfficesAction(Request $request, ParamOffices $paramOffice)
    {
        if (empty($paramOffice)) {
            $this->officesNotFound();
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

    private function officesNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Office not found'], Response::HTTP_NOT_FOUND);
    }
}
