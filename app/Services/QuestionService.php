<?php
 
namespace App\Services;
use App\Interfaces\QuestionRepositoryInterface;


class QuestionService
{
    public function __construct(private QuestionRepositoryInterface $repo) {}

    public function getQuestions()
    {
        return $this->repo->get_all_questions();
    }

}