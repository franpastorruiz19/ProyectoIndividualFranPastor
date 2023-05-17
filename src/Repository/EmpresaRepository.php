<?php

namespace App\Repository;

use App\Entity\Empresa;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Empresa>
 *
 * @method Empresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Empresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Empresa[]    findAll()
 * @method Empresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Empresa::class);
    }

    public function save(Empresa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Empresa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   
        public function insert(array $data, User $user): void
        {
            $em = $this->getEntityManager();
            $userRepository = $em->getRepository(User::class);
            $savedUser = $userRepository->find($user->getId());
        
            if (!$savedUser) {
                throw new \Exception('No se encontró ningún usuario con el ID proporcionado.');
            }
        
            $empresa = new Empresa;
            $empresa
                ->setTipoEmpresa($data['tipoEmpresa'])
                ->setDinero($data['dinero'])
                ->setIdUser($savedUser);
        
            $this->save($empresa, true);
        }
    

    public function update(array $data, User $user): void
    {
        $em = $this->getEntityManager();
        $userRepository = $em->getRepository(User::class);
        $savedUser = $userRepository->find($user->getId());
    
        if (!$savedUser) {
            throw new \Exception('No se encontró ningún usuario con el ID proporcionado.');
        }
        $empresa = $this->find($data['idEmpresa']);
        $empresa
        ->setTipoEmpresa($data['tipoEmpresa'])
        ->setDinero($data['dinero'])
        ->setIdUser($savedUser);
    $this->save($empresa, true);
    }

    public function delete(int $id): void
    {
        $empresa = $this->find($id);
        $this->remove($empresa, true);
    }

//    /**
//     * @return Empresa[] Returns an array of Empresa objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Empresa
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
