<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imageType", type="string", length=20, nullable=true)
     */
    private $imageType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Internaute", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $internautePhotos;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Prestataire", inversedBy="photos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $prestatairePhotos;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Prestataire", inversedBy="logos")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $prestataireLogos;



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
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Image
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
     * Set imageType
     *
     * @param string $imageType
     *
     * @return Image
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;

        return $this;
    }

    /**
     * Get imageType
     *
     * @return string
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @return mixed
     */
    public function getInternautePhotos()
    {
        return $this->internautePhotos;
    }

    /**
     * @param mixed $internautePhotos
     */
    public function setInternautePhotos($internautePhotos)
    {
        $this->internautePhotos = $internautePhotos;
    }





    /**
     * Set prestatairePhotos
     *
     * @param \AppBundle\Entity\Prestataire $prestatairePhotos
     *
     * @return Image
     */
    public function setPrestatairePhotos(\AppBundle\Entity\Prestataire $prestatairePhotos = null)
    {
        $this->prestatairePhotos = $prestatairePhotos;

        return $this;
    }

    /**
     * Get prestatairePhotos
     *
     * @return \AppBundle\Entity\Prestataire
     */
    public function getPrestatairePhotos()
    {
        return $this->prestatairePhotos;
    }

    /**
     * Set prestataireLogos
     *
     * @param \AppBundle\Entity\Prestataire $prestataireLogos
     *
     * @return Image
     */
    public function setPrestataireLogos(\AppBundle\Entity\Prestataire $prestataireLogos = null)
    {
        $this->prestataireLogos = $prestataireLogos;

        return $this;
    }

    /**
     * Get prestataireLogos
     *
     * @return \AppBundle\Entity\Prestataire
     */
    public function getPrestataireLogos()
    {
        return $this->prestataireLogos;
    }
}
