<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @var int
     *
     * @ORM\Column(name="cote", type="smallint")
     */
    private $cote;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="encodageDate", type="date")
     */
    private $encodageDate;

    /*
     * L'entité commentaire est lié à Internaute et Prestataire mais n'appairait pas dans ces tables
     * pour moi c'est la table commentaire qui est au centre
     * l'internaute qui poste et le prestataire ne sont que des infos
     */

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Internaute")
     * @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     */
    private $internaute;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Prestataire")
     * @ORM\JoinColumn(name="prestataire_id", referencedColumnName="id")
     */
    private $prestataire;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Abus", mappedBy="commentaire")
     * @ORM\JoinColumn(name="abus_id", referencedColumnName="id")
     */
    private $abus;

    public function __construct()
    {
        $this->setencodageDate(new \DateTime());
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
     * Set cote
     *
     * @param integer $cote
     *
     * @return Commentaire
     */
    public function setCote($cote)
    {
        $this->cote = $cote;

        return $this;
    }

    /**
     * Get cote
     *
     * @return integer
     */
    public function getCote()
    {
        return $this->cote;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Commentaire
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set encodageDate
     *
     * @param \DateTime $encodageDate
     *
     * @return Commentaire
     */
    public function setEncodageDate($encodageDate)
    {
        $this->encodageDate = $encodageDate;

        return $this;
    }

    /**
     * Get encodageDate
     *
     * @return \DateTime
     */
    public function getEncodageDate()
    {
        return $this->encodageDate;
    }

    /**
     * Set internaute
     *
     * @param \AppBundle\Entity\Internaute $internaute
     *
     * @return Commentaire
     */
    public function setInternaute(\AppBundle\Entity\Internaute $internaute = null)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \AppBundle\Entity\Internaute
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set prestataire
     *
     * @param \AppBundle\Entity\Prestataire $prestataire
     *
     * @return Commentaire
     */
    public function setPrestataire(\AppBundle\Entity\Prestataire $prestataire = null)
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    /**
     * Get prestataire
     *
     * @return \AppBundle\Entity\Prestataire
     */
    public function getPrestataire()
    {
        return $this->prestataire;
    }

    /**
     * Add abus
     *
     * @param \AppBundle\Entity\Abus $abus
     *
     * @return Commentaire
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
}
