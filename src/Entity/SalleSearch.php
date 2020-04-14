<?php

namespace App\Entity;

class SalleSearch {
    /**
     * @var string|null
     */
   private $city;

    /**
     * @var string|null
     */
   private $name;

    /**
    * @return string|null
    */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return SalleSearch
     */
    public function setCity(string $city): SalleSearch
    {
        $this->city = $city;

        return $this;
    }   

    /**
    * @return string|null
    */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return SalleSearch
     */
    public function setName(string $name): SalleSearch
    {
        $this->name = $name;

        return $this;
    }  
}