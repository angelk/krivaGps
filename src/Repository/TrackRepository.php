<?php

namespace App\Repository;

use App\Entity\Track;
use Doctrine\ORM\EntityRepository;

class TrackRepository extends EntityRepository
{
    public function getAllRelatedDownhillVersions(Track $track, $useCache = false)
    {
        $qb = $this->createQueryBuilder('t');
        $qb->join('t.downhills', 'dh');
        $qb->where('dh = :dh');
        $qb->setParameter(':dh', $track);

        $result = $qb->getQuery()->execute();

        $versions = $track->getVersions()->toArray();
        $versions = array_merge($versions, $track->getDownhillVersions($useCache));

        foreach ($result as $relatedDh) {
            /* @var $relatedDh Track */
            foreach ($relatedDh->getVersions() as $version) {
                if (array_search($version, $versions) === false) {
                    $versions[] = $version;
                }
            }

            foreach ($relatedDh->getDownhillVersions($useCache, $versions) as $version) {
                if (array_search($version, $versions) === false) {
                    $versions[] = $version;
                }
            }
        }

        // remove given track versions
        foreach ($track->getVersions() as $version) {
            array_shift($versions);
        }

        return $versions;
    }

    public function getAllRelatedUphillVersions(Track $track, $useCache = false)
    {
        $qb = $this->createQueryBuilder('t');
        $qb->join('t.uphills', 'uh');
        $qb->where('uh = :uh');
        $qb->setParameter(':uh', $track);

        $result = $qb->getQuery()->execute();

        $versions = $track->getVersions()->toArray();
        $versions = array_merge($versions, $track->getUphillVersions($useCache));

        foreach ($result as $relatedUh) {
            /* @var $relatedUh Track */
            foreach ($relatedUh->getVersions() as $version) {
                if (array_search($version, $versions) === false) {
                    $versions[] = $version;
                }
            }


            foreach ($relatedUh->getUphillVersions($useCache, $versions) as $uphillVersion) {
                if (array_search($uphillVersion, $versions) === false) {
                    $versions[] = $uphillVersion;
                }
            }
        }

        // remove given track versions
        foreach ($track->getVersions() as $version) {
            array_shift($versions);
        }

        return $versions;
    }
}
