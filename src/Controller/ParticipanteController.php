<?php


namespace App\Controller;

use App\Entity\Actividad;
use App\Entity\Participante;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

#[Route('/participantes', name: 'api_participantes')]
class ParticipanteController extends AbstractController
{

    //Método que recoge los datos pasados por el request en forma de json y ejecuta la funcion insert pasandole esos datos.
    #[Route('/insert', name: 'insert', methods: ['POST'])]
    public function insert(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager->getRepository(Participante::class)->registrarParticipante($data);
        return $this->json(['message' => "Participante successfully inserted"]);
    }

    #[Route('/{idCliente}/{idActividad}', name: 'app_partic')]
    public function getParticipante(EntityManagerInterface $em, int $idCliente, int $idActividad): Response
{
    $participante = $em->getRepository(Participante::class)->findOneBy([
        'idCliente' => $idCliente,
        'idActividad' => $idActividad,
    ]);

    // Si no se encontró el usuario, devuelve una respuesta con un mensaje de error
    if (!$participante) {
        return new Response(0);
    }else{
        return new Response(1);
    }
}

}