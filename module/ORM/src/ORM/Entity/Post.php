<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="fk_post_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Post
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
     * @ORM\Column(name="title", type="string", length=225, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status = 'Draft';

    /**
     * @var string
     *
     * @ORM\Column(name="comment_status", type="string", length=15, nullable=true)
     */
    private $commentStatus = 'Enable';

    /**
     * @var integer
     *
     * @ORM\Column(name="like", type="integer", nullable=true)
     */
    private $like = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="unlike", type="integer", nullable=true)
     */
    private $unlike = '0';

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
     * @ORM\ManyToMany(targetEntity="ORM\Entity\Post", inversedBy="post")
     * @ORM\JoinTable(name="postrelations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *   }
     * )
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\Taxonomy", inversedBy="post")
     * @ORM\JoinTable(name="taxpostrelations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tax_id", referencedColumnName="id")
     *   }
     * )
     */
    private $tax;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parent = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
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
     * @return Post
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
     * Set commentStatus
     *
     * @param string $commentStatus
     * @return Post
     */
    public function setCommentStatus($commentStatus)
    {
        $this->commentStatus = $commentStatus;

        return $this;
    }

    /**
     * Get commentStatus
     *
     * @return string 
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * Set like
     *
     * @param integer $like
     * @return Post
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like
     *
     * @return integer 
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set unlike
     *
     * @param integer $unlike
     * @return Post
     */
    public function setUnlike($unlike)
    {
        $this->unlike = $unlike;

        return $this;
    }

    /**
     * Get unlike
     *
     * @return integer 
     */
    public function getUnlike()
    {
        return $this->unlike;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Add parent
     *
     * @param \ORM\Entity\Post $parent
     * @return Post
     */
    public function addParent(\ORM\Entity\Post $parent)
    {
        $this->parent[] = $parent;

        return $this;
    }

    /**
     * Remove parent
     *
     * @param \ORM\Entity\Post $parent
     */
    public function removeParent(\ORM\Entity\Post $parent)
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

    /**
     * Add tax
     *
     * @param \ORM\Entity\Taxonomy $tax
     * @return Post
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
