<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * AssociationsMembersInscription
 *
 * @ORM\Table(name="associations__members_inscription", indexes={@ORM\Index(name="fk_param__associations_has_member__memebers_member__memeber_idx", columns={"members_id"}), @ORM\Index(name="fk_param__associations_has_member__memebers_param__associat_idx", columns={"associations_id"}), @ORM\Index(name="fk_associations__memebers_param__sessios1_idx", columns={"sessions_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class AssociationsMembersInscription
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     * 
     * @Groups({"member", "inscription", "association", "session", "token"})
     */
    private $active = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations", cascade={"persist"}, inversedBy="inscriptions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_id", referencedColumnName="id", unique=false)
     * })
     * 
     * @Groups({"member", "inscription", "association", "token"})
     */
    private $associations;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysMembers
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers", cascade={"persist"}, inversedBy="inscription")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id", unique=false)
     * })
     * 
     * @Groups({"inscription", "association"})
     */
    private $members;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions", cascade={"persist"}, inversedBy="inscription")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id", unique=false)
     * })
     * 
     * @Groups({"inscription", "association", "token"})
     */
    private $sessions;
    
    

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return AssociationsMembersInscription
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AssociationsMembersInscription
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return AssociationsMembersInscription
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set associations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations
     *
     * @return AssociationsMembersInscription
     */
    public function setAssociations(\ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations)
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
     * Set members
     *
     * @param \Member\MemberBundle\Entity\SysMembers $members
     *
     * @return AssociationsMembersInscription
     */
    public function setMembers(\Member\MemberBundle\Entity\SysMembers $members)
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
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return AssociationsMembersInscription
     */
    public function setSessions(\ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions)
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
    
    
    
    /***************      EVENEMENTS      ******************/

    /**
     * @ORM\PrePersist
     */
    public function createDate() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate() {
        $this->setUpdatedAt(new \DateTime());
    }
}
