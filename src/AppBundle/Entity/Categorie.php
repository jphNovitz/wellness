<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="enAvant", type="boolean")
     */
    private $enAvant;

    /**
     * @var bool
     *
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Prestataire", mappedBy="categories")
     * @ORM\JoinTable(name="prestataires_categories")
     */
    private $prestataires;


    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @Gedmo\Slug(fields={"id","nom"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    public function __construct()
    {
        $this->enAvant=false;
        $this->valide=false;
        $this->prestataires=new ArrayCollection();

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
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
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enAvant
     *
     * @param boolean $enAvant
     *
     * @return Categorie
     */
    public function setEnAvant($enAvant)
    {
        $this->enAvant = $enAvant;

        return $this;
    }

    /**
     * Get enAvant
     *
     * @return boolean
     */
    public function getEnAvant()
    {
        return $this->enAvant;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Categorie
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Add prestataire
     *
     * @param \AppBundle\Entity\Categorie $prestataire
     *
     * @return Categorie
     */
    public function addPrestataire(\AppBundle\Entity\Categorie $prestataire)
    {
        $this->prestataires[] = $prestataire;

        return $this;
    }

    /**
     * Remove prestataire
     *
     * @param \AppBundle\Entity\Categorie $prestataire
     */
    public function removePrestataire(\AppBundle\Entity\Categorie $prestataire)
    {
        $this->prestataires->removeElement($prestataire);
    }

    /**
     * Get prestataires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrestataires()
    {
        return $this->prestataires;
    }


    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Categorie
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }







    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Categorie
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
}
