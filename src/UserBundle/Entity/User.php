<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    const ROLE_DEFAULT = 'ROLE_MEMBRE';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="registerat", type="datetime")
     */
    protected $registerat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe", type="boolean", nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=255, nullable=true)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="num_gsm", type="string", length=255, nullable=true)
     */
    private $numGsm;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_rue", type="string", length=255, nullable=true)
     */
    private $adrRue;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_cp", type="string", length=255, nullable=true)
     */
    private $adrCp;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_ville", type="string", length=255, nullable=true)
     */
    private $adrVille;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set registerat
     *
     * @param \DateTime $registerat
     *
     * @return User
     */
    public function setRegisterat($registerat)
    {
        $this->registerat = $registerat;

        return $this;
    }

    /**
     * Get registerat
     *
     * @return \DateTime
     */
    public function getRegisterat()
    {
        return $this->registerat;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
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
     * Set sexe
     *
     * @param boolean $sexe
     *
     * @return User
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
     * Set numTel
     *
     * @param string $numTel
     *
     * @return User
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set numGsm
     *
     * @param string $numGsm
     *
     * @return User
     */
    public function setNumGsm($numGsm)
    {
        $this->numGsm = $numGsm;

        return $this;
    }

    /**
     * Get numGsm
     *
     * @return string
     */
    public function getNumGsm()
    {
        return $this->numGsm;
    }

    /**
     * Set adrRue
     *
     * @param string $adrRue
     *
     * @return User
     */
    public function setAdrRue($adrRue)
    {
        $this->adrRue = $adrRue;

        return $this;
    }

    /**
     * Get adrRue
     *
     * @return string
     */
    public function getAdrRue()
    {
        return $this->adrRue;
    }

    /**
     * Set adrCp
     *
     * @param string $adrCp
     *
     * @return User
     */
    public function setAdrCp($adrCp)
    {
        $this->adrCp = $adrCp;

        return $this;
    }

    /**
     * Get adrCp
     *
     * @return string
     */
    public function getAdrCp()
    {
        return $this->adrCp;
    }

    /**
     * Set adrVille
     *
     * @param string $adrVille
     *
     * @return User
     */
    public function setAdrVille($adrVille)
    {
        $this->adrVille = $adrVille;

        return $this;
    }

    /**
     * Get adrVille
     *
     * @return string
     */
    public function getAdrVille()
    {
        return $this->adrVille;
    }
}
