<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\Role", inversedBy="role")
     * @ORM\JoinTable(name="rolerelations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *   }
     * )
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parent = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * Set description
     *
     * @param string $description
     * @return Role
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
     * Add parent
     *
     * @param \ORM\Entity\Role $parent
     * @return Role
     */
    public function addParent(\ORM\Entity\Role $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent
     *
     * @param \ORM\Entity\Role $parent
     */
    public function removeParent(\ORM\Entity\Role $parent)
    {
        $this->parent->removeElement($parent);
    }

    /**
     * Get parent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
