<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * ContributionsEat
 *
 * @ORM\Table(name="contributions__eat", indexes={@ORM\Index(name="fk_param__meeting_has_param__associations_param__associatio_idx", columns={"associations_id"}), @ORM\Index(name="fk_param__meeting_has_param__associations_param__meeting1_idx", columns={"meeting_id"}), @ORM\Index(name="fk_param__meeting_has_param__associations_param__contributi_idx", columns={"contributions_id"}), @ORM\Index(name="fk_param__meeting_has_param__associations_member__members1_idx", columns={"members_id"}), @ORM\Index(name="fk_param__meeting_has_param__associations_param__sessions1_idx", columns={"sessions_id"}), @ORM\Index(name="fk_contributions__eat_param_eat1_idx", columns={"eat_id"})})
 * @ORM\Entity
 * 
 * @ORM\HasLifecycleCallbacks
 */
class ContributionsEat
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamMeeting")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meeting_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $meeting;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysSessions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $sessions;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamContributions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamContributions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contributions_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $contributions;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="associations_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $associations;

    /**
     * @var \Member\MemberBundle\Entity\SysMembers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $members;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamEat
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamEat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eat_id", referencedColumnName="id")
     * })
     *
     * @Groups({"member"})
     */
    private $eat;



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ContributionsEat
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
     * Set meeting
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting
     *
     * @return ContributionsEat
     */
    public function setMeeting(\ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting)
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
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return ContributionsEat
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
     * Set contributions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contributions
     *
     * @return ContributionsEat
     */
    public function setContributions(\ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contributions)
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
     * @return ContributionsEat
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
     * @return ContributionsEat
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
     * Set eat
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat
     *
     * @return ContributionsEat
     */
    public function setEat(\ParamAdmin\ParamAdminBundle\Entity\ParamEat $eat)
    {
        $this->eat = $eat;

        return $this;
    }

    /**
     * Get eat
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\ParamEat
     */
    public function getEat()
    {
        return $this->eat;
    }
    
    
    /***************      EVENEMENTS      ******************/

    /**
     * @ORM\PrePersist
     */
    public function createDate() {
        $this->setCreatedAt(new \DateTime());
    }
}
