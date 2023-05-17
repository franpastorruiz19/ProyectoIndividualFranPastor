<?php


namespace App\Controller;

use App\Entity\Empresa;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/empresa', name: 'api_empresa')]
class CrudEmpresaController extends AbstractController
{

    //Método que recoge los datos pasados por el request en forma de json y ejecuta la funcion insert pasandole esos datos.
    #[Route('/insert', name: 'insert', methods: ['POST'])]
    public function insert(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(Empresa::class)->insert($data);
        return $this->json(['message' => "Empresa successfully inserted"]);
    }

    //Método que recoge el id de la cerveceria que queremos actualizar mediante la propia ruta.
    //Tambien recoge los datos pasados por el request en forma de json y ejecuta la funcion update pasandole esos datos mas el id.
    #[Route('/update/{id}', name: 'update', methods: ['PUT'])]
    public function update(int $id, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(Empresa::class)->update($id, $data);
        return $this->json(['message' => "Empresa successfully updated"]);
    }

    //Recoge el id de la cerveceria que queremos borrar mediante la propia ruta y ejecuta la funcion delete pasandole el id
    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $profRepository = $entityManager->getRepository(Empresa::class);
        $profRepository->delete($id);
        return $this->json(['message' => "Empresa successfully deleted"]);
    }
}