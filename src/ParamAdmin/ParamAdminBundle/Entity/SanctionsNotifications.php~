<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SanctionsNotifications
 *
 * @ORM\Table(name="sanctions__notifications")
 * @ORM\Entity
 */
class SanctionsNotifications {
    
    /**
     * @var \boolean
     *
     * @ORM\Column(name="view", type="boolean", nullable=false)
     */
    private $view  = false;
    
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
     * @var \Member\MemberBundle\Entity\SysMembers
     * @ORM\id
     * @ORM\ManyToOne(targetEntity="Member\MemberBundle\Entity\SysMembers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="members_id", referencedColumnName="id")
     * })
     */
    private $members;
    
    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions
     * @ORM\id
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamSanctions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sanctions_id", referencedColumnName="id")
     * })
     */
    private $sanctions;


    /**
     * Set view
     *
     * @param boolean $view
     *
     * @return SanctionsNotifications
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return boolean
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SanctionsNotifications
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
     * @return SanctionsNotifications
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
     * Set members
     *
     * @param \Member\MemberBundle\Entity\SysMembers $members
     *
     * @return SanctionsNotifications
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
     * Set sanctions
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanctions
     *
     * @return SanctionsNotifications
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
}
