<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembersOffices
 *
 * @ORM\Table(name="members__offices", indexes={@ORM\Index(name="fk_sys__members_has_param__offices_param__offices1_idx", columns={"offices_id"}), @ORM\Index(name="fk_sys__members_has_param__offices_sys__members1_idx", columns={"members_id"}), @ORM\Index(name="fk_sys__members_has_param__offices_sys__sessions1_idx", columns={"sessions_id"}), @ORM\Index(name="fk_sys__members_has_param__offices_sys__associations1_idx", columns={"associations_id"})})
 * @ORM\Entity
 */
class MembersOffices
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updateAt;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id")
     * })
     */
    private $sessions;

    /**
     * @var \Member\MemberBundle\Entity\SysMembers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     */
    private $members;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_id", referencedColumnName="id")
     * })
     */
    private $associations;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamOffices
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamOffices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offices_id", referencedColumnName="id")
     * })
     */
    private $offices;



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MembersOffices
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return MembersOffices
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return MembersOffices
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

    /**
     * Set members
     *
     * @param \Member\Member\Entity\SysMembers $members
     *
     * @return MembersOffices
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
     * Set associations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations
     *
     * @return MembersOffices
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
     * Set offices
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamOffices $offices
     *
     * @return MembersOffices
     */
    public function setOffices(\ParamAdmin\ParamAdminBundle\Entity\ParamOffices $offices)
    {
        $this->offices = $offices;

        return $this;
    }

    /**
     * Get offices
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\ParamOffices
     */
    public function getOffices()
    {
        return $this->offices;
    }
}
