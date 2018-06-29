<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PersonaRepository;

class PersonaController extends AbstractController
{
    /**
     * @var PersonaRepository
     */
    protected $repository;

    /**
     * @param PersonaRepository $repository
     */
    function __construct(PersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/personas", name="personas")
     */
    public function listar()
    {
        $personas = $this->repository->findAll();
        // Un intento (fallido) de probar los mensajes para el usuario
        $this->addFlash('success', 'Se ha desplegado la lista de usuarios');

        return $this->render('intranet/usuarios.html.twig', array(
            'personas' => $personas));
    }

    /**
     * @Route ("/intranet", name="intranet")
     */
    public function adminIndex()
    {
        $usuario = $this->getUser();

        return $this->render('intranet/inicio.html.twig', array(
            'usuario' => $usuario));
    }


}
