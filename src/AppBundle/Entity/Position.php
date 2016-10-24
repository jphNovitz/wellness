<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PositionRepository")
 */
class Position
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
     * @ORM\Column(name="ordre", type="smallint")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Internaute", inversedBy="positions")
     * @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     */
    private $internaute;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Bloc", inversedBy="positions")
     * @ORM\JoinColumn(name="bloc_id", referencedColumnName="id")
     */
    private $bloc;

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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Position
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set internaute
     *
     * @param \AppBundle\Entity\internaute $internaute
     *
     * @return Position
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
     * Set bloc
     *
     * @param \AppBundle\Entity\bloc $bloc
     *
     * @return Position
     */
    public function setBloc(\AppBundle\Entity\bloc $bloc = null)
    {
        $this->bloc = $bloc;

        return $this;
    }

    /**
     * Get bloc
     *
     * @return \AppBundle\Entity\bloc
     */
    public function getBloc()
    {
        return $this->bloc;
    }
}
