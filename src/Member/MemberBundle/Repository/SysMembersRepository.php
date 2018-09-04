<?php

namespace Member\MemberBundle\Repository;

/**
 * Sys_MemberRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SysMembersRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMember($email) {
        $req = $this->createQueryBuilder('m')
                ->leftJoin('m.inscription', 'i')
                ->leftJoin('i.sessions', 's')
                ->addSelect('i')
                ->addSelect('s')
                ->where('m.email = :email')
                ->setParameter('email', $email)
            ;
        
        return $req->getQuery()->getResult();
    }
}