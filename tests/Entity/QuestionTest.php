<?php

namespace App\Tests\Entity;

use App\Entity\Question;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class QuestionTest extends TestCase
{
    public function testSetTitle()
    {
        $question = new Question();
        $question->setTitle('Test Question');

        $this->assertEquals('Test Question', $question->getTitle());
    }

    public function testSetPromoted()
    {
        $question = new Question();
        $question->setPromoted(true);

        $this->assertTrue($question->isPromoted());
    }

    public function testSetStatus()
    {
        $question = new Question();
        $question->setStatus('published');

        $this->assertEquals('published', $question->getStatus());
    }

    public function testCreatedAt()
    {
        $question = new Question();

        // Get the creation date formatted with year, month, day, hour and minute
        $createdAt = $question->getCreatedAt()->format('Y-m-d H:i');

        // Get the current date formatted with year, month, day, hour and minute
        $currentDateTime = new \DateTimeImmutable();
        $currentDateTimeFormatted = $currentDateTime->format('Y-m-d H:i');

        // Check that the creation date is the same as the current date
        $this->assertEquals($currentDateTimeFormatted, $createdAt);
    }

    public function testUpdatedAt()
    {
        $question = new Question();

        $createdAt = $question->getCreatedAt();

        $question->setTitle('Updated Title');

        // Pause for a moment to ensure the updated timestamp is different
        sleep(1);

        // Get the formatted update date after the update
        $updatedAtAfterUpdate = $question->getUpdatedAt();

        // Check that the update date of the updated entity is after the creation date
        $this->assertTrue($updatedAtAfterUpdate > $createdAt);
    }
}