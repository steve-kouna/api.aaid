<?php

namespace Member\MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysHistory
 *
 * @ORM\Table(name="sys__history", indexes={@ORM\Index(name="fk_sys__history_member__members1_idx", columns={"members_id"})})
 * @ORM\Entity
 */
class SysHistory
{
    /**
     * @var string
     *
     * @ORM\Column(name="libel", type="string", length=45, nullable=false)
     */
    private $libel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * Set libel
     *
     * @param string $libel
     *
     * @return SysHistory
     */
    public function setLibel($libel)
    {
        $this->libel = $libel;

        return $this;
    }

    /**
     * Get libel
     *
     * @return string
     */
    public function getLibel()
    {
        return $this->libel;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SysHistory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
}
