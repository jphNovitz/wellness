<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Prestataire
 *
 * @ORM\Table(name="prestataire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrestataireRepository")
 */
class Prestataire extends Utilisateur
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true, unique=true)
     */
    private $siteWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", nullable=true, length=15)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="tva", type="string", nullable=true, length=20, unique=true)
     */
    private $tva;



    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Categorie", inversedBy="prestataires")
     * @ORM\JoinTable(name="prestataires_categories")
     */
    private $categories;

    /**
     *
     * @ORM\Column(name="images", nullable=true)
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="prestataire")
     */
    private $images;

    public function __construct()
    {
        $this->setDateInscription(new \DateTime());
        $this->categories= new ArrayCollection();
    }



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Prestataire
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
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Prestataire
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Prestataire
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set tva
     *
     * @param string $tva
     *
     * @return Prestataire
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }


    /**
     * Set images
     *
     * @param string $images
     *
     * @return Prestataire
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categorie $category
     *
     * @return Prestataire
     */
    public function addCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Categorie $category
     */
    public function removeCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
