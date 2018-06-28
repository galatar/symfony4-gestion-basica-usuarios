<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class PersonaRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    /**
     * @return array Persona
     */
    public function findAll()
    {
        return parent::findAll(); // TODO: Change the autogenerated stub
    }

    /**
     * @param string $cadena
     * @return array Persona
     */
    public function findByEmail(string $cadena)
    {
        return $this->createQueryBuilder('g')
            ->where('g.correo = :value')->setParameter('value', $cadena)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Persona $persona
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Persona $persona)
    {
        $this->getEntityManager()->persist($persona);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $correo
     * @return mixed|null|\Symfony\Component\Security\Core\User\UserInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($correo)
    {
        return $this->createQueryBuilder('p')
            ->where('p.correo = :correo')
            ->setParameter('correo', $correo)
            ->getQuery()
            ->getOneOrNullResult();
    }

}