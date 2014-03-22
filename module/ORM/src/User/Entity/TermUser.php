<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermUser
 *
 * @ORM\Table(name="term_user", indexes={@ORM\Index(name="fk_term_user_user1_idx", columns={"user_id"})})
 * @ORM\Entity
 */
class TermUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="term_key", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $termKey;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="autoload", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $autoload;

    /**
     * @var \User\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
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
     * Set termKey
     *
     * @param string $termKey
     * @return TermUser
     */
    public function setTermKey($termKey)
    {
        $this->termKey = $termKey;

        return $this;
    }

    /**
     * Get termKey
     *
     * @return string 
     */
    public function getTermKey()
    {
        return $this->termKey;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return TermUser
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
     * @return TermUser
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
     * @param \User\Entity\User $user
     * @return TermUser
     */
    public function setUser(\User\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
