<?php

namespace App\Tests\Service;

use App\Entity\GuestBook;
use App\Service\GuestService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;


class GuestServiceTest extends TestCase
{

    /**
     * Test status change for Guest record
     * return void()
     */
    public function testUpdateGuestStatus(): void
    {
        $guestbook = new GuestBook();
        $guestbook->setStatus(GuestBook::PENDING_STATUS);
        $guestService = new GuestService($this->createEntityManagerMock());
        $guestService->UpdateGuestStatus($guestbook);

        $this->assertEquals(GuestBook::APPROVED_STATUS, $guestbook->getStatus());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function createEntityManagerMock()
    {
        return $this->createMock(EntityManagerInterface::class);
    }
}
