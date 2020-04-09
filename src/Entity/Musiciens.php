<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\Column(type="string")
     * * @Assert\Length(
     *      min = 1,
     *      max = 25,
     *      minMessage = "Le nom de votre groupe doit comporter au moins {{ limit }} lettre",
     *      maxMessage = "Le nom de votre groupe doit comporter au maximum {{ limit }} lettres",
     *      
     * )
     */
    private $nom_grp;

    /**
     * @ORM\Column(type="string")
     * * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Votre mail doit comporter au moins {{ limit }} lettre",
     *      maxMessage = "Votre mail doit comporter au maximum {{ limit }} lettres",
     *      
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 15,
     *      minMessage = "Votre nom doit comporter au moins {{ limit }} lettre",
     *      maxMessage = "Votre nom doit comporter au maximum {{ limit }} lettres",
     *      
     * )
     */
    private $nom_ref;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 15,
     *      minMessage = "Votre prénom doit comporter au moins {{ limit }} lettre",
     *      maxMessage = "Votre prénom doit comporter au maximum {{ limit }} lettres",
     *      
     * )
     */
    private $prenom_ref;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Votre n° doit comporter 10 numéro",
     *      maxMessage = "Votre n° doit comporter 10 numéro"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Assert\Range(
     *      min = 1,
     *      max = 12
     *)
     */
    private $nb_membres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $style;

    /**
     * @ORM\Column(type="text")
     * 
     * @Assert\Length(
     *      min = 50,
     *      max = 150,
     *      minMessage = "Votre description doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre description ne doit pas dépasser {{ limit }} caractères"
     *)
     */
    private $presentation_grp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;
    
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Manager;

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_MUSICIENS';
        return array_unique($roles);
        
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getManager(): ?string
    {
        return $this->Manager;
    }

    public function setManager(string $Manager): self
    {
        $this->Manager = $Manager;

        return $this;
    }
}
