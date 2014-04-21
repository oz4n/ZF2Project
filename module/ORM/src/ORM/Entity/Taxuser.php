<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taxuser
 *
 * @ORM\Table(name="taxuser", indexes={@ORM\Index(name="fk_taxuser_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class Taxuser
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
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="autoload", type="string", length=3, nullable=false)
     */
    private $autoload;

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
     * @return Taxuser
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
     * @return Taxuser
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
     * @return Taxuser
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
     * Set user
     *
     * @param \ORM\Entity\User $user
     * @return Taxuser
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
}
