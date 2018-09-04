<?php

namespace Member\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Member\MemberBundle\Form\CredentialsType;
use Member\MemberBundle\Entity\AuthToken;
use Member\MemberBundle\Entity\Credentials;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Description of AuthTokenController
 *
 * @author Steve KOUNA
 */
class AuthTokenController extends Controller {
    
    /**
     * @ApiDoc(
     *    resource=true,
     *    section="Token",
     *    description="Crée un token d'authentification",
     *    input={ "class" = CredentialsType::class, "name"=""},
     *    output={ "class"=AuthToken::class, "collection"=true, "groups"={"tokrn"} },
     *    statusCodes = {
     *        201 = "Création avec succès",
     *        400 = "Formulaire invalide"
     *    },
     *    responseMap={
     *         201 = {"class"=AuthToken::class, "groups"={"token"}},
     *         400 = { "class"=CredentialsType::class, "fos_rest_form_errors"=true, "name" = ""}
     *    }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"token"})
     * @Rest\Post("/auth-tokens")
     */
    public function postAuthTokensAction(Request $request)
    {
        $credentials = new Credentials();
        $form = $this->createForm(CredentialsType::class, $credentials);
        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $form;
        }

        $em = $this->get('doctrine.orm.entity_manager');

        $user = $em->getRepository('MemberBundle:SysMembers')->findOneByEmail($credentials->getLogin());
//        dump($user);die;
        if (!$user) { // L'utilisateur n'existe pas
            return $this->invalidCredentials();
        }

        $encoder = $this->get('security.password_encoder');
        $isPasswordValid = $encoder->isPasswordValid($user, $credentials->getPassword());

        if (!$isPasswordValid) { // Le mot de passe n'est pas correct
            return $this->invalidCredentials();
        }

        $authToken = new AuthToken();
        $authToken->setValue(base64_encode(random_bytes(100)));
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setMembers($user);

        $em->persist($authToken);
        $em->flush();
        // $array = $authToken;
        // $menber = $em->getRepository('MemberBundle:AssociationsMembersInscription')->findByMembers($authToken->getMembers()->getId());
        // array_unshift($menber, $authToken);
        // return $menber;
        return $authToken;
    }
    
    /**
     *
     * @Security("has_role('ROLE_MEMBER')")
     * 
     * @ApiDoc(
     *    resource=true,
     *    section="Token",
     *    description="Suppression du token d'authentification",
     *    statusCodes = {
     *        204 = "Suppression avec succès",
     *    },
     *    requirements={
     *         {
     *             "name"="id",
     *             "dataType"="integer",
     *             "requirements"="\d+",
     *             "description"="The association unique identifier."
     *         }
     *     }
     * )
     *
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"token"})
     * @Rest\Delete("/api/auth-tokens/{id}")
     */
    public function removeAuthTokenAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $authTokens = $em->getRepository('MemberBundle:AuthToken')->findByMembers($request->get('id'));
        /* @var $authToken AuthToken */

        foreach ($authTokens as $authToken) {
            $connectedUser = $this->get('security.token_storage')->getToken()->getUser();
            if ($authToken && $authToken->getMembers()->getId() === $connectedUser->getId()) {
                $em->remove($authToken);
                $em->flush();
            } else {
                throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException();
            }   
        }
    }

    private function invalidCredentials()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Invalid credentials'], Response::HTTP_BAD_REQUEST);
    }
}
