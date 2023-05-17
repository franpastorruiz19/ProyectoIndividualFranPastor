<?php

namespace App\Controller;

use App\Entity\Beers;
use App\Entity\Breweries;
use App\Entity\Cliente;
use App\Entity\Empresa;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $repository;
    
    //Renderiza la pantalla de beers pasandole el id mediante la propia ruta para asi recoger toda la informacion que necesitamos
    //mediante findBy, recogiendo todas las cervezas asociadas a esa cerveceria(id).
    #[Route('/user/{nombre}/{contrasena}', name: 'app_user_pass')]
    public function getUserByNameAndPassword(EntityManagerInterface $em, string $nombre, string $contrasena): Response
{
    $usuario = $em->getRepository(User::class)->findOneBy([
        'nombre' => $nombre,
        'contrasena' => $contrasena,
    ]);

    // Si no se encontró el usuario, devuelve una respuesta con un mensaje de error
    if (!$usuario) {
        return new Response(0);
    }
    if($usuario->getTipo()=="Cliente"){
        $cliente=$em->getRepository(Cliente::class)->findOneBy([
            'user' => $usuario->getId(),
        ]);
        
        $c= [
            'idCliente'=>$cliente->getId(),
            'dinero' => $cliente->getDinero(),
            'tipoActividad' => $cliente->getTipoActividad(),
        ];

        $e= [
            'idEmpresa'=>0,
            'dinero' => 0,
            'tipoEmpresa' => "",
        ];

    }else{
        $empresa=$em->getRepository(Empresa::class)->findOneBy([
            'user' => $usuario->getId(),
        ]);
        $c= [
            'idCliente'=>0,
            'dinero' => 0,
            'tipoActividad' => "",
        ];

        $e= [
            'idEmpresa'=>$empresa->getId(),
            'dinero' => $empresa->getDinero(),
            'tipoEmpresa' => $empresa->getTipoEmpresa(),
        ];
    }

    // Si se encontró el usuario, devuelve una respuesta con la información del usuario
    return new JsonResponse([
        'id'=> $usuario->getId(),
        'nombre' => $usuario->getNombre(),
        'tipo' => $usuario->getTipo(),
        'email' => $usuario->getEmail(),
        'cliente' =>$c,
        'empresa'=>$e
        // Agrega cualquier otra propiedad que desees devolver en el JSON
    ]);
}

#[Route('/user/{nombre}', name: 'app_user')]
    public function getUserByName(EntityManagerInterface $em, string $nombre): Response
{
    $usuario = $em->getRepository(User::class)->findOneBy([
        'nombre' => $nombre
    ]);

    // Si no se encontró el usuario, devuelve una respuesta con un mensaje de error
    if (!$usuario) {
        return new Response(0);
    }else{
        return new Response(1);
    }
}
}