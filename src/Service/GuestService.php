<?php
namespace App\Service;

use App\Entity\GuestBook;
use Doctrine\ORM\EntityManagerInterface;


class GuestService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Update the status of the Guest from pending to Approved (access only to ROLE_ADMIN)
     * @param GuestBook $guestbook
     */
    public function UpdateGuestStatus(GuestBook $guestbook)
    {
        $guestbook->setStatus(GuestBook::APPROVED_STATUS);
        $em= $this->entityManager;
        $em->persist($guestbook);
        $em->flush();
    }
}