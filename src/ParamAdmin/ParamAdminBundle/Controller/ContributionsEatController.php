<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ContributionsEat;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;
use ParamAdmin\ParamAdminBundle\Form\ContributionsEatType;


/**
 * ContributionsEat controller.
 */
class ContributionsEatController  extends Controller {
    
    /**
     * Lists all all contributions eats.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"member"})
     * @Rest\Get("/api/associations/contributions/eats")
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     description="Get the list of all contributions eats.",
     *     output= { "class"=ContributionsEat::class, "collection"=true, "groups"={"member"} },
     *     headers={
     *         {
     *             "name"="X-Auth-Token",
     *             "required"=true,
     *             "description"="Authorization key"
     *         },
     *         {
     *             "name"="X-Auth-Association",
     *             "required"=true,
     *             "description"="Authorization key"
     *         },
     *         {
     *             "name"="X-Auth-Session",
     *             "required"=true,
     *             "description"="Authorization key"
     *         }
     *     }
     * )
     */
    public function getContributionsEatsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contributionsEat = $em->getRepository('ParamAdminBundle:ContributionsEat')
                ->findBy([
                    'sessions' => $request->headers->get('X-Auth-Session'),
                    'associations' => $request->headers->get('X-Auth-Association'),
                    ]);

        return $contributionsEat;
    }

    /**
     * Creates a new Contributions Eat.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"member"})
     * @Rest\Post("/api/associations/contributions/eats")
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     input={"class"=ContributionsEatType::class, "name"=""},
     *     output={ "class"=ContributionsEat::class, "collection"=true, "groups"={"member"} },
     *     description="Creation a new Contributions Eat.",
     *     statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         201 = {"class"=ContributionsEat::class, "groups"={"member"}},
     *         400 = { "class"=ContributionsEatType::class, "form_errors"=true, "name" = ""}
     *     },
     *     headers={
     *         {
     *             "name"="X-Auth-Token",
     *             "required"=true,
     *             "description"="Authorization key"
     *         },
     *         {
     *             "name"="X-Auth-Association",
     *             "required"=true,
     *             "description"="Authorization key"
     *         },
     *         {
     *             "name"="X-Auth-Session",
     *             "required"=true,
     *             "description"="Authorization key"
     *         }
     *     }
     * )
     */
    public function postContributionsEatsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contributionsEat = new ContributionsEat();
        $form = $this->createForm(ContributionsEatType::class, $contributionsEat);
        $form->submit($request->request->all());
        
        $session = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));
        $association = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $contributionsEat->setAssociations($association);
        $contributionsEat->setSessions($session);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($contributionsEat);
            $em->flush();

            return $contributionsEat;
        }

        return $form;
    }
}
