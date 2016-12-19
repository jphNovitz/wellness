<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abus
 *
 * @ORM\Table(name="abus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AbusRepository")
 */
class Abus
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
     * @var \DateTime
     *
     * @ORM\Column(name="encodageDate", type="date")
     */
    private $encodageDate;


    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Commentaire", inversedBy="abus")
     * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id")
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\internaute", inversedBy="abus")
     * @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     */
    private $internaute;

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
     * Set description
     *
     * @param string $description
     *
     * @return Abus
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
     * Set commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return Abus
     */
    public function setCommentaire(\AppBundle\Entity\Commentaire $commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \AppBundle\Entity\Commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set internaute
     *
     * @param \AppBundle\Entity\internaute $internaute
     *
     * @return Abus
     */
    public function setInternaute(\AppBundle\Entity\internaute $internaute = null)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \AppBundle\Entity\internaute
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set encodageDate
     *
     * @param \DateTime $encodageDate
     *
     * @return Abus
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
}
