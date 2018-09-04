<?php

namespace ParamAdmin\ParamAdminBundle\Controller;

use ParamAdmin\ParamAdminBundle\Entity\SysAssociations;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation as Doc;
use ParamAdmin\ParamAdminBundle\Form\SysAssociationsType;

/**
 * Sysassociation controller.
 */
class SysAssociationsController extends Controller
{
    /**
     * Lists all Association entities.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Rest\View(serializerGroups={"association"})
     * @Rest\Get("/api/associations")
     * 
     * @QueryParam(name="offset", requirements="\d+", default="", description="Index de début de la pagination")
     * @QueryParam(name="limit", requirements="\d+", default="", description="Index de fin de la pagination")
     * @QueryParam(name="sort", requirements="(asc|desc)", nullable=true, description="Ordre de tri (basé sur le nom)")
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="SUPER-ADMIN",
     *     description="Get the list of all Association.",
     *     output= { "class"=SysAssociations::class, "collection"=true, "groups"={"association"} },
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
    public function getAssociationsAction(Request $request, ParamFetcher $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');
        $sort = $paramFetcher->get('sort');
        
        $em = $this->getDoctrine()->getManager();
//        $sysAssociations = $em->getRepository('ParamAdminBundle:SysAssociations')->findBy(['isDelete' => '0'], ['createdAt' => 'desc']);
        $sysAssociations = $em->getRepository('ParamAdminBundle:SysAssociations')->getAssociations($offset, $limit, $sort);

        return $sysAssociations;
    }

    /**
     * Creates a new sysAssociation entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"association"})
     * @Rest\Post("/api/associations")
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="SUPER-ADMIN",
     *     input={"class"=SysAssociationsType::class, "name"=""},
     *     output={ "class"=SysAssociations::class, "collection"=true, "groups"={"association"} },
     *     description="Creation of an association",
     *     statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         201 = {"class"=SysAssociations::class, "groups"={"association"}},
     *         400 = { "class"=SysAssociationsType::class, "form_errors"=true, "name" = ""}
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
    public function postAssociationsAction(Request $request)
    {
        $sysAssociation = new SysAssociations();
        $form = $this->createForm(SysAssociationsType::class, $sysAssociation);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            
            $sysAssociation->setIsDelete(false);
            
            $em->persist($sysAssociation);
            $em->flush();
            
            return $sysAssociation;
        }

        return $form;
    }

    /**
     * Finds and displays a Association entity.
     *
     * @Security("has_role('ROLE_MEMBER')")
     * 
     * @Rest\View(serializerGroups={"association"})
     * @Rest\Get(
     *      path = "/api/associations/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * @Doc\ApiDoc(
     *     resource=true,
     *     description="Get one Assication.",
     *     section="Association",
     *     statusCodes = {
     *        200 = "Création avec succès"
     *     },
     *     output= { "class"=SysAssociations::class, "collection"=true, "groups"={"association"} },
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The association unique identifier."
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
    public function getAssociationAction(SysAssociations $sysAssociation)
    {
        if (empty($sysAssociation)) {
            $this->associationNotFound();
        }
        return $sysAssociation;
    }

    /**
     * Displays a form to edit an existing sysAssociation entity.
     *
     * @Security("has_role('ROLE_OFFICE')")
     * @Rest\View(serializerGroups={"association"})
     * @Rest\Put(
     *      path = "/api/associations/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     input={"class"=SysAssociationsType::class, "name"=""},
     *     output= { "class"=SysAssociations::class, "collection"=true, "groups"={"association"} },
     *     description="Update of an association",
     *     statusCodes = {
     *        200 = "Modifier avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         200 = {"class"=SysAssociations::class, "groups"={"association"}},
     *         400 = { "class"=SysAssociationsType::class, "form_errors"=true, "name" = ""}
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
     *             "description"="The association unique identifier."
     *         }
     *     }
     * )
     */
    public function putAssociationAction(Request $request, SysAssociations $sysAssociation)
    {
        
        $editForm = $this->createForm('ParamAdmin\ParamAdminBundle\Form\SysAssociationsType', $sysAssociation);
        $editForm->submit($request->request->all());

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $sysAssociation->setIsDelete(false);
            $this->getDoctrine()->getManager()->flush();

            return $sysAssociation;
        }

        return $editForm;
    }

    /**
     * Deletes a sysAssociation entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"association"})
     * @Rest\Delete(
     *      path = "/api/associations/{id}", 
     *      requirements = {"id" = "\d+"}
     * )
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     description="Delete Association.",
     *     requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The association unique identifier."
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
    public function deleteAssociationAction(Request $request, SysAssociations $sysAssociation)
    {
        if (empty($sysAssociation)) {
            $this->associationNotFound();
        } else {
            $em = $this->getDoctrine()->getManager();
            $sysAssociation->setIsDelete(true);
//            $em->remove($sysAssociation);
            $em->flush();
        }
    }
    
    private function associationNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Association not found'], Response::HTTP_NOT_FOUND);
    }
    
    private function isExistAssociation($sysAssociation) {
        $em = $this->getDoctrine()->getManager();
        
        $sysAssoc = $em->getRepository('ParamAdminBundle:SysAssociations')
                    ->findOneBy(
                            [
                                'acronym' => $sysAssociation->getAcronym(), 
                                'name' => $sysAssociation->getName(),
                                'slogan' => $sysAssociation->getSlogan()
                            ]
                    );
//        dump($sysAssoc);die;
        if ($sysAssoc != NULL) {
//            die('ici');
            return \FOS\RestBundle\View\View::create(['message' => 'This Association exist'], Response::HTTP_BAD_REQUEST);
            
        }
    }

}
