<?php

namespace App\Controller;

use App\Entity\GuestBook;
use App\Form\GuestType;
use App\Repository\GuestBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/guest", name="guest")
 */
class GuestController extends AbstractController
{
    /**
     * @Route("/", name="guest")
     */
    public function index(GuestBookRepository $bookRepository): Response
    {

        $guests = $bookRepository->findAll();
        //dump($guests);
        return $this->render('guest/index.html.twig', [
           'guestlist'=> $guests
        ]);
    }
    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, GuestBook $guest){

        dump($guest);
        $guest = new GuestBook();
        $form = $this->createForm(GuestType::class,$guest);

        $form->handleRequest($request);
        $form->getErrors();
        if($form->isSubmitted() && $form->isValid()){
            $guest->setStatus('pending');
            $em= $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            $this->addFlash('success','Entry Created');
            return $this->redirect($this->generateUrl('guestcreate'));
        }


       return $this->render('guest/create.html.twig',[
           'form' => $form->createView()
       ]);
    }

    /**
     * @Route("/updatestatus/{id}", name="updatestatus")
     */
    public function UpdateStatus(GuestBook $guest)
    {
        $guest->setStatus('approved');
        $em= $this->getDoctrine()->getManager();
        $em->persist($guest);
        $em->flush();

        $this->addFlash('success','status updated');
        return $this->redirect($this->generateUrl('guestguest'));

    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(GuestBook $guest)
    {
        $guest->setStatus('approved');
        $em= $this->getDoctrine()->getManager();
        $em->remove($guest);
        $em->flush();

        $this->addFlash('success','record deleted');
        return $this->redirect($this->generateUrl('guestguest'));

    }

}
