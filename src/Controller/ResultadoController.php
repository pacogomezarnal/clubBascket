<?php

namespace App\Controller;

use App\Entity\Resultado;
use App\Form\ResultadoType;
use App\Repository\ResultadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resultado")
 */
class ResultadoController extends AbstractController
{
    /**
     * @Route("/", name="resultado_index", methods={"GET"})
     */
    public function index(ResultadoRepository $resultadoRepository): Response
    {
        return $this->render('resultado/index.html.twig', [
            'resultados' => $resultadoRepository->findAll(),
            'titulo' => 'Resultados'
        ]);
    }

    /**
     * @Route("/new", name="resultado_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resultado = new Resultado();
        $form = $this->createForm(ResultadoType::class, $resultado);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resultado);
            $entityManager->flush();

            return $this->redirectToRoute('resultado_index');
        }

        return $this->render('resultado/new.html.twig', [
            'resultado' => $resultado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resultado_show", methods={"GET"})
     */
    public function show(Resultado $resultado): Response
    {
        return $this->render('resultado/show.html.twig', [
            'resultado' => $resultado,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resultado_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resultado $resultado): Response
    {
        $form = $this->createForm(ResultadoType::class, $resultado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resultado_index', [
                'id' => $resultado->getId(),
            ]);
        }

        return $this->render('resultado/edit.html.twig', [
            'resultado' => $resultado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resultado_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resultado $resultado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resultado->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resultado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('resultado_index');
    }
}
