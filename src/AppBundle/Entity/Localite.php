<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localite
 *
 * @ORM\Table(name="localite")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocaliteRepository")
 */
class Localite
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
     * @ORM\Column(name="localite", type="string", length=255, unique=true)
     */
    private $localite;

    /**
     * @var CodePostal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CodePostal",cascade={"persist"})
     * @ORM\JoinColumn(name="code_postal_id", referencedColumnName="id")
     */
    private $codePostal;

    /**
     * @var Commune
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commune",cascade={"persist"})
     * @ORM\JoinColumn(name="commune_id", referencedColumnName="id")
     */
    private $commune;

/*
 * ici je choisi de ne pas mettre de propriété Utilisateur car pour moi la localité n'est qu'une information pour l'utilisateur.
 * donc la localité n'a pas connaissance des utilisateur
 *
 */


    public function __toString()
    {
        return $this->getLocalite();
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
     * Set localite
     *
     * @param string $localite
     *
     * @return Localite
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
     * Set codePostal
     *
     * @param \AppBundle\Entity\CodePostal $codePostal
     *
     * @return Localite
     */
    public function setCodePostal(\AppBundle\Entity\CodePostal $codePostal = null)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return \AppBundle\Entity\CodePostal
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set commune
     *
     * @param \AppBundle\Entity\Commune $commune
     *
     * @return Localite
     */
    public function setCommune(\AppBundle\Entity\Commune $commune = null)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return \AppBundle\Entity\Commune
     */
    public function getCommune()
    {
        return $this->commune;
    }
}
