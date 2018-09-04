<?php

namespace Member\MemberBundle\Controller;

use Member\MemberBundle\Entity\SysMembers;
use Member\MemberBundle\Entity\AssociationsMembersInscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Member\MemberBundle\Form\SysMembersType;

/**
 * Sysmember controller.
 */
class SysMembersController extends Controller
{
    /**
     * Lists all sysMember entities.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * 
     * @Rest\View(serializerGroups={"member"})
     * @Rest\Get("/api/members")
     * 
     * @QueryParam(name="offset", requirements="\d+", default="", description="Index de début de la pagination")
     * @QueryParam(name="limit", requirements="\d+", default="", description="Index de fin de la pagination")
     * @QueryParam(name="sort", requirements="(asc|desc)", nullable=true, description="Ordre de tri (basé sur le nom)")
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="SUPER-ADMIN",
     *     description="Get the list of all Association.",
     *     output= { "class"=SysMembers::class, "collection"=true, "groups"={"association"} },
     * )
     * 
     */
    public function getMembersAction(Request $request, ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $sort = $paramFetcher->get('sort');
        
        $em = $this->getDoctrine()->getManager();

        $sysMembers = $em->getRepository('MemberBundle:SysMembers')->findAll();

        return $sysMembers;
    }

    /**
     * Creates a new Member.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"member"})
     * @Rest\Post("/api/associations/members")
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Membre",
     *     input={"class"=SysMembersType::class, "name"=""},
     *     output={ "class"=SysMembers::class, "collection"=true, "groups"={"member"} },
     *     description="Creates a new Member",
     *     statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         201 = {"class"=SysMembers::class, "groups"={"member"}},
     *         400 = { "class"=SysMembersType::class, "form_errors"=true, "name" = ""}
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
    public function postMembersAction(Request $request)
    {
        
        $sysMember = new SysMembers();
        $inscription = new AssociationsMembersInscription();
        
        $form = $this->createForm(SysMembersType::class, $sysMember);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $roles = ["ROLE_MEMBER"];
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($sysMember, $sysMember->getPlainPassword());
            $sysMember->setPassword($encoded);
            $sysMember->setRoles($roles);
            $em = $this->getDoctrine()->getManager();
            
            $sysAssociations = $em->getRepository('ParamAdminBundle:SysAssociations')->find($request->headers->get('X-Auth-Association'));
            $sysSessions = $em->getRepository('ParamAdminBundle:SysSessions')->find($request->headers->get('X-Auth-Session'));

            $inscription->setMembers($sysMember);
            $inscription->setAssociations($sysAssociations);
            $inscription->setSessions($sysSessions);
            $inscription->setActive(true);
            $inscription->setCreatedAt(new \DateTime());
            $inscription->setUpdatedAt(new \DateTime());
            
            $em->persist($sysMember);
            $em->persist($inscription);

            $em->flush();

            return $sysMember;
        }

        return $form;
    }

    /**
     * Finds and displays a sysMember.
     * 
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"member"})
     * @Rest\Get(
     *      path = "/api/associations/members/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * @Doc\ApiDoc(
     *     resource=true,
     *     description="Finds and displays a Member.",
     *     section="Membre",
     *     statusCodes = {
     *        200 = "Effectué avec succès"
     *     },
     *     output= { "class"=SysMembers::class, "collection"=true, "groups"={"member"} },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The member unique identifier."
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
    public function getMemberAction(SysMembers $sysMember)
    {
        if (empty($sysMember)) {
            $this->memberNotFound();
        }
        
        return $sysMember;
    }

    /**
     * Displays a form to edit an existing sysMember.
     * 
     * @Security("has_role('ROLE_MEMBER')")
     *
     * @Rest\View(serializerGroups={"member"})
     * @Rest\Put(
     *      path = "/api/associations/members/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Membre",
     *     input={"class"=SysMembersType::class, "name"=""},
     *     output= { "class"=SysMembers::class, "collection"=true, "groups"={"member"} },
     *     description="Displays a form to edit an existing Member.",
     *     statusCodes = {
     *        200 = "Modifier avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         200 = {"class"=SysMembers::class, "groups"={"member"}},
     *         400 = { "class"=SysMembersType::class, "form_errors"=true, "name" = ""}
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
     *             "description"="The member unique identifier."
     *         }
     *     }
     * ) 
     */
    public function putMembersAction(Request $request, SysMembers $sysMember)
    {
        $editForm = $this->createForm(SysMembersType::class, $sysMember);
        $editForm->submit($request->request->all());
        
        if (empty($sysMember)) {
            $this->memberNotFound();
        }
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($sysMember, $sysMember->getPlainPassword());
            $sysMember->setPassword($encoded);
            $this->getDoctrine()->getManager()->flush();

            return $sysMember;
        }

        return $editForm;
    }

    /**
     * Deletes a sysMember.
     * 
     * @Security("has_role('ROLE_OFFICE')")
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"member"})
     * @Rest\Delete(
     *      path = "/api/associations/members/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * 
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Membre",
     *     description="Deletes a Member.",
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The member unique identifier."
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
    public function deleteMembersAction(Request $request, SysMembers $sysMember)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (empty($sysMember)) {
            $this->memberNotFound();
        }
        
        $sysAssociations = $em->getRepository('ParamAdminBundle:SysAssociations')->findInscription($request->headers->get('X-Auth-Association'), $request->headers->get('X-Auth-Session'));
        dump($sysAssociations);die;
        $sysMember->getInscription();
        
        
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    }

    /**
     * Displays a form to edit an existing sysMember entity.
     * 
     * 
     *
     * @Rest\View(serializerGroups={"member"})
     * @Rest\Patch(
     *      path = "/api/associations/members/{id}/add-role", 
     *      requirements = {"id" = "\d+"}
     * )
     */
    public function FunctionNameAction(SysMembers $sysMember)
    {
        if (empty($sysMember)) {
            $this->memberNotFound();
        }

        $em = $this->getDoctrine()->getManager();

        $roles = $sysMember->getRoles();
        array_push($roles, 'ROLE_ADMIN');
        // dump($roles);die;
        $sysMember->setRoles($roles);
        $em->merge($sysMember);
        $em->flush();
        return $sysMember;
    }

    private function memberNotFound()
    {
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Member not found');
    }
}
