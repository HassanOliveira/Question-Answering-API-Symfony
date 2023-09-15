<?php

namespace App\Tests\Entity;

use App\Entity\Answer;
use PHPUnit\Framework\TestCase;

class AnswerTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $answer = new Answer();

        $answer->setChannel('Test Channel');
        $this->assertEquals('Test Channel', $answer->getChannel());

        $answer->setBody('Test Body');
        $this->assertEquals('Test Body', $answer->getBody());
    }

    public function testIdIsNullOnNewInstance()
    {
        $answer = new Answer();

        $this->assertNull($answer->getId());
    }
}
