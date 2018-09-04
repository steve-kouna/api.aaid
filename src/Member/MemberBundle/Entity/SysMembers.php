<?php

namespace Member\MemberBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;


/**
 * SysMembers
 *
 * @ORM\Table(name="sys__members", uniqueConstraints={@ORM\UniqueConstraint(name="cni_number_UNIQUE", columns={"cni_number"})})
 * @ORM\Entity(repositoryClass="Member\MemberBundle\Repository\SysMembersRepository")
 *  
 * @Hateoas\Relation(
 *      "create",
 *      href = @Hateoas\Route(
 *          "post_members",
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "token"})
 * )
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "get_member",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "token"})
 * )
 * 
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "put_members",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "token"})
 * )
 * 
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "delete_members",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "token"})
 * )
 * 
 * @Hateoas\Relation(
 *     "inscription",
 *     embedded = @Hateoas\Embedded("expr(object.getInscription())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"member", "token"})
 * )
 * 
 * @Hateoas\Relation(
 *     "eat",
 *     embedded = @Hateoas\Embedded("expr(object.getEats())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"member", "token"})
 * )
 */
class SysMembers implements UserInterface
{
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=45, nullable=true)
     */
    protected $roles;
    
    /**
     * @ORM\Column(name="email", type="string", length=100, unique=true, nullable=false)
     * @Assert\NotBlank()
     * 
     * @Groups({"member", "inscription", "association", "token"})
     */
    protected $email;
    
    /**
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    protected $password;
    
    /**
     * @Groups({"member", "inscription", "association", "token"})
     */
    protected $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", unique=true, length=45, nullable=false)
     * @Assert\NotBlank()
     * 
     * @Groups({"member", "inscription", "association", "token"})
     */
    protected $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=true)
     * 
     * @Groups({"member", "inscription", "association", "token"})
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true)
     * 
     * @Groups({"member", "inscription", "association", "token"})
     */
    protected $lastname;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_birth", type="date", nullable=true)
     */
    protected $dateBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=45, nullable=true)
     * 
     * @Groups({"member", "inscription", "association"})
     */
    protected $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="cni_number", type="string", length=45, nullable=true)
     */
    protected $cniNumber;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date_cni_deliver", type="date", nullable=true)
     */
    protected $dateCniDeliver;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Groups({"member", "inscription", "association", "meeting", "token"})
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Member\MemberBundle\Entity\AssociationsMembersInscription", mappedBy="members")
     */
    private $inscription;
    
    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamEat", mappedBy="members")
     */
    private $eats;
    
    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return SysMembers
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return SysMembers
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateBirth
     *
     * @param \Date $dateBirth
     *
     * @return SysMembers
     */
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get dateBirth
     *
     * @return \Date
     */
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return SysMembers
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set cniNumber
     *
     * @param string $cniNumber
     *
     * @return SysMembers
     */
    public function setCniNumber($cniNumber)
    {
        $this->cniNumber = $cniNumber;

        return $this;
    }

    /**
     * Get cniNumber
     *
     * @return string
     */
    public function getCniNumber()
    {
        return $this->cniNumber;
    }

    /**
     * Set dateCniDeliver
     *
     * @param \Date $dateCniDeliver
     *
     * @return SysMembers
     */
    public function setDateCniDeliver($dateCniDeliver)
    {
        $this->dateCniDeliver = $dateCniDeliver;

        return $this;
    }

    /**
     * Get dateCniDeliver
     *
     * @return \Date
     */
    public function getDateCniDeliver()
    {
        return $this->dateCniDeliver;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    
    public function eraseCredentials() {
        return $this->plainPassword = null;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->username;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscription = new \Doctrine\Common\Collections\ArrayCollection();
        $this->eats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return SysMembers
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return SysMembers
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Add inscription
     *
     * @param \Member\MemberBundle\Entity\AssociationsMembersInscription $inscription
     *
     * @return SysMembers
     */
    public function addInscription(\Member\MemberBundle\Entity\AssociationsMembersInscription $inscription)
    {
        $this->inscription[] = $inscription;

        return $this;
    }

    /**
     * Remove inscription
     *
     * @param \Member\MemberBundle\Entity\AssociationsMembersInscription $inscription
     */
    public function removeInscription(\Member\MemberBundle\Entity\AssociationsMembersInscription $inscription)
    {
        $this->inscription->removeElement($inscription);
    }

    /**
     * Get inscription
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscription()
    {
        return $this->inscription;
    }

    /**
     * Add eat
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat
     *
     * @return SysMembers
     */
    public function addEat(\ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat)
    {
        $this->eats[] = $eat;

        return $this;
    }

    /**
     * Remove eat
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat
     */
    public function removeEat(\ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat)
    {
        $this->eats->removeElement($eat);
    }

    /**
     * Get eats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEats()
    {
        return $this->eats;
    }
}
