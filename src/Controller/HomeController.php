<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\Usuario;
use App\Entity\Resultado;
use App\Form\UsuarioType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {
        $repository = $this->getDoctrine()->getRepository(Resultado::class);
        $resultados = $repository->findlastNineResults();
        return $this->render('home/home.html.twig',
        ['resultados'=>$resultados,'titulo'=>'Ultimos resultados']);
    }
    /**
     * @Route("/club", name="club")
     */
    public function club()
    {
        return $this->render('home/home.html.twig');
    }
    /**
     * @Route("/detalle/{id}", name="detalle")
     */
    public function detalle($id=null)
    {
        //dump($id,$this);
        if($id==null){
            throw $this->createNotFoundException("Resultado no encontrado");
        }
        return $this->render('home/detalle.html.twig',['id'=>$id]);
    }
    //Ruta de prueba con Response
    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
        return new Response("Esta es una ruta de prueba");
    }
    /**
     * @Route("/registro/", name="registro")
     */
    public function registro(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuario = new Usuario();
        //Construyendo el formulario
        $form = $this->createForm(UsuarioType::class,$usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
          $usuario->setPassword($password);

          // 3c) $roles
          $usuario->setRoles(array('ROLE_USER'));

          // 4) save the User!
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($usuario);
          $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        // replace this example code with whatever you need
        return $this->render('home/registro.html.twig',array('form'=>$form->createView(),'titulo'=>'Nuevo usuario'));
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
}