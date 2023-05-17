<?php


namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/user', name: 'api_user')]
class CrudUserController extends AbstractController
{

    #[Route('/insert', name: 'insert', methods: ['POST'])]
    public function insert(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(User::class)->insert($data);
        return $this->json(['message' => "User successfully inserted"]);
    }

    #[Route('/update', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(User::class)->update($data);
        $cliente = $entityManager->getRepository(Cliente::class)->findOneBy([
            'user' => $data['id'],
        ]);
        return new JsonResponse([
            'dinero' => $cliente->getDinero(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $profRepository = $entityManager->getRepository(User::class);
        $profRepository->delete($id);
        return $this->json(['message' => "User successfully deleted"]);
    }
}