<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermTaxonomy
 *
 * @ORM\Table(name="term_taxonomy", indexes={@ORM\Index(name="fk_term_taxonomy_term1_idx", columns={"parent"}), @ORM\Index(name="fk_term_taxonomy_term_taxonomy1_idx", columns={"term_taxonomy_id"})})
 * @ORM\Entity
 */
class TermTaxonomy
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
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description = '';

    /**
     * @var string
     *
     * @ORM\Column(name="count", type="string", length=45, nullable=false)
     */
    private $count = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status = 'D';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '0';

    /**
     * @var \Album\Entity\Terminologi
     *
     * @ORM\ManyToOne(targetEntity="Album\Entity\Terminologi")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Album\Entity\TermTaxonomy
     *
     * @ORM\ManyToOne(targetEntity="Album\Entity\TermTaxonomy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_taxonomy_id", referencedColumnName="id")
     * })
     */
    private $termTaxonomy;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Album\Entity\Post", mappedBy="termTaxonomy")
     */
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set type
     *
     * @param string $type
     * @return TermTaxonomy
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
     * Set description
     *
     * @param string $description
     * @return TermTaxonomy
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
     * @return TermTaxonomy
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
     * Set status
     *
     * @param string $status
     * @return TermTaxonomy
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
     * @return TermTaxonomy
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
     * Set parent
     *
     * @param \Album\Entity\Terminologi $parent
     * @return TermTaxonomy
     */
    public function setParent(\Album\Entity\Terminologi $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Album\Entity\Terminologi 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set termTaxonomy
     *
     * @param \Album\Entity\TermTaxonomy $termTaxonomy
     * @return TermTaxonomy
     */
    public function setTermTaxonomy(\Album\Entity\TermTaxonomy $termTaxonomy = null)
    {
        $this->termTaxonomy = $termTaxonomy;

        return $this;
    }

    /**
     * Get termTaxonomy
     *
     * @return \Album\Entity\TermTaxonomy 
     */
    public function getTermTaxonomy()
    {
        return $this->termTaxonomy;
    }

    /**
     * Add post
     *
     * @param \Album\Entity\Post $post
     * @return TermTaxonomy
     */
    public function addPost(\Album\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Album\Entity\Post $post
     */
    public function removePost(\Album\Entity\Post $post)
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
