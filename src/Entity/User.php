<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @ORM\Entity()
 * @package App\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=200)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $password;
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }
    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}