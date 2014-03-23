<?php

namespace ORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRole
 *
 * @ORM\Table(name="user_role", indexes={@ORM\Index(name="fk_user_role_user_role1_idx", columns={"parent_id"})})
 * @ORM\Entity
 */
class UserRole
{
    /**
     * @var string
     *
     * @ORM\Column(name="role_id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean", nullable=false)
     */
    private $isDefault;

    /**
     * @var \ORM\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="ORM\Entity\UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="role_id")
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ORM\Entity\User", inversedBy="role")
     * @ORM\JoinTable(name="user_role_linker",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     *   }
     * )
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get roleId
     *
     * @return string 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return UserRole
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set parent
     *
     * @param \ORM\Entity\UserRole $parent
     * @return UserRole
     */
    public function setParent(\ORM\Entity\UserRole $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \ORM\Entity\UserRole 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add user
     *
     * @param \ORM\Entity\User $user
     * @return UserRole
     */
    public function addUser(\ORM\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \ORM\Entity\User $user
     */
    public function removeUser(\ORM\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}
