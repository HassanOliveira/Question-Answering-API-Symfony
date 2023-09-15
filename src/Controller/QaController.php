<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Question;
use App\Entity\QuestionAnswer;
use App\Entity\Answer;

class QaController extends AbstractController
{
    /**
     * @Route("/qa", name="qa_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $requestData = json_decode($request->getContent(), true);

        // Validate the data received
        if (
            !isset($requestData['title']) ||
            !isset($requestData['promoted']) ||
            !isset($requestData['status']) ||
            !isset($requestData['answers'])
        ) {
            return new JsonResponse(['message' => 'Dados incompletos'], 400);
        }

        // Create a new Question instance and configure it with the data received
        $question = new Question();
        $question->setTitle($requestData['title']);
        $question->setPromoted($requestData['promoted']);
        $question->setStatus($requestData['status']);

        // Validate and save answers
        foreach ($requestData['answers'] as $answerData) {
            if (!isset($answerData['channel']) || !isset($answerData['body'])) {
                return new JsonResponse(['message' => 'Incomplete response data'], 400);
            }
        
            $answer = new Answer();
            $answer->setChannel($answerData['channel']);
            $answer->setBody($answerData['body']);
        
            // Associate the answer to the question using the QuestionAnswer class
            $questionAnswer = new QuestionAnswer();
            $questionAnswer->setQuestion($question);
            $questionAnswer->setAnswer($answer);
        
            // Add the QuestionAnswer object to the questionAnswers collection
            $question->addQuestionAnswer($questionAnswer);
        }

        // Define createdAt and updatedAt
        $now = new \DateTime();
        $createdAt = \DateTimeImmutable::createFromMutable($now);
        $question->setCreatedAt($createdAt);
        $question->setUpdatedAt($createdAt);

        // Persist the data in the database
        $entityManager->persist($question);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Question and answers saved successfully'], 201);
    }
}
