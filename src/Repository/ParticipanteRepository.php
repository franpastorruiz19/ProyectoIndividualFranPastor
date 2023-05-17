<?php

namespace App\Repository;

use App\Entity\Actividad;
use App\Entity\Cliente;
use App\Entity\Empresa;
use App\Entity\Participante;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Participante>
 *
 * @method Participante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participante[]    findAll()
 * @method Participante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participante::class);
    }

    public function save(Participante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Participante $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function registrarParticipante(array $data): void
    {
        $dataUser=$data['cliente'];
        $dataActividad=$data['actividad'];
        $uR=$this->getEntityManager()->getRepository(Cliente::class);
        $user = $uR->find($dataUser['idCliente']);
        $user
            ->setDinero($user->getDinero()-$dataActividad['precio']);
        $uR->save($user, true);

        $eR=$this->getEntityManager()->getRepository(Empresa::class);
        $empresa=$eR->find($dataActividad['idEmpresa']);
        $empresa
            ->setDinero($empresa->getDinero()+$dataActividad['precio']);
        $eR->save($empresa,true);
        
        $participante = new Participante;
        $participante
            ->setIdCliente($dataUser['idCliente'])
            ->setIdActividad($dataActividad['id']);
        $this->save($participante,true);
    }


    //    /**
    //     * @return Participante[] Returns an array of Participante objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Participante
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
