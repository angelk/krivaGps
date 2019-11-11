<?php

namespace App\Twig;

use App\Entity\Country\Country;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CountryFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('app_country_bbox', [$this, 'bbox']),
        ];
    }

    public function bbox(Country $country)
    {
        $geojson = $country->getGeojson();
        $bbox = $geojson['features'][0]['bbox'];
        return [
            [$bbox[1], $bbox[0]],
            [$bbox[3], $bbox[2]],
        ];
    }
}
