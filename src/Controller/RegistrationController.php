<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * Registering a new user to add Guest
     * @Route("/registration", name="registration")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $em= $this->getDoctrine()->getManager();
            $existinguser = $em->getRepository(User::class)->findOneByEmail($user->getEmail());
            if(!$existinguser)
            {
                $user->setPassword($passwordEncoder->encodePassword($user,$user->getPassword()));
                $user->setRoles(array ('ROLE_USER'));
                $em->persist($user);
                $em->flush();
                $this->addFlash('success',$user->getEmail().' New user Created');
            }
            else{
                $this->addFlash('success',$user->getEmail().' user already exist');
            }


        }
        return $this->render('registration/index.html.twig', [
             'form' =>$form->createView()
        ]);
    }
}
