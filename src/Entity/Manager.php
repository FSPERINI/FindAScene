<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManagerRepository")
 */
class Manager
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(min = 3,      
     *      minMessage = "Le nom d'utilisateur doit comporter au moins {{ limit }} lettres"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64)
     *  @Assert\Length(
     *      min = 10,
     *      minMessage = "Votre mail doit comporter au moins {{ limit }} lettre"
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le nom de votre groupe doit comporter au moins {{ limit }} lettre"
     * )
     *     
     */
    private $groupe;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $city;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Assert\Length(
     *      min = 50,
     *      minMessage = "Votre description doit comporter au moins {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;
    
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_MANAGER';
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(?string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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
    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }
    
    public function eraseCredentials()
    {
        
    }
    
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->name,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}