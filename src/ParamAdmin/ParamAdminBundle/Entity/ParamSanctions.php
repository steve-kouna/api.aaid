<?php

namespace ParamAdmin\ParamAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * ParamSanctions
 *
 * @ORM\Table(name="param__sanctions", indexes={@ORM\Index(name="fk_param__sanctions_param__associations1_idx", columns={"association_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * 
 * @Hateoas\Relation(
 *      "create",
 *      href = @Hateoas\Route(
 *          "post_sanction",
 *          absolute = true
 *      )
 * )
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "get_sanction",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      )
 * )
 * 
 * @Hateoas\Relation(
 *      "update",
 *      href = @Hateoas\Route(
 *          "put_sanction",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      )
 * )
 * 
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "delete_sanction",
 *          parameters = {"id" = "expr(object.getId())"},
 *          absolute = true
 *      )
 * )
 */
class ParamSanctions
{
    /**
     * @var string
     *
     * @ORM\Column(name="libel", type="string", length=100, nullable=false)
     * 
     * @Groups({"association", "sanction"})
     */
    private $libel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * 
     * @Groups({"association", "sanction"})
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=0, nullable=false)
     * 
     * @Groups({"association", "sanction"})
     */
    private $amount;

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
     * @Groups({"association", "sanction"})
     */
    private $id;

    /**
     * @var \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     *
     * @ORM\ManyToOne(targetEntity="ParamAdmin\ParamAdminBundle\Entity\SysAssociations", inversedBy="sanctions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="association_id", referencedColumnName="id")
     * })
     */
    private $association;

    /**
     * Set libel
     *
     * @param string $libel
     *
     * @return ParamSanctions
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
     * @return ParamSanctions
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
     * Set amount
     *
     * @param string $amount
     *
     * @return ParamSanctions
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ParamSanctions
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
     * @return ParamSanctions
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
     * Set association
     *
     * @param \ParamAdmin\ParamAdminBundle\Entity\SysAssociations $association
     *
     * @return ParamSanctions
     */
    public function setAssociation(\ParamAdmin\ParamAdminBundle\Entity\SysAssociations $association = null)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return \ParamAdmin\ParamAdminBundle\Entity\SysAssociations
     */
    public function getAssociation()
    {
        return $this->association;
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
