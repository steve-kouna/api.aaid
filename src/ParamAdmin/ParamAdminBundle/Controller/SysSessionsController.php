<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\SysSessions;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Syssession controller.
 *
 * @author Steve KOUNA
 */
class SysSessionsController extends Controller
{
    /**
     * Lists all sysSession entities.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"session"})
     * @Rest\Get("/api/sessions")
     */
    public function getSessionsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sysSessions = $em->getRepository('ParamAdminBundle:SysSessions')->findAll();

        return $sysSessions;
    }

    /**
     * Creates a new sysSession entity.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"session"})
     * @Rest\Post("/api/sessions")
     */
    public function postSysSessionsAction(Request $request)
    {
        $sysSession = new SysSessions();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\SysSessionsType', $sysSession);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sysSession);
            $em->flush();

            return $sysSession;
        }

        return $form;
    }

    /**
     * Finds and displays a sysSession entity.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"session"})
     * @Rest\Get(
     *      path = "/api/sessions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getSysSessionAction(SysSessions $sysSession)
    {
        if (empty($sysSession)){
            $this->sessionsNotFound();
        }
        return $sysSession;
    }

    /**
     * Displays a form to edit an existing sysSession entity.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"session"})
     * @Rest\Put(
     *      path = "/api/sessions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putSysSessionAction(Request $request, SysSessions $sysSession)
    {
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\SysSessionsType', $sysSession);
        $editForm->submit($request->request->all());

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $sysSession;
        }

        return $editForm;
    }

    /**
     * Deletes a sysSession entity.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"session"})
     * @Rest\Delete(
     *      path = "/api/sessions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteSysSessionAction(Request $request, SysSessions $sysSession)
    {
        
        if (!empty($sysSession)) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        } else {
            $this->sessionsNotFound();
        }

    }
    
    
    private function sessionsNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Session not found'], Response::HTTP_NOT_FOUND);
    }

}
