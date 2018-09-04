<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * SysSessions
 *
 * @ORM\Table(name="sys__sessions")
 * @ORM\Entity(repositoryClass="ParamAdmin\ParamAdminBundle\Repository\SysSessionsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SysSessions
{
    /**
     * @var \String
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="begin_date", type="date", nullable=false)
     * @Assert\Date()
     * 
     * @Groups({"member", "association", "session", "inscription", "token"})
     */
    private $beginDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="end_date", type="date", nullable=false)
     * @Assert\Date()
     * 
     * @Groups({"member", "association", "session", "inscription", "token"})
     */
    private $endDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     * 
     * @Groups({"member", "association", "session", "inscription", "token"})
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Groups({"member", "association", "inscription", "session", "token"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Member\MemberBundle\Entity\AssociationsMembersInscription", mappedBy="sessions")
     */
    private $inscription;

    /**
     * Set beginDate
     *
     * @param \Date $beginDate
     *
     * @return SysSessions
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get beginDate
     *
     * @return \Date
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set endDate
     *
     * @param \Date $endDate
     *
     * @return SysSessions
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \Date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return SysSessions
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
     * @return SysSessions
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
     * @return SysSessions
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SysSessions
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscription = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add inscription
     *
     * @param \Member\MemberBundle\Entity\AssociationsMembersInscription $inscription
     *
     * @return SysSessions
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
