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
    public function listarPersonas()
    {
        $personas = $this->repository->findAll();
        // Un intento (fallido) de probar los mensajes para el usuario
        $this->addFlash('success', 'Se ha desplegado la lista de usuarios');

        return $this->render('lista.html.twig', array(
            'personas' => $personas));
    }

    /**
     * @Route ("/admin", name="admin")
     */
    public function adminIndex()
    {
        $usuario = $this->getUser();

        return $this->render('admin/index.html.twig', array(
            'usuario' => $usuario));
    }


}
