<?php
/**
 * Created by PhpStorm.
 * User: HARISH
 * Date: 8/28/2021
 * Time: 12:29 PM
 */

namespace App\Tests;

use App\Form\GuestType;
use App\Entity\GuestBook;
use PHPUnit\TextUI\XmlConfiguration\PHPUnit;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Test\TypeTestCase;

class GuestTypeTest extends PHPUnit
{
    public function testSubmitValidData()
    {
        $formData = array(
            'id'   => '1',
            'name' => 'Harish',
            'status' => 'pending'
        );


        $model = new GuestBook();
        // $formData will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(GuestType::class, $model);

        $expected = new GuestBook();
        $expected->fromArray($formData);
        // ...populate $object properties with the data stored in $formData

        // submit the data to the form directly
        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // check that $formData was modified as expected when the form was submitted
        $this->assertEquals($expected, $model);
        // ...
    }
}