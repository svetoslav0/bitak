<?php


namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\ORMException;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(User::class));
    }

    public function insert(User $user)
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
            return true;
        } catch (ORMException $e) {
            return false;
        }
    }
}
