<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ParamEat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * Parameat controller.
 */
class ParamEatController extends Controller
{
    /**
     * Lists all paramEat entities.
     * 
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View()
     * @Rest\Get("/api/params/eats")
     */
    public function getEatsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paramEats = $em->getRepository('ParamAdminBundle:ParamEat')
                ->findBy([
                    'sessions' => $request->headers->get('X-Auth-Session'),
                    'associations' => $request->headers->get('X-Auth-Association'),
                    ]);

        return $paramEats;
    }

    /**
     * Creates a new paramEat entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/params/eats")
     */
    public function postEatsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paramEat = new ParamEat();
        $form = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamEatType', $paramEat);
        $form->submit($request->request->all());
        
        $session = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $paramEat->setAssociations($association);
        $paramEat->setSessions($session);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($paramEat);
            $em->flush();

            return $paramEat;
        }

        return $paramEat;
    }

    /**
     * Finds and displays a paramEat entity.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View()
     * @Rest\Get(
     *      path = "/api/params/eats/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function getEatAction(ParamEat $paramEat)
    {
        if (empty($paramEat)) {
            $this->estsNotFound();
        }
        return $paramEat;
    }

    /**
     * Displays a form to edit an existing paramEat entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View()
     * @Rest\Put(
     *      path = "/api/params/eats/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function putEatsAction(Request $request, ParamEat $paramEat)
    {
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\ParamEatType', $paramEat);
        $editForm->submit($request->request->all());

        if (empty($paramEat)) {
            $this->estsNotFound();
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $paramEat;
        }

        return $editForm;
    }

    /**
     * Deletes a paramEat entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete(
     *      path = "/api/params/eats/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function deleteEatsAction(Request $request, ParamEat $paramEat)
    {
        if (empty($paramEat)) {
            $this->estsNotFound();
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $em->flush();
        
    }


    private function estsNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Eat not found'], Response::HTTP_NOT_FOUND);
    }
    

}
