<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;


/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"Utilisateur" = "Utilisateur", "prestataire" = "Prestataire", "internaute" = "Internaute"})
 */
class Utilisateur implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */

    private $username;


    /**
     * @ORM\Column(name="salt", type="string", length=255)
     *
     */

    private $salt;


    /**
     * @ORM\Column(name="roles", type="array")
     */

    private $roles = array();


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=120, nullable=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Email '{{ value }}' ne semble pas valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseNum", type="string", length=3)
     * @Assert\NotNull()
     */
    private $adresseNum;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseRue", type="string", length=125)
     * @Assert\NotNull()
     */
    private $adresseRue;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="dateInscription", type="datetime")
     */
    private $dateInscription;


    /**
     * @var int
     *
     * @ORM\Column(name="essais", type="smallint")
     */
    private $essais = 3;

    /**
     * @var bool
     *
     * @ORM\Column(name="banni", type="boolean")
     */
    private $banni = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmation", type="boolean")
     */
    private $confirmation = false;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Localite",cascade={"persist"})
     * @ORM\JoinColumn(name="localite_id", referencedColumnName="id")
     */
    private $localite;


    /**
     * @Gedmo\Slug(fields={"nom","id"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    public function __construct()
    {
        $this->setDateInscription(new \DateTime());
        $this->roles = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Utilisateur
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
     * @return Utilisateur
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set adresseNum
     *
     * @param string $adresseNum
     *
     * @return Utilisateur
     */
    public function setAdresseNum($adresseNum)
    {
        $this->adresseNum = $adresseNum;

        return $this;
    }

    /**
     * Get adresseNum
     *
     * @return string
     */
    public function getAdresseNum()
    {
        return $this->adresseNum;
    }

    /**
     * Set adresseRue
     *
     * @param string $adresseRue
     *
     * @return Utilisateur
     */
    public function setAdresseRue($adresseRue)
    {
        $this->adresseRue = $adresseRue;

        return $this;
    }

    /**
     * Get adresseRue
     *
     * @return string
     */
    public function getAdresseRue()
    {
        return $this->adresseRue;
    }


    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Utilisateur
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
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
     * Set essais
     *
     * @param integer $essais
     *
     * @return Utilisateur
     */
    public function setEssais($essais)
    {
        $this->essais = $essais;

        return $this;
    }

    /**
     * Get essais
     *
     * @return int
     */
    public function getEssais()
    {
        return $this->essais;
    }

    /**
     * Set banni
     *
     * @param boolean $banni
     *
     * @return Utilisateur
     */
    public function setBanni($banni)
    {
        $this->banni = $banni;

        return $this;
    }

    /**
     * Get banni
     *
     * @return bool
     */
    public function getBanni()
    {
        return $this->banni;
    }

    /**
     * Set confirmation
     *
     * @param boolean $confirmation
     *
     * @return Utilisateur
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    /**
     * Get confirmation
     *
     * @return bool
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Set localite
     *
     * @param string $localite
     *
     * @return Utilisateur
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get localite
     *
     * @return string
     */
    public function getLocalite()
    {
        return $this->localite;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Utilisateur
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Utilisateur
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }


    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
        // rien pour l'instant
    }

    /**
     * @param $role
     * @return $this
     */
    public function addRole( $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Utilisateur
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
