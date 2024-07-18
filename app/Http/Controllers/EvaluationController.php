<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluationValidate;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $Evaluation;
    public function __construct(EvaluationService $evaluation)
    {
        $this->Evaluation = $evaluation;
    }

    public function store(EvaluationValidate $request)
    {
        return $this->Evaluation->store($request);
    }

    public function evaluationsOfCar($id)
    {
        return  $this->Evaluation->EvaluationsOfCar($id);
    }

    public function deleteEvaluation($id)
    {
        return $this->Evaluation->delete($id);
    }

}
