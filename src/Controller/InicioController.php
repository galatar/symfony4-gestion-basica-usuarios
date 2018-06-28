<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function inicio()
    {
        return $this->render('inicio.html.twig');
    }
}