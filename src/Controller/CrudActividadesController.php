<?php


namespace App\Controller;

use App\Entity\Actividad;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/activities', name: 'api_activities')]
class CrudActividadesController extends AbstractController
{

    //Método que recoge los datos pasados por el request en forma de json y ejecuta la funcion insert pasandole esos datos.
    #[Route('/insert', name: 'insert', methods: ['POST'])]
    public function insert(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(Actividad::class)->insert($data);
        return $this->json(['message' => "Activity successfully inserted"]);
    }

    //Método que recoge el id de la cerveceria que queremos actualizar mediante la propia ruta.
    //Tambien recoge los datos pasados por el request en forma de json y ejecuta la funcion update pasandole esos datos mas el id.
    #[Route('/update', name: 'update', methods: ['PUT'])]
    public function update(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(Actividad::class)->update($data);
        return $this->json(['message' => "Activity successfully updated"]);
    }

    //Recoge el id de la cerveceria que queremos borrar mediante la propia ruta y ejecuta la funcion delete pasandole el id
    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $profRepository = $entityManager->getRepository(Actividad::class);
        $profRepository->delete($id);
        return $this->json(['message' => "Activity successfully deleted"]);
    }
}