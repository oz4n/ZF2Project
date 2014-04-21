<?php
namespace ZfcUser\Entity;

interface UserInterface
{

    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

   

    /**
     * Get userName.
     *
     * @return string
     */
    public function getUserName();

    /**
     * Set userName.
     *
     * @param string $username            
     * @return UserInterface
     */
    public function setUserName($username);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email.
     *
     * @param string $email            
     * @return UserInterface
     */
    public function setEmail($email);

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set displayName.
     *
     * @param string $displayName            
     * @return UserInterface
     */
    public function setDisplayName($displayName);

    /**
     * Get password.
     *
     * @return string password
     */
    public function getPassword();

    /**
     * Set password.
     *
     * @param string $password            
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * Get state.
     *
     * @return int
     */
    public function getState();

    /**
     * Set state.
     *
     * @param int $state            
     * @return UserInterface
     */
    public function setState($state);
}
