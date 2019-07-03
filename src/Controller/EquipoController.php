<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Equipo;
use App\Form\EquipoType;

/**
* @Route("/equipo")
*/
class EquipoController extends AbstractController
{
    /**
     * @Route("/nuevo/{id}", name="nuevoEquipo")
     */
    public function nuevoEquipo(Request $request,$id=null)
    {
        if($id)
        {
          //Buscamos un objeto de tipo equipo
          $repository = $this->getDoctrine()->getRepository(Equipo::class);
          $equipo = $repository->find($id);
          $saveText = "Actualiza";
        }else{
          //Creamos un nuevo objeto de tipo equipo
          $equipo = new Equipo();
          $saveText = "Nuevo";
        }
        //Creamos el nuevo formulario
        $form = $this->createForm(EquipoType::class, $equipo,array('saveText'=>$saveText));

        //Recogemos la información del POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipo);
            $entityManager->flush();
            return $this->redirectToRoute('listaEquipos');
        }
        return $this->render('equipo/nuevoEquipo.html.twig', [
            'form' => $form->createView(),
            'titulo' => 'Nuevo equipo'
        ]);
    }
 
    /**
     * @Route("/lista", name="listaEquipos")
     */
    public function listaEquipos()
    {
        $repository = $this->getDoctrine()->getRepository(Equipo::class);
        $equipos = $repository->findAll();
        return $this->render('equipo/listaEquipos.html.twig', 
        [
            'equipos' => $equipos,
            'titulo' => 'Lista de equipos'
        ]);
    }
    /**
     * @Route("/borrar/{id}", name="borrarEquipo")
     */
    public function borrarEquipo($id=null)
    {
        if($id)
        {
          //Buscamos un objeto de tipo equipo
          $repository = $this->getDoctrine()->getRepository(Equipo::class);
          $equipo = $repository->find($id);
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($equipo);
          $entityManager->flush();
          return $this->redirectToRoute('listaEquipos');
        }else{
          //No se borra nada
          return $this->redirectToRoute('listaEquipos');
        }
    }
}