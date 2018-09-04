<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * AuthToken
 *
 * @author Steve KOUNA
 * 
 * @ORM\Entity()
 * @ORM\Table(name="auth_tokens",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="auth_tokens_value_unique", columns={"value"})}
 * )
 * @ORM\HasLifecycleCallbacks
 * 
 * @Hateoas\Relation(
 *      "logout",
 *      href = @Hateoas\Route(
 *          "remove_auth_token",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"token"})
 * )
 */
class AuthToken
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Groups({"member", "token"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"member", "token"})
     */
    protected $value;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Member\MemberBundle\Entity\SysMembers
     *
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     * @Groups({"member", "token"})
     */
    protected $members;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_id", referencedColumnName="id")
     * })
     */
    protected $associations;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id")
     * })
     */
    protected $sessions;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    
    /**
     * Set members
     *
     * @param \Member\MemberBundle\Entity\SysMembers $members
     *
     * @return SysHistory
     */
    public function setMembers(\Member\MemberBundle\Entity\SysMembers $members = null)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get members
     *
     * @return \Member\MemberBundle\Entity\SysMembers
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set associations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations
     *
     * @return AuthToken
     */
    public function setAssociations(\ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations = null)
    {
        $this->associations = $associations;

        return $this;
    }

    /**
     * Get associations
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return AuthToken
     */
    public function setSessions(\ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions = null)
    {
        $this->sessions = $sessions;

        return $this;
    }

    /**
     * Get sessions
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     */
    public function getSessions()
    {
        return $this->sessions;
    }
}
