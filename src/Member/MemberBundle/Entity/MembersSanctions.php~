<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemebersSanctions
 *
 * @ORM\Table(name="members__sanctions", indexes={@ORM\Index(name="fk_member__memeber_has_param__sanctions_param__sanctions1_idx", columns={"sanctions_id"}), @ORM\Index(name="fk_member__memeber_has_param__sanctions_member__memeber_idx", columns={"member_id"}), @ORM\Index(name="fk_memebers__sanctions_param__sessions1_idx", columns={"sessions_id"})})
 * @ORM\Entity
 */
class MembersSanctions
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active = true;

    /**
     * @var string
     *
     * @ORM\Column(name="penalty", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $penalty;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     */
    private $dateEnd;

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
     * @var \ParamAdminMember\ParamAdminBundle\Entity\SysSessions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysSessions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sessions_id", referencedColumnName="id")
     * })
     */
    private $sessions;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamSanctions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sanctions_id", referencedColumnName="id")
     * })
     */
    private $sanctions;

    /**
     * @var \Member\MemberBundle\Entity\SysMembers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     * })
     */
    private $member;



    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return MemebersSanctions
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
     * Set penalty
     *
     * @param string $penalty
     *
     * @return MemebersSanctions
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * Get penalty
     *
     * @return string
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return MemebersSanctions
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MemebersSanctions
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
     * @return MemebersSanctions
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
     * Set sessions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysSessions $sessions
     *
     * @return MemebersSanctions
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
     * Set sanctions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanctions
     *
     * @return MemebersSanctions
     */
    public function setSanctions(\ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanctions)
    {
        $this->sanctions = $sanctions;

        return $this;
    }

    /**
     * Get sanctions
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions
     */
    public function getSanctions()
    {
        return $this->sanctions;
    }

    /**
     * Set member
     *
     * @param \Member\MemberBundle\Entity\SysMembers $member
     *
     * @return MemebersSanctions
     */
    public function setMember(\Member\MemberBundle\Entity\SysMembers $member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Member\MemberBundle\Entity\SysMembers
     */
    public function getMember()
    {
        return $this->member;
    }
}
