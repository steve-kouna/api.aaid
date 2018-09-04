<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberEmprunt
 *
 * @ORM\Table(name="member__emprunt", indexes={@ORM\Index(name="fk_param__chest_has_member__members_member__members1_idx", columns={"members_id"}), @ORM\Index(name="fk_param__chest_has_member__members_param__chest1_idx", columns={"chest_id"}), @ORM\Index(name="fk_member__emprunt_param__associations1_idx", columns={"param__associations_id"}), @ORM\Index(name="fk_member__emprunt_param__sessions1_idx", columns={"sessions_id"})})
 * @ORM\Entity
 */
class MemberEmprunt
{
    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="refund_date", type="datetime", nullable=false)
     */
    private $refundDate;

    /**
     * @var string
     *
     * @ORM\Column(name="refund_amount", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $refundAmount;

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
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysChest
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysChest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chest_id", referencedColumnName="id")
     * })
     */
    private $chest;

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
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="param__associations_id", referencedColumnName="id")
     * })
     */
    private $paramAssociations;



    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return MemberEmprunt
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set refundDate
     *
     * @param \DateTime $refundDate
     *
     * @return MemberEmprunt
     */
    public function setRefundDate($refundDate)
    {
        $this->refundDate = $refundDate;

        return $this;
    }

    /**
     * Get refundDate
     *
     * @return \DateTime
     */
    public function getRefundDate()
    {
        return $this->refundDate;
    }

    /**
     * Set refundAmount
     *
     * @param string $refundAmount
     *
     * @return MemberEmprunt
     */
    public function setRefundAmount($refundAmount)
    {
        $this->refundAmount = $refundAmount;

        return $this;
    }

    /**
     * Get refundAmount
     *
     * @return string
     */
    public function getRefundAmount()
    {
        return $this->refundAmount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MemberEmprunt
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
     * @return MemberEmprunt
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
     * Set chest
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysChest $chest
     *
     * @return MemberEmprunt
     */
    public function setChest(\ParamAdmin\ParamAdminBundle\Entity\SysChest $chest)
    {
        $this->chest = $chest;

        return $this;
    }

    /**
     * Get chest
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\SysChest
     */
    public function getChest()
    {
        return $this->chest;
    }

    /**
     * Set members
     *
     * @param \Member\MemberBundle\Entity\SysMembers $members
     *
     * @return MemberEmprunt
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
     * @return MemberEmprunt
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
     * Set paramAssociations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $paramAssociations
     *
     * @return MemberEmprunt
     */
    public function setParamAssociations(\ParamAdmin\ParamAdminBundle\Entity\SysAssociations $paramAssociations)
    {
        $this->paramAssociations = $paramAssociations;

        return $this;
    }

    /**
     * Get paramAssociations
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     */
    public function getParamAssociations()
    {
        return $this->paramAssociations;
    }
}
