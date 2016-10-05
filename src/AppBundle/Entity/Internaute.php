<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Internaute
 *
 * @ORM\Table(name="internaute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InternauteRepository")
 */
class Internaute extends Utilisateur
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
     * @ORM\Column(name="nom", type="string", length=120, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=120, nullable=true)
     */
    private $prenom;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=true)
     */
    private $newsletter;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Abus", mappedBy="internaute")
     * @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     */
    private $abus;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Position", mappedBy="internaute")
     * @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     */
    private $Position;


    public function __construct() {
        $this->commentaires = new ArrayCollection();
        $this->setDateInscription(new \DateTime());
    }
    public function __toString()
    {
        return $this->getNom();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Internaute
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Internaute
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return Internaute
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }



    /**
     * Add abus
     *
     * @param \AppBundle\Entity\Abus $abus
     *
     * @return Internaute
     */
    public function addAbus(\AppBundle\Entity\Abus $abus)
    {
        $this->abus[] = $abus;

        return $this;
    }

    /**
     * Remove abus
     *
     * @param \AppBundle\Entity\Abus $abus
     */
    public function removeAbus(\AppBundle\Entity\Abus $abus)
    {
        $this->abus->removeElement($abus);
    }

    /**
     * Get abus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbus()
    {
        return $this->abus;
    }

    /**
     * Add position
     *
     * @param \AppBundle\Entity\Position $position
     *
     * @return Internaute
     */
    public function addPosition(\AppBundle\Entity\Position $position)
    {
        $this->Position[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param \AppBundle\Entity\Position $position
     */
    public function removePosition(\AppBundle\Entity\Position $position)
    {
        $this->Position->removeElement($position);
    }

    /**
     * Get position
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosition()
    {
        return $this->Position;
    }
}
