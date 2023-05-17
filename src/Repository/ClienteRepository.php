<?php

namespace App\Repository;

use App\Entity\Cliente;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cliente>
 *
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    public function save(Cliente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cliente $entity, bool $flush = false): void
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

    $cliente = new Cliente;
    $cliente
        ->setTipoActividad($data['tipoActividad'])
        ->setDinero($data['dinero'])
        ->setIdUser($savedUser);

    $this->save($cliente, true);
}

    public function update(array $data, User $user): void
    {
        $em = $this->getEntityManager();
        $userRepository = $em->getRepository(User::class);
        $savedUser = $userRepository->find($user->getId());
    
        if (!$savedUser) {
            throw new \Exception('No se encontró ningún usuario con el ID proporcionado.');
        }

        $cliente = $this->find($data['idCliente']);
        $cliente
            ->setTipoActividad($data['tipoActividad'])
            ->setDinero($data['dinero']+$cliente->getDinero())
            ->setIdUser($savedUser);
        $this->save($cliente, true);
    }

    public function delete(int $id): void
    {
        $cliente = $this->find($id);
        $this->remove($cliente, true);
    }

//    /**
//     * @return Cliente[] Returns an array of Cliente objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cliente
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
