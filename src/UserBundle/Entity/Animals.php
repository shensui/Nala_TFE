<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use UserBundle\Entity\User;

/**
 * Animals
 *
 * @ORM\Table(name="animals")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\AnimalsRepository")
 * @Gedmo\SoftDeleteable(fieldName="deleteAt", timeAware=false)

 */
class Animals
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe", type="boolean")
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=255)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="santee", type="text")
     */
    private $santee;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $propietaire;

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
     * Set name
     *
     * @param string $name
     *
     * @return Animals
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Animals
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set sexe
     *
     * @param boolean $sexe
     *
     * @return Animals
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return boolean
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set age
     *
     * @param string $age
     *
     * @return Animals
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set santee
     *
     * @param string $santee
     *
     * @return Animals
     */
    public function setSantee($santee)
    {
        $this->santee = $santee;

        return $this;
    }

    /**
     * Get santee
     *
     * @return string
     */
    public function getSantee()
    {
        return $this->santee;
    }

    /**
     * Set deleteAt
     *
     * @param \DateTime $deleteAt
     *
     * @return Animals
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
     * Set propietaire
     *
     * @param \UserBundle\Entity\User $propietaire
     *
     * @return Animals
     */
    public function setPropietaire(User $propietaire)
    {
        $this->propietaire = $propietaire;

        return $this;
    }

    /**
     * Get propietaire
     *
     * @return \UserBundle\Entity\User
     */
    public function getPropietaire()
    {
        return $this->propietaire;
    }
}
