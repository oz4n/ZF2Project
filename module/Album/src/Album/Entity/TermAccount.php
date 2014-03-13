<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermAccount
 *
 * @ORM\Table(name="term_account", indexes={@ORM\Index(name="fk_term_account_account1_idx", columns={"account_id"})})
 * @ORM\Entity
 */
class TermAccount
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
     * @ORM\Column(name="key", type="string", length=255, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="autoload", type="string", length=5, nullable=true)
     */
    private $autoload = 'YES';

    /**
     * @var \Album\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Album\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * })
     */
    private $account;



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
     * Set key
     *
     * @param string $key
     * @return TermAccount
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return TermAccount
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set autoload
     *
     * @param string $autoload
     * @return TermAccount
     */
    public function setAutoload($autoload)
    {
        $this->autoload = $autoload;

        return $this;
    }

    /**
     * Get autoload
     *
     * @return string 
     */
    public function getAutoload()
    {
        return $this->autoload;
    }

    /**
     * Set account
     *
     * @param \Album\Entity\Account $account
     * @return TermAccount
     */
    public function setAccount(\Album\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Album\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
}
