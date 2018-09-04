<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysTransactions
 *
 * @ORM\Table(name="sys__transactions", indexes={@ORM\Index(name="fk_sys__transactions_param__chest1_idx", columns={"chest_id"}), @ORM\Index(name="fk_sys__transactions_member__memebers1_idx", columns={"members_id"}), @ORM\Index(name="fk_sys__transactions_param__associations1_idx", columns={"associations_id"}), @ORM\Index(name="fk_sys__transactions_param__sessions1_idx", columns={"sessions_id"})})
 * @ORM\Entity
 */
class SysTransactions
{
    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $montant;

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
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysChest
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysChest")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chest_id", referencedColumnName="id")
     * })
     */
    private $chest;

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
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     */
    private $members;



    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return SysTransactions
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SysTransactions
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
     * @return SysTransactions
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
     * Set chest
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysChest $chest
     *
     * @return SysTransactions
     */
    public function setChest(\ParamAdmin\ParamAdminBundle\Entity\SysChest $chest = null)
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
     * Set associations
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $associations
     *
     * @return SysTransactions
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
     * @return SysTransactions
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
}
