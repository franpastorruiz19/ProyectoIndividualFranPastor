<?php

namespace App\Repository;

use App\Entity\Cliente;
use App\Entity\Empresa;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function insert(array $data): void
{
    $user = new User;
    $user
        ->setNombre($data['nombre'])
        ->setEmail($data['email'])
        ->setContrasena($data['contrasena'])
        ->setTipo($data['tipo']);
    $this->save($user, true);

    // Obtener el usuario recién guardado desde la base de datos
    $savedUser = $this->find($user->getId());

    if ($data['tipo'] == "Cliente") {
        $dataCliente = $data["cliente"];
        $cR = $this->getEntityManager()->getRepository(Cliente::class);
        $cR->insert($dataCliente, $savedUser);
    } else if ($data['tipo'] == "Empresa") {
        $dataEmpresa = $data["empresa"];
        $eR = $this->getEntityManager()->getRepository(Empresa::class);
        $eR->insert($dataEmpresa, $savedUser);
    }
}

    public function update(array $data): void
    {
        $user = $this->find($data['id']);
        $user
        ->setNombre($data['nombre'])
        ->setEmail($data['email'])
        ->setTipo($data['tipo']);
    $this->save($user, true);

    // Obtener el usuario recién guardado desde la base de datos
    $savedUser = $this->find($user->getId());

    if ($data['tipo'] == "Cliente") {
        $dataCliente = $data["cliente"];
        $cR = $this->getEntityManager()->getRepository(Cliente::class);
        $cR->update($dataCliente, $savedUser);
    } else if ($data['tipo'] == "Empresa") {
        $dataEmpresa = $data["empresa"];
        $eR = $this->getEntityManager()->getRepository(Empresa::class);
        $eR->update($dataEmpresa, $savedUser);
    }
    }

    public function delete(int $id): void
    {
        $user = $this->find($id);
        $this->remove($user, true);
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
