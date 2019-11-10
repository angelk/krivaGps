<?php

namespace App\Entity\Country;

use App\EntityTraits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="countries")
 */
class Country
{
    use NameTrait;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     */
    private $id;

    /**
     * @ORM\Column(name="geojson", type="json")
     */
    private $geojson;

    /**
     * Get country code
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Get GeoJSON data
     * @return string
     */
    public function getGeojson(): string
    {
        return $this->geojson;
    }
}
