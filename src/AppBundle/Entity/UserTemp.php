<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * UserTemp
 *
 * @ORM\Table(name="user_temp")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTempRepository")
 */
class UserTemp implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "Email '{{ value }}' ne semble pas valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, unique=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, unique=true)
     */
    private $salt;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->setSalt(uniqid(mt_rand()));
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }





    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getSalt()
    {
        return $this->salt;
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
     * Set username
     *
     * @param string $username
     *
     * @return UserTemp
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return UserTemp
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return UserTemp
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return UserTemp
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return UserTemp
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }



    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return UserTemp
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return UserTemp
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    public function serialize()
    {
        return serialize(array(
            $this->email,
            $this->username,
            $this->password,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->email,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

}
