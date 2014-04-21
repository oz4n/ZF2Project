<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file", indexes={@ORM\Index(name="fk_file_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class File
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="orginal_name", type="string", length=255, nullable=false)
     */
    private $orginalName;

    /**
     * @var string
     *
     * @ORM\Column(name="unique_name", type="string", length=45, nullable=false)
     */
    private $uniqueName;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="file_type", type="string", length=15, nullable=false)
     */
    private $fileType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \ORM\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ORM\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\Taxonomy", mappedBy="file")
     */
    private $tax;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tax = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return File
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
     * Set orginalName
     *
     * @param string $orginalName
     * @return File
     */
    public function setOrginalName($orginalName)
    {
        $this->orginalName = $orginalName;

        return $this;
    }

    /**
     * Get orginalName
     *
     * @return string 
     */
    public function getOrginalName()
    {
        return $this->orginalName;
    }

    /**
     * Set uniqueName
     *
     * @param string $uniqueName
     * @return File
     */
    public function setUniqueName($uniqueName)
    {
        $this->uniqueName = $uniqueName;

        return $this;
    }

    /**
     * Get uniqueName
     *
     * @return string 
     */
    public function getUniqueName()
    {
        return $this->uniqueName;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return File
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fileType
     *
     * @param string $fileType
     * @return File
     */
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get fileType
     *
     * @return string 
     */
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return File
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
     * Set created
     *
     * @param \DateTime $created
     * @return File
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return File
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \ORM\Entity\User $user
     * @return File
     */
    public function setUser(\ORM\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ORM\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add tax
     *
     * @param \ORM\Entity\Taxonomy $tax
     * @return File
     */
    public function addTax(\ORM\Entity\Taxonomy $tax)
    {
        $this->tax[] = $tax;

        return $this;
    }

    /**
     * Remove tax
     *
     * @param \ORM\Entity\Taxonomy $tax
     */
    public function removeTax(\ORM\Entity\Taxonomy $tax)
    {
        $this->tax->removeElement($tax);
    }

    /**
     * Get tax
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTax()
    {
        return $this->tax;
    }
}
