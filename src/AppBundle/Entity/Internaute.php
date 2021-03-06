<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\Column(name="prenom", type="string", length=120, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="internautePhotos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $photos;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=false)
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
    private $positions;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Prestataire", inversedBy="favoris")
     */
    private $favoris;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="internaute")
     */
    private $commentaires;

    /**
     * Internaute constructor
     */

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->abus = new ArrayCollection();
        $this->photos=new ArrayCollection();
        $this->favoris=new ArrayCollection();
        $this->newsletter=1;

    }


    public function __toString()
    {
        return $this->getNom();
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
     * @return boolean
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
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param \AppBundle\Entity\Position $position
     */
    public function removePosition(\AppBundle\Entity\Position $position)
    {
        $this->positions->removeElement($position);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Image $photo
     *
     * @return Internaute
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
     * Add favori
     *
     * @param \AppBundle\Entity\Prestataire $favori
     *
     * @return Internaute
     */
    public function addFavori(\AppBundle\Entity\Prestataire $favori)
    {
        $this->favoris[] = $favori;

        return $this;
    }

    /**
     * Remove favori
     *
     * @param \AppBundle\Entity\Prestataire $favori
     */
    public function removeFavori(\AppBundle\Entity\Prestataire $favori)
    {
        $this->favoris->removeElement($favori);
    }

    /**
     * Get favoris
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoris()
    {
        return $this->favoris;
    }

    /**
     * @return ArrayCollection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * @param mixed $commentaire
     */
    public function addCommentaire($commentaire)
    {
        $this->commentaires->add($commentaire);
        $commentaire->setInternaute($this);
    }

    /**
     * @param mixed $commentaire
     */
    public function removeCommentaire($commentaire)
    {
        $this->commentaires->removeElement($commentaire);
        $commentaire->setInternaute(null);
    }


}
