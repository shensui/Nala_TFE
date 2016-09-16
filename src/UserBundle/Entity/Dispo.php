<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\User;

/**
 * Dispo
 *
 * @ORM\Table(name="dispo")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\DispoRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleteAt", timeAware=false)
 */
class Dispo
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
     * @ORM\Column(name="dispoDebut", type="datetime")
     */
    private $dispoDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dispoFin", type="datetime")
     */
    private $dispoFin;

    /**
     * @var string
     *
     * @ORM\Column(name="animal", type="string", length=255)
     */
    private $animal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $membre;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="deleteAt", type="datetime", nullable=true)
     */
    private $deleteAt;


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
     * Set dispoDebut
     *
     * @param \DateTime $dispoDebut
     *
     * @return Dispo
     */
    public function setDispoDebut($dispoDebut)
    {
        $this->dispoDebut = $dispoDebut;

        return $this;
    }

    /**
     * Get dispoDebut
     *
     * @return \DateTime
     */
    public function getDispoDebut()
    {
        return $this->dispoDebut;
    }

    /**
     * Set dispoFin
     *
     * @param \DateTime $dispoFin
     *
     * @return Dispo
     */
    public function setDispoFin($dispoFin)
    {
        $this->dispoFin = $dispoFin;

        return $this;
    }

    /**
     * Get dispoFin
     *
     * @return \DateTime
     */
    public function getDispoFin()
    {
        return $this->dispoFin;
    }

    /**
     * Set animal
     *
     * @param string $animal
     *
     * @return Dispo
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return string
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Dispo
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Dispo
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set deleteAt
     *
     * @param \DateTime $deleteAt
     *
     * @return Dispo
     */
    public function setDeleteAt($deleteAt)
    {
        $this->deleteAt = $deleteAt;

        return $this;
    }

    /**
     * Get deleteAt
     *
     * @return \DateTime
     */
    public function getDeleteAt()
    {
        return $this->deleteAt;
    }

    /**
     * Set membre
     *
     * @param \UserBundle\Entity\User $membre
     *
     * @return Dispo
     */
    public function setMembre(\UserBundle\Entity\User $membre)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get membre
     *
     * @return \UserBundle\Entity\User
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Dispo
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
}
