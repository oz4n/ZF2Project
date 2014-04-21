<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Taxonomy
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="taxonomy", indexes={@ORM\Index(name="fk_term_taxonomy_terminologi1_idx", columns={"term_id"}), @ORM\Index(name="fk_term_taxonomy_term_taxonomy1_idx", columns={"parent_id"})})
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Taxonomy
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="count", type="string", length=45, nullable=false)
     */
    private $count = '0';

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status = 'Publish';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '0';

    /**
     * @var integer
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer", nullable=true)
     */
    private $lft;

    /**
     * @var integer
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer", nullable=true)
     */
    private $rgt;

    /**
     * @var integer
     *
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="integer", nullable=true)
     */
    private $root;

    /**
     * @var integer
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     */
    private $lvl;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \ORM\Entity\Terminologi
     *
     * @ORM\ManyToOne(targetEntity="ORM\Entity\Terminologi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     * })
     */
    private $term;

    /**
     * @var \ORM\Entity\Taxonomy
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="ORM\Entity\Taxonomy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\File", inversedBy="tax")
     * @ORM\JoinTable(name="taxfilerelations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="tax_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *   }
     * )
     */
    private $file;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\Post", mappedBy="tax")
     */
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->file = new \Doctrine\Common\Collections\ArrayCollection();
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Taxonomy
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
     * @return Taxonomy
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
     * Set count
     *
     * @param string $count
     * @return Taxonomy
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Taxonomy
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Taxonomy
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Taxonomy
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     * @return Taxonomy
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Taxonomy
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer 
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Taxonomy
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Taxonomy
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer 
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Taxonomy
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
     * @return Taxonomy
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
     * Set term
     *
     * @param \ORM\Entity\Terminologi $term
     * @return Taxonomy
     */
    public function setTerm(\ORM\Entity\Terminologi $term = null)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return \ORM\Entity\Terminologi 
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set parent
     *
     * @param \ORM\Entity\Taxonomy $parent
     * @return Taxonomy
     */
    public function setParent(\ORM\Entity\Taxonomy $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ORM\Entity\Taxonomy 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add file
     *
     * @param \ORM\Entity\File $file
     * @return Taxonomy
     */
    public function addFile(\ORM\Entity\File $file)
    {
        $this->file[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \ORM\Entity\File $file
     */
    public function removeFile(\ORM\Entity\File $file)
    {
        $this->file->removeElement($file);
    }

    /**
     * Get file
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Add post
     *
     * @param \ORM\Entity\Post $post
     * @return Taxonomy
     */
    public function addPost(\ORM\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \ORM\Entity\Post $post
     */
    public function removePost(\ORM\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }
}
