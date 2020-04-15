<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MusiciensRepository")
 */
class Musiciens implements UserInterface,\Serializable
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
     * @ORM\Column(type="string", length=255)
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
     * @var array
     * @ORM\Column(name="roles", type="json")
     */
    private $roles = array();
        
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct() 
    {
        $this->isActive = true;
    }

    public function getRoles() 
    {
        // if (empty($this->roles)) {
            return ['ROLE_MUSICIENS'];
        // }
        // return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    function addRole($role) 
    {
        $this->roles[] = $role;
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
            $this->password,
            $this->isActive,
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->name,
            $this->password,
            $this->isActive,
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    function getIsActive() 
    {
        return $this->isActive;
    }

    function setIsActive($isActive) 
    {
        $this->isActive = $isActive;
    }
    
}
