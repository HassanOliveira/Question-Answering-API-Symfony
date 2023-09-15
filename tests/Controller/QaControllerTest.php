<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\QuestionAnswer;

class QaControllerTest extends WebTestCase
{
    // Test for creating a QA (Question and Answers) record
    public function testCreateQa()
    {
        $client = static::createClient();
        
        $container = $client->getContainer();
        
        // Get the EntityManager to interact with the database
        $entityManager = $container->get(EntityManagerInterface::class);

        // Request data to create a QA record
        $requestData = [
            'title' => 'Test Question',
            'promoted' => true,
            'status' => 'published',
            'answers' => [
                ['channel' => 'faq', 'body' => 'Test FAQ Answer'],
                ['channel' => 'bot', 'body' => 'Test Bot Answer'],
            ],
        ];

        $client->request('POST', '/qa', [], [], [], json_encode($requestData));

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Question and answers saved successfully', $responseData['message']);

        // Retrieve the created Question entity from the database
        $question = $entityManager->getRepository(Question::class)->findOneBy(['title' => 'Test Question']);

        // Assert that the retrieved entity is an instance of Question class
        $this->assertInstanceOf(Question::class, $question);

        // Assert that the Question entity has 2 associated QuestionAnswer entities
        $this->assertCount(2, $question->getQuestionAnswers());
    }

    // Test for creating a QA (Question and Answers) record with invalid data
    public function testCreateQaWithInvalidData()
    {
        $client = static::createClient();

        // Request data with invalid values to create a QA record
        $requestData = [
            'title' => '',
            'promoted' => 'invalid_value',
            'status' => 'invalid_status',
            'answers' => [
                [],
            ],
        ];

        $client->request('POST', '/qa', [], [], [], json_encode($requestData));

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());

        $this->assertJson($response->getContent());

        $responseData = json_decode($response->getContent(), true);

        // Assert that the response data contains a 'message' key with the expected value for invalid data
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Incomplete response data', $responseData['message']);
    }
}
