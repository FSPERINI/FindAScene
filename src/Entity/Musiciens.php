<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MusiciensRepository")
 */
class Musiciens
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_grp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_ref;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_membres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $style;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation_grp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGrp(): ?string
    {
        return $this->nom_grp;
    }

    public function setNomGrp(string $nom_grp): self
    {
        $this->nom_grp = $nom_grp;

        return $this;
    }
    
    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNomRef(): ?string
    {
        return $this->nom_ref;
    }

    public function setNomRef(string $nom_ref): self
    {
        $this->nom_ref = $nom_ref;

        return $this;
    }

    public function getPrenomRef(): ?string
    {
        return $this->prenom_ref;
    }

    public function setPrenomRef(string $prenom_ref): self
    {
        $this->prenom_ref = $prenom_ref;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNbMembres(): ?int
    {
        return $this->nb_membres;
    }

    public function setNbMembres(int $nb_membres): self
    {
        $this->nb_membres = $nb_membres;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getPresentationGrp(): ?string
    {
        return $this->presentation_grp;
    }

    public function setPresentationGrp(string $presentation_grp): self
    {
        $this->presentation_grp = $presentation_grp;

        return $this;
    }
}
