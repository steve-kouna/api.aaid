<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * ParamEat
 *
 * @ORM\Table(name="param_eat", indexes={@ORM\Index(name="fk_param_eat_param__meeting1_idx", columns={"meeting_id"}), @ORM\Index(name="fk_param_eat_param__associations1_idx", columns={"associations_id"}), @ORM\Index(name="fk_param_eat_param__contributions1_idx", columns={"contributions_id"}), @ORM\Index(name="fk_param_eat_member__members1_idx", columns={"members_id"}), @ORM\Index(name="fk_param_eat_param__sessions1_idx", columns={"sessions_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class ParamEat
{
    /**
     * @var \Date
     *
     * @ORM\Column(name="eat_date", type="date", nullable=false)
     */
    private $eatDate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id")
     * })
     */
    private $sessions;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamMeeting")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meeting_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"member", "eat"})
     */
    private $meeting;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamContributions
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamContributions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contributions_id", referencedColumnName="id")
     * })
     */
    private $contributions;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_id", referencedColumnName="id")
     * })
     */
    private $associations;

    /**
     * @var \Member\MemberBundle\Entity\SysMembers
     *
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers", inversedBy="eats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     */
    private $members;



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ParamEat
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return ParamEat
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

    /**
     * Set meeting
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting
     *
     * @return ParamEat
     */
    public function setMeeting(\ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set contributions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contributions
     *
     * @return ParamEat
     */
    public function setContributions(\ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contributions = null)
    {
        $this->contributions = $contributions;

        return $this;
    }

    /**
     * Get contributions
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\ParamContributions
     */
    public function getContributions()
    {
        return $this->contributions;
    }

    /**
     * Set associations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations
     *
     * @return ParamEat
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
     * Set members
     *
     * @param \Member\MemberBundle\Entity\SysMembers $members
     *
     * @return ParamEat
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
     * Set eatDate
     *
     * @param \Date $eatDate
     *
     * @return ParamEat
     */
    public function setEatDate($eatDate)
    {
        $this->eatDate = $eatDate;

        return $this;
    }

    /**
     * Get eatDate
     *
     * @return \Date
     */
    public function getEatDate()
    {
        return $this->eatDate;
    }
    
    /***************      EVENEMENTS      ******************/

    /**
     * @ORM\PrePersist
     */
    public function createDate() {
        $this->setCreatedAt(new \DateTime());
    }
}
