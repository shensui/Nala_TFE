<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacte
 *
 * @ORM\Table(name="contacte")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ContacteRepository")
 */
class Contacte
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
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="destinataire", type="string", length=255)
     */
    private $destinataire;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="lut", type="string", length=1)
     */
    private $lut;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    public function __construct()
    {
        $this->date = new \Datetime();
        $this->lut  = '0'; /*non lut par défaut*/
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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Contacte
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set destinataire
     *
     * @param string $destinataire
     *
     * @return Contacte
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return string
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Contacte
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contacte
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Contacte
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lut
     *
     * @param string $lut
     *
     * @return Contacte
     */
    public function setLut($lut)
    {
        $this->lut = $lut;

        return $this;
    }

    /**
     * Get lut
     *
     * @return string
     */
    public function getLut()
    {
        return $this->lut;
    }
}
