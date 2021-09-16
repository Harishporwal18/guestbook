<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\GuestBook;
use App\Form\GuestType;
use App\Repository\GuestBookRepository;
use App\Service\GuestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/guest", name="guest")
 */
class GuestController extends AbstractController
{

    /**
     * @var GuestService
     */
    private $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * List all the Guest added
     * @Route("/", name="list")
     */
    public function index(GuestBookRepository $bookRepository, Request $request, PaginatorInterface $paginator): Response
    {
        if ($this->getUser()->getRoles()[0] == 'ROLE_USER') {
            $guests = $bookRepository->findGuestBookByUser($this->getUser()->getId());
        } else {
            $guests = $bookRepository->findAll();
        }
        $pagination = $paginator->paginate(
            $guests, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('guest/index.html.twig', [
            'guestlist' => $guests,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Createing a new Guest entry
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $guest = new GuestBook();
        $form = $this->createForm(GuestType::class, $guest);
        $form->handleRequest($request);
        $form->getErrors();
        if ($form->isSubmitted() && $form->isValid()) {
            $guest->setStatus(GuestBook::PENDING_STATUS);
            $guest->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            $this->addFlash('success', 'Entry Created');
            return $this->redirect($this->generateUrl('guestlist'));
        }


        return $this->render('guest/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Updating the Guest status from Pending to Approved (access only to ROLE_ADMIN)
     * @Route("/updatestatus/{id}", name="updatestatus")
     */
    public function UpdateStatus(GuestBook $guestbook)
    {
        $this->guestService->UpdateGuestStatus($guestbook);
        $this->addFlash('success', 'status updated');
        return $this->redirect($this->generateUrl('guestlist'));

    }

    /**
     * Delete the Guest record (access only to ROLE_ADMIN)
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(GuestBook $guestBook)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($guestBook);
        $em->flush();

        $this->addFlash('success', 'record deleted');
        return $this->redirect($this->generateUrl('guestlist'));

    }

}
