<?php

namespace UserBundle\Repository;

/**
 * DispoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DispoRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $data
     * @return array
     */
    public function isDispo($data){
        $query = $this->createQueryBuilder('d');
        $query->where('d.animal = :type')
              ->andWhere('d.dispoDebut >= :min_date')
              ->andWhere('d.dispoFin <= :max_date');

        /*$query->join('d.membre', 'm')
              ->addSelect('m')
              ->where('m.adr_ville = :ville')
             ->setParameter('ville',$data['ville']);*/
        $query->setParameter('type',$data['type']);
        $query->setParameter('min_date',$data['min_date']);
        $query->setParameter('max_date',$data['max_date']);
        //$query->setParameters($parameter);

        return $query->getQuery()->getResult();
    }
}