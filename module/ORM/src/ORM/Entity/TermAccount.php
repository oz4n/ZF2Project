<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermAccount
 *
 * @ORM\Table(name="term_account", indexes={@ORM\Index(name="fk_term_account_account1_idx", columns={"account_id"})})
 * @ORM\Entity
 */
class TermAccount {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="term_key", type="string", length=255, nullable=false)
	 */
	private $termKey;
	
	/**
	 *
	 * @var string @ORM\Column(name="value", type="string", length=255, nullable=false)
	 */
	private $value;
	
	/**
	 *
	 * @var string @ORM\Column(name="autoload", type="string", length=5, nullable=true)
	 */
	private $autoload = 'YES';
	
	/**
	 *
	 * @var \ORM\Entity\Account @ORM\ManyToOne(targetEntity="ORM\Entity\Account")
	 *      @ORM\JoinColumns({
	 *      @ORM\JoinColumn(name="account_id", referencedColumnName="id")
	 *      })
	 */
	private $account;
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set termKey
	 *
	 * @param string $termKey        	
	 * @return TermAccount
	 */
	public function setTermKey($termKey) {
		$this->termKey = $termKey;
		
		return $this;
	}
	
	/**
	 * Get termKey
	 *
	 * @return string
	 */
	public function getTermKey() {
		return $this->termKey;
	}
	
	/**
	 * Set value
	 *
	 * @param string $value        	
	 * @return TermAccount
	 */
	public function setValue($value) {
		$this->value = $value;
		
		return $this;
	}
	
	/**
	 * Get value
	 *
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}
	
	/**
	 * Set autoload
	 *
	 * @param string $autoload        	
	 * @return TermAccount
	 */
	public function setAutoload($autoload) {
		$this->autoload = $autoload;
		
		return $this;
	}
	
	/**
	 * Get autoload
	 *
	 * @return string
	 */
	public function getAutoload() {
		return $this->autoload;
	}
	
	/**
	 * Set account
	 *
	 * @param \ORM\Entity\Account $account        	
	 * @return TermAccount
	 */
	public function setAccount(\ORM\Entity\Account $account = null) {
		$this->account = $account;
		
		return $this;
	}
	
	/**
	 * Get account
	 *
	 * @return \ORM\Entity\Account
	 */
	public function getAccount() {
		return $this->account;
	}
}
