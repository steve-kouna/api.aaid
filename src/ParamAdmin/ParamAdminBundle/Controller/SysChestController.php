<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\SysChest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Syschest controller.
 */
class SysChestController extends Controller
{
    /**
     * Lists all sysChest entities.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * 
     * @Rest\View(serializerGroups={"chest"})
     * @Rest\Get("/api/chests")
     */
    public function getChestsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sysChests = $em->getRepository('ParamAdminBundle:SysChest')
                ->findBy([
                    'sessions' => $request->headers->get('X-Auth-Session'),
                    'associations' => $request->headers->get('X-Auth-Association'),
                    ]);

        return $sysChests;
    }

    /**
     * Creates a new sysChest entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"chest"})
     * @Rest\Post("/api/chests")
     */
    public function postChestsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sysChest = new SysChest();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\SysChestType', $sysChest);
        $form->submit($request->request->all());
        
        $session = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $sysChest->setSessions($session);
        $sysChest->setAssociations($association);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($sysChest);
            $em->flush();

            return $sysChest;
        }

        return $form;
    }

    /**
     * Finds and displays a sysChest entity.
     * 
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"chest"})
     * @Rest\Get(
     *      path = "/api/chests/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getChestAction(SysChest $sysChest)
    {
        if (empty($sysChest)) {
            $this->chestNotFound();
        }
        return $sysChest;
    }

    /**
     * Displays a form to edit an existing sysChest entity.
     * 
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"chest"})
     * @Rest\Put(
     *      path = "/api/chests/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putChestsAction(Request $request, SysChest $sysChest)
    {   
        $em = $this->getDoctrine()->getManager();
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\SysChestType', $sysChest);
        $editForm->submit($request->request->all());
        if (empty($sysChest)) {
            $this->chestNotFound();
        }
        $session = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $sysChest->setSessions($session);
        $sysChest->setAssociations($association);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $sysChest;
        }

        return $editForm;
    }

    /**
     * Deletes a sysChest entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"chest"})
     * @Rest\Delete(
     *      path = "/api/chests/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteAction(Request $request, SysChest $sysChest)
    {
        if (empty($sysChest)) {
            $this->chestNotFound();
        }
        $em = $this->getDoctrine()->getManager();
        
        $em->flush();
    }
    
    private function chestNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Chest not found'], Response::HTTP_NOT_FOUND);
    }

}
