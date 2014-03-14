<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lookup
 *
 * @ORM\Table(name="lookup")
 * @ORM\Entity
 */
class Lookup {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="name", type="string", length=128, nullable=false)
	 */
	private $name;
	
	/**
	 *
	 * @var string @ORM\Column(name="code", type="string", length=15, nullable=false)
	 */
	private $code;
	
	/**
	 *
	 * @var string @ORM\Column(name="type", type="string", length=128, nullable=false)
	 */
	private $type;
	
	/**
	 *
	 * @var integer @ORM\Column(name="position", type="integer", nullable=false)
	 */
	private $position;
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set name
	 *
	 * @param string $name        	
	 * @return Lookup
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Set code
	 *
	 * @param string $code        	
	 * @return Lookup
	 */
	public function setCode($code) {
		$this->code = $code;
		
		return $this;
	}
	
	/**
	 * Get code
	 *
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}
	
	/**
	 * Set type
	 *
	 * @param string $type        	
	 * @return Lookup
	 */
	public function setType($type) {
		$this->type = $type;
		
		return $this;
	}
	
	/**
	 * Get type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Set position
	 *
	 * @param integer $position        	
	 * @return Lookup
	 */
	public function setPosition($position) {
		$this->position = $position;
		
		return $this;
	}
	
	/**
	 * Get position
	 *
	 * @return integer
	 */
	public function getPosition() {
		return $this->position;
	}
}
