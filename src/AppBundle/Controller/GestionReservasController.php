<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente;
use AppBundle\Entity\Reserva;
use AppBundle\Form\TapaType;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\IngredienteType;
use AppBundle\Form\ReservaType;

/**
 * @Route("/gestionReservas")
 */
class GestionReservasController extends Controller
{
    /**
     * @Route("/nueva/{id}", name="nuevaReserva")
     */
    public function nuevaReservaAction(Request $request, $id=null)
    // Tambien actualiza la reserva si le pasamos un id (se reutiliza el metodo)
    {
        if($id) {
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id); 
        }else {
            $reserva = new Reserva();
        }
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reserva = $form->getData();
            $usuario = $this->getUser();
            $reserva->setUsuario($usuario);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reserva);
            $entityManager->flush();
    
           return $this->redirectToRoute('reservas');
        }
        return $this->render('gestionTapas/nuevaReserva.html.twig', array('form'=> $form->createView()));
    }

   

    /**
     * @Route("/reservas", name="reservas")
     */
    public function reservasAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Reserva::class);
        $reservas = $repository->findByUsuario($this->getUser()); 
        return $this->render('frontal/reservas.html.twig', array('reservas'=>$reservas));
    }

    /**
     * @Route("/borrar/{id}", name="borrarReserva")
     */
    public function borrarReservaAction(Request $request, $id=null)
    {
        if($id) {
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id); 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reserva);
            $entityManager->flush();
        }
        return $this->redirectToRoute('reservas');
    }
}