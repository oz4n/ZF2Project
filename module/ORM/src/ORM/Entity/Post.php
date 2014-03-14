<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="fk_post_account1_idx", columns={"account_id"}), @ORM\Index(name="fk_post_post1_idx", columns={"parent"})})
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="slug", type="text", nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=5, nullable=false)
     */
    private $status = 'P';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=false)
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime", nullable=false)
     */
    private $updateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_status", type="string", length=5, nullable=true)
     */
    private $commentStatus = 'E';

    /**
     * @var string
     *
     * @ORM\Column(name="post_status", type="string", length=25, nullable=true)
     */
    private $postStatus;

    /**
     * @var \ORM\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="ORM\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \ORM\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="ORM\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * })
     */
    private $account;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\TermTaxonomy", inversedBy="post")
     * @ORM\JoinTable(name="relationships",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="term_taxonomy_id", referencedColumnName="id")
     *   }
     * )
     */
    private $termTaxonomy;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->termTaxonomy = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tags
     *
     * @param string $tags
     * @return Post
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
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
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Post
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Post
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
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
     * Set postStatus
     *
     * @param string $postStatus
     * @return Post
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return string 
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set parent
     *
     * @param \ORM\Entity\Post $parent
     * @return Post
     */
    public function setParent(\ORM\Entity\Post $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ORM\Entity\Post 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set account
     *
     * @param \ORM\Entity\Account $account
     * @return Post
     */
    public function setAccount(\ORM\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \ORM\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Add termTaxonomy
     *
     * @param \ORM\Entity\TermTaxonomy $termTaxonomy
     * @return Post
     */
    public function addTermTaxonomy(\ORM\Entity\TermTaxonomy $termTaxonomy)
    {
        $this->termTaxonomy[] = $termTaxonomy;

        return $this;
    }

    /**
     * Remove termTaxonomy
     *
     * @param \ORM\Entity\TermTaxonomy $termTaxonomy
     */
    public function removeTermTaxonomy(\ORM\Entity\TermTaxonomy $termTaxonomy)
    {
        $this->termTaxonomy->removeElement($termTaxonomy);
    }

    /**
     * Get termTaxonomy
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTermTaxonomy()
    {
        return $this->termTaxonomy;
    }
}
