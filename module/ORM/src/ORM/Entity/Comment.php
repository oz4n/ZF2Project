<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="fk_comment_post1_idx", columns={"post_id"}), @ORM\Index(name="fk_comment_comment1_idx", columns={"parent"})})
 * @ORM\Entity
 */
class Comment {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="author", type="string", length=128, nullable=false)
	 */
	private $author;
	
	/**
	 *
	 * @var string @ORM\Column(name="email", type="string", length=128, nullable=false)
	 */
	private $email;
	
	/**
	 *
	 * @var string @ORM\Column(name="url", type="string", length=128, nullable=true)
	 */
	private $url;
	
	/**
	 *
	 * @var string @ORM\Column(name="content", type="text", nullable=false)
	 */
	private $content;
	
	/**
	 *
	 * @var string @ORM\Column(name="status", type="string", length=5, nullable=false)
	 */
	private $status;
	
	/**
	 *
	 * @var \DateTime @ORM\Column(name="create_time", type="datetime", nullable=true)
	 */
	private $createTime;
	
	/**
	 *
	 * @var \ORM\Entity\Comment @ORM\ManyToOne(targetEntity="ORM\Entity\Comment")
	 *      @ORM\JoinColumns({
	 *      @ORM\JoinColumn(name="parent", referencedColumnName="id")
	 *      })
	 */
	private $parent;
	
	/**
	 *
	 * @var \ORM\Entity\Post @ORM\ManyToOne(targetEntity="ORM\Entity\Post")
	 *      @ORM\JoinColumns({
	 *      @ORM\JoinColumn(name="post_id", referencedColumnName="id")
	 *      })
	 */
	private $post;
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set author
	 *
	 * @param string $author        	
	 * @return Comment
	 */
	public function setAuthor($author) {
		$this->author = $author;
		
		return $this;
	}
	
	/**
	 * Get author
	 *
	 * @return string
	 */
	public function getAuthor() {
		return $this->author;
	}
	
	/**
	 * Set email
	 *
	 * @param string $email        	
	 * @return Comment
	 */
	public function setEmail($email) {
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Set url
	 *
	 * @param string $url        	
	 * @return Comment
	 */
	public function setUrl($url) {
		$this->url = $url;
		
		return $this;
	}
	
	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * Set content
	 *
	 * @param string $content        	
	 * @return Comment
	 */
	public function setContent($content) {
		$this->content = $content;
		
		return $this;
	}
	
	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 * Set status
	 *
	 * @param string $status        	
	 * @return Comment
	 */
	public function setStatus($status) {
		$this->status = $status;
		
		return $this;
	}
	
	/**
	 * Get status
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * Set createTime
	 *
	 * @param \DateTime $createTime        	
	 * @return Comment
	 */
	public function setCreateTime($createTime) {
		$this->createTime = $createTime;
		
		return $this;
	}
	
	/**
	 * Get createTime
	 *
	 * @return \DateTime
	 */
	public function getCreateTime() {
		return $this->createTime;
	}
	
	/**
	 * Set parent
	 *
	 * @param \ORM\Entity\Comment $parent        	
	 * @return Comment
	 */
	public function setParent(\ORM\Entity\Comment $parent = null) {
		$this->parent = $parent;
		
		return $this;
	}
	
	/**
	 * Get parent
	 *
	 * @return \ORM\Entity\Comment
	 */
	public function getParent() {
		return $this->parent;
	}
	
	/**
	 * Set post
	 *
	 * @param \ORM\Entity\Post $post        	
	 * @return Comment
	 */
	public function setPost(\ORM\Entity\Post $post = null) {
		$this->post = $post;
		
		return $this;
	}
	
	/**
	 * Get post
	 *
	 * @return \ORM\Entity\Post
	 */
	public function getPost() {
		return $this->post;
	}
}
