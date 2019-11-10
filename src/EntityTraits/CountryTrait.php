<?php

namespace App\EntityTraits;

use App\Entity\Country\Country;

trait CountryTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country\Country")
     */
    private $country;


    /**
     * Get country
     *
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }
}