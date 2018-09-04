<?php

namespace Member\MemberBundle\Controller;

use Member\MemberBundle\Entity\AssociationsMembersInscription;
use Member\MemberBundle\Entity\SysMembers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation as Doc;
use Member\MemberBundle\Form\AssociationsMembersInscriptionType;

/**
 * Description of AssociationsMembersInscriptionController
 *
 * @author Steve KOUNA
 */
class AssociationsMembersInscriptionController extends Controller {
    
    /**
     * Creates a new Associations Inscription.
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"inscription"})
     * @Rest\Post("/associations/incriptions")
     * @Doc\ApiDoc(
     *     resource=true,
     *     section="Association",
     *     input={"class"=AssociationsMembersInscriptionType::class, "name"=""},
     *     output= { "class"=AssociationsMembersInscription::class, "collection"=true, "groups"={"inscription"} },
     *     description="Creation of an association",
     *     statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *     },
     *     responseMap={
     *         201 = {"class"=AssociationsMembersInscription::class, "groups"={"inscription"}},
     *         400 = { "class"=AssociationsMembersInscriptionType::class, "fos_rest_form_errors"=true, "name" = ""}
     *     },
     * )
     */
    public function postInscriptionsAction(Request $request)
    {
        $inscription = new AssociationsMembersInscription();
        $sysMember = new SysMembers();
        $form = $this->createForm(AssociationsMembersInscriptionType::class, $inscription);
        $form->submit($request->request->all());
        
//        dump($inscription);die;
        if ($form->isSubmitted()) {
            
            $roles = ["ROLE_MEMBER", "ROLE_OFFICE"];
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($sysMember, $inscription->getMembers()->getPlainPassword());
            $inscription->getMembers()->setPassword($encoded);
            $inscription->getMembers()->setRoles($roles);
//            dump($inscription);die;
//            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
            
                $inscription->setActive(true);

                $em->persist($inscription);
                $em->flush();
//            }
            
            return $inscription;
        }

        return $form;
    }
}
