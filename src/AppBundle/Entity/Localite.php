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
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=6, unique=false)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CodePostal",cascade={"persist"})
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="commune", type="string", length=100, nullable=true, unique=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commune",cascade={"persist"})
     */
    private $commune;




    public function __toString()
    {
        return $this->getLocalite();
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
     * @param string $codePostal
     *
     * @return Localite
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set commune
     *
     * @param string $commune
     *
     * @return Localite
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }
}
