<?php


namespace App\Controller;

use App\Entity\Actividad;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ActividadesController extends AbstractController
{
    #[Route('/activities', name: 'app_list_activities')]
    public function list(EntityManagerInterface $em): Response
    {
        $repository = $em->getRepository(Actividad::class);
        $data = $repository->findAll();
    
        // Construir el array de actividades
        $jsonData = [];
        foreach ($data as $actividad) {
            $fechaActividad = $actividad->getFechaActividad() ? $actividad->getFechaActividad()->format('Y-m-d H:i:s') : null;
            $jsonData[] = [
                'id' => $actividad->getId(),
                'tipoActividad' => $actividad->getTipoActividad(),
                'idEmpresa' => $actividad->getIdEmpresa(),
                'precio' => $actividad->getPrecio(),
                'nombre' => $actividad->getNombre(),
                'descripcion' => $actividad->getDescripcion(),
                'participantes' => $actividad->getParticipantes(),
                'fechaActividad' => $fechaActividad,
            ];
        }
    
        // Crear una instancia de Response con el JSON
        $response = new JsonResponse($jsonData);
    
        return $response;
    }
}
