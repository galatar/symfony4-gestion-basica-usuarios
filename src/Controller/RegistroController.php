<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Persona;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistroController extends Controller
{
    /**
     * @Route("/registro", name="registro_usuario")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registrarAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // construye el formulario
        $persona = new Persona();
        $form = $this->createForm(UserType::class, $persona);

        // procesa el envío del formulario (will only happen on POST) ??
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Codifica el password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($persona, $persona->getPlainPassword());
            $persona->setPassword($password);

            // Graba datos por defecto
            $persona->setFechaAlta(new \DateTime());
            $persona->setEsActivo(1);

            // Graba la persona en la base de datos!
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render('registro.html.twig', array('form' => $form->createView()));
    }
}