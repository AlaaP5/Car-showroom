<?php

namespace App\Services;

use App\Interfaces\EvaluationRepositoryInterface;

class EvaluationService
{

    protected $evaluationRepository;

    public function __construct(EvaluationRepositoryInterface $evaluationRepository) {
        $this->evaluationRepository = $evaluationRepository;
    }


    public function store($request)
    {
        return $this->evaluationRepository->store($request);
    }

    public function get($id)
    {
        return $this->evaluationRepository->get($id);
    }

    public function evaluationsOfCar($id)
    {
        return $this->evaluationRepository->evaluationsOfCar($id);
    }

    public function delete($id)
    {
        return $this->evaluationRepository->delete($id);
    }
}
