<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=true, unique=true)
     * @Assert\Url()
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
     * @Assert\NotNull(message="Merci de remplir au moins une  categorie de service")
     *
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="prestatairePhotos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $photos;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="prestataireLogos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $logos;




    public function __construct()
    {
        $this->setDateInscription(new \DateTime());
        $this->categories = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->logos = new ArrayCollection();
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



    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Image $photo
     *
     * @return Prestataire
     */
    public function addPhoto(\AppBundle\Entity\Image $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Image $photo
     */
    public function removePhoto(\AppBundle\Entity\Image $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add logo
     *
     * @param \AppBundle\Entity\Image $logo
     *
     * @return Prestataire
     */
    public function addLogo(\AppBundle\Entity\Image $logo)
    {
        $this->logos[] = $logo;

        return $this;
    }

    /**
     * Remove logo
     *
     * @param \AppBundle\Entity\Image $logo
     */
    public function removeLogo(\AppBundle\Entity\Image $logo)
    {
        $this->logos->removeElement($logo);
    }

    /**
     * Get logos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogos()
    {
        return $this->logos;
    }
}
