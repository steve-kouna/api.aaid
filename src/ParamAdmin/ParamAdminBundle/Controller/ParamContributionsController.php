<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\ParamContributions;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation as Doc;
use ParamAdmin\ParamAdminBundle\Form\ParamContributionsType;

/**
 * Paramcontribution controller.
 */
class ParamContributionsController extends Controller
{
    /**
     * Lists all Contributions entities.
     *
     * @Security("has_role('ROLE_MEMBER')")
     * 
     * @Rest\View(serializerGroups={"contribution"})
     * @Rest\Get("/api/associations/params/contributions")
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     description="Get the list of all contributions.",
     *     output= { "class"=ParamContributions::class, "collection"=true, "groups"={"contribution"} },
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
    public function getContributionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $paramContributions = $em->getRepository('ParamAdminBundle:ParamContributions')->findByAssociations($request->headers->get('X-Auth-Association'));

        return $paramContributions;
    }

    /**
     * Creates a new Contribution.
     *
     * @Security("has_role('ROLE_OFFICE')")
     * 
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"contribution"})
     * @Rest\Post("/api/associations/params/contributions")
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     input={"class"=ParamContributionsType::class, "name"=""},
     *     output={ "class"=ParamContributions::class, "collection"=true, "groups"={"contribution"} },
     *     description="Creates a new Contribution",
     *     statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         201 = {"class"=ParamContributions::class, "groups"={"contribution"}},
     *         400 = { "class"=ParamContributionsType::class, "form_errors"=true, "name" = ""}
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
    public function postContributionsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paramContribution = new ParamContributions();
        $associations = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
        
        $form = $this->createForm(ParamContributionsType::class, $paramContribution);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            if (!empty($associations)) {
                $paramContribution->setAssociations($associations);
                $em->persist($paramContribution);
                $em->flush();
                return $paramContribution;
            } else {
                return \FOS\RestBundle\View\View::create(['message' => 'Association not found'], Response::HTTP_NOT_FOUND);
            }
        }

        return $form;
    }

    /**
     * Finds and displays a param Contribution.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"contribution"})
     * @Rest\Get(
     *      path = "/api/associations/params/contributions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     description="Finds and displays a param Contribution.",
     *     section="Association",
     *     statusCodes = {
     *        200 = "Création avec succès"
     *     },
     *     output= { "class"=ParamContributions::class, "collection"=true, "groups"={"contribution"} },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The Contribution unique identifier."
     *         }
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
    public function getContributionAction(ParamContributions $paramContribution)
    {
        
        if (empty($paramContribution)) {
            $this->contributionNotFound();
        }
        return $paramContribution;
    }

    /**
     * Displays a form to edit an existing paramContribution.
     *
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"contribution"})
     * @Rest\Put(
     *      path = "/api/associations/params/contributions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     input={"class"=ParamContributionsType::class, "name"=""},
     *     output= { "class"=ParamContributions::class, "collection"=true, "groups"={"contribution"} },
     *     description="Displays a form to edit an existing paramContribution",
     *     statusCodes = {
     *        200 = "Modifier avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         200 = {"class"=ParamContributions::class, "groups"={"contribution"}},
     *         400 = { "class"=ParamContributionsType::class, "form_errors"=true, "name" = ""}
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
     *     },
     *      requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The contribution unique identifier."
     *         }
     *     }
     * ) 
     */
    public function putContributionsAction(Request $request, ParamContributions $paramContribution)
    {
        $editForm = $this->createForm(ParamContributionsType::class, $paramContribution);
        $form->submit($request->request->all());

        if (empty($paramContribution)) {
            $this->contributionNotFound();
        }
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $paramContribution;
        }

        return $editForm;
    }

    /**
     * Deletes a param Contribution.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"contribution"})
     * @Rest\Delete(
     *      path = "/api/associations/params/contributions/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     description="Deletes a param Contribution.",
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The Contribution unique identifier."
     *         }
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
    public function deleteContributionsAction(Request $request, ParamContributions $paramContribution)
    {
        
        if (empty($paramContribution)) {
            $this->contributionNotFound();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($paramContribution);
        $em->flush();
    }
    
    
    private function contributionNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Contribution not found'], Response::HTTP_NOT_FOUND);
    }
}
