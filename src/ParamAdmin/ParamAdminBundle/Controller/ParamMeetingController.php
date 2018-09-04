<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ParamMeeting;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Parammeeting controller.
 */
class ParamMeetingController extends Controller
{
    /**
     * Lists all paramMeeting entities.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"meeting"})
     * @Rest\Get("/api/meetings")
     */
    public function getMeetingsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paramMeetings = $em->getRepository('ParamAdminBundle:ParamMeeting')
                ->findBy([
                    'sessions' => $request->headers->get('X-Auth-Session'),
                    'associations' => $request->headers->get('X-Auth-Association'),
                    ]);

        return $paramMeetings;
    }

    /**
     * Creates a new paramMeeting entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"meeting"})
     * @Rest\Post("/api/meetings")
     */
    public function postMeetingsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paramMeeting = new ParamMeeting();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamMeetingType', $paramMeeting);
        $form->submit($request->request->all());
        
        $session = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $paramMeeting->setAssociations($association);
        $paramMeeting->setSessions($session);
//        $paramMeeting->setMembers(3);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($paramMeeting);
            $em->flush();

            return $paramMeeting;
        }

        return $form;
    }

    /**
     * Finds and displays a paramMeeting entity.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"meeting"})
     * @Rest\Get(
     *      path = "/api/meetings/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getMeetingAction(ParamMeeting $paramMeeting)
    {
        if (empty($paramMeeting)) {
            $this->meetingNotFound();
        }
        return $paramMeeting;
    }

    /**
     * Displays a form to edit an existing paramMeeting entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(serializerGroups={"meeting"})
     * @Rest\Put(
     *      path = "/api/meetings/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putMeetingAction(Request $request, ParamMeeting $paramMeeting)
    {
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamMeetingType', $paramMeeting);
        $editForm->submit($request->request->all());
        
        if (empty($paramMeeting)) {
            $this->meetingNotFound();
        }
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $paramMeeting;
        }

        return $editForm;
    }

    /**
     * Deletes a paramMeeting entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"meeting"})
     * @Rest\Delete(
     *      path = "/api/meetings/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteAction(Request $request, ParamMeeting $paramMeeting)
    {
        if (empty($paramMeeting)) {
            $this->meetingNotFound();
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($paramMeeting);
        $em->flush();
    }
    
    
    private function meetingNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Meeting not found'], Response::HTTP_NOT_FOUND);
    }
}
