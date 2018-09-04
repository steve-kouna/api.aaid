<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;


/**
 * SysAssociations
 *
 * @ORM\Table(name="sys__associations", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"}), @ORM\UniqueConstraint(name="slogan_UNIQUE", columns={"slogan"})})
 * @ORM\Entity(repositoryClass="ParamAdmin\ParamAdminBundle\Repository\SysAssociationsRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "put_association",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "contribution"})
 * )
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "get_association",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "contribution"})
 * )
 * 
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "delete_association",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"member", "inscription", "association", "contribution"})
 * )
 * 
 * @Hateoas\Relation(
 *     "inscriptions",
 *     embedded = @Hateoas\Embedded("expr(object.getInscriptions())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 * 
 * @Hateoas\Relation(
 *     "contributions",
 *     embedded = @Hateoas\Embedded("expr(object.getContributions())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 *  
 * @Hateoas\Relation(
 *     "sanctions",
 *     embedded = @Hateoas\Embedded("expr(object.getSanctions())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 *  
 * @Hateoas\Relation(
 *     "offices",
 *     embedded = @Hateoas\Embedded("expr(object.getOffices())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 *  
 * @Hateoas\Relation(
 *     "meetings",
 *     embedded = @Hateoas\Embedded("expr(object.getMeetings())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 *  
 * @Hateoas\Relation(
 *     "chests",
 *     embedded = @Hateoas\Embedded("expr(object.getChests())"),
 *     exclusion = @Hateoas\Exclusion(groups = {"association"})
 * )
 * 
 */
class SysAssociations
{
    /**
     * @var string
     *
     * @ORM\Column(name="acronym", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     * 
     * @Groups({"member", "inscription", "association", "contribution"})
     */
    private $acronym;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delete", type="boolean", nullable=false)
     * @Assert\NotBlank()
     */
    private $isDelete = false;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     * 
     * @Groups({"member", "inscription", "association", "contribution", "token"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=255, nullable=true)
     * 
     * @Groups({"member", "inscription", "association", "contribution"})
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=45, nullable=true)
     * 
     * @Groups({"member", "inscription", "association", "contribution", "token"})
     */
    private $logo;
    
    
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
     * @Groups({"member", "inscription", "association", "contribution", "token"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Member\MemberBundle\Entity\AssociationsMembersInscription", mappedBy="associations")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamContributions", mappedBy="associations")
     */
    private $contributions;

    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamSanctions", mappedBy="association")
     */
    private $sanctions;

    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamOffices", mappedBy="associations")
     */
    private $offices;

    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\ParamMeeting", mappedBy="associations")
     */
    private $meetings;

    /**
     * @ORM\OneToMany(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysChest", mappedBy="associations")
     */
    private $chests;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SysAssociations
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
     * Set slogan
     *
     * @param string $slogan
     *
     * @return SysAssociations
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;

        return $this;
    }

    /**
     * Get slogan
     *
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return SysAssociations
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
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
     * Set acronym
     *
     * @param string $acronym
     *
     * @return SysAssociations
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;

        return $this;
    }

    /**
     * Get acronym
     *
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SysAssociations
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
     * @return SysAssociations
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
    

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return SysAssociations
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscriptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contributions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sanctions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->offices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meetings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->chests = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contribution
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contribution
     *
     * @return SysAssociations
     */
    public function addContribution(\ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contribution)
    {
        $this->contributions[] = $contribution;

        return $this;
    }

    /**
     * Remove contribution
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contribution
     */
    public function removeContribution(\ParamAdmin\ParamAdminBundle\Entity\ParamContributions $contribution)
    {
        $this->contributions->removeElement($contribution);
    }

    /**
     * Get contributions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContributions()
    {
        return $this->contributions;
    }

    /**
     * Add inscription
     *
     * @param \Member\MemberBundle\Entity\AssociationsMembersInscription $inscription
     *
     * @return SysAssociations
     */
    public function addInscription(\Member\MemberBundle\Entity\AssociationsMembersInscription $inscription)
    {
        $this->inscriptions[] = $inscription;

        return $this;
    }

    /**
     * Remove inscription
     *
     * @param \Member\MemberBundle\Entity\AssociationsMembersInscription $inscription
     */
    public function removeInscription(\Member\MemberBundle\Entity\AssociationsMembersInscription $inscription)
    {
        $this->inscriptions->removeElement($inscription);
    }

    /**
     * Get inscriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    /**
     * Add sanction
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanction
     *
     * @return SysAssociations
     */
    public function addSanction(\ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanction)
    {
        $this->sanctions[] = $sanction;

        return $this;
    }

    /**
     * Remove sanction
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanction
     */
    public function removeSanction(\ParamAdmin\ParamAdminBundle\Entity\ParamSanctions $sanction)
    {
        $this->sanctions->removeElement($sanction);
    }

    /**
     * Get sanctions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSanctions()
    {
        return $this->sanctions;
    }

    /**
     * Add office
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamOffices $office
     *
     * @return SysAssociations
     */
    public function addOffice(\ParamAdmin\ParamAdminBundle\Entity\ParamOffices $office)
    {
        $this->offices[] = $office;

        return $this;
    }

    /**
     * Remove office
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamOffices $office
     */
    public function removeOffice(\ParamAdmin\ParamAdminBundle\Entity\ParamOffices $office)
    {
        $this->offices->removeElement($office);
    }

    /**
     * Get offices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffices()
    {
        return $this->offices;
    }

    /**
     * Add meeting
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting
     *
     * @return SysAssociations
     */
    public function addMeeting(\ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting)
    {
        $this->meetings[] = $meeting;

        return $this;
    }

    /**
     * Remove meeting
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting
     */
    public function removeMeeting(\ParamAdmin\ParamAdminBundle\Entity\ParamMeeting $meeting)
    {
        $this->meetings->removeElement($meeting);
    }

    /**
     * Get meetings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetings()
    {
        return $this->meetings;
    }

    /**
     * Add chest
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysChest $chest
     *
     * @return SysAssociations
     */
    public function addChest(\ParamAdmin\ParamAdminBundle\Entity\SysChest $chest)
    {
        $this->chests[] = $chest;

        return $this;
    }

    /**
     * Remove chest
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysChest $chest
     */
    public function removeChest(\ParamAdmin\ParamAdminBundle\Entity\SysChest $chest)
    {
        $this->chests->removeElement($chest);
    }

    /**
     * Get chests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChests()
    {
        return $this->chests;
    }
}
