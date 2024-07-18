<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteValidate;
use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favorite;
    public function __construct(FavoriteService $favorite) {
        $this->favorite = $favorite;
    }

    public function store(FavoriteValidate $request)
    {
        return $this->favorite->store($request);
    }

    public function favoriteOfCars()
    {
        return $this->favorite->favoriteOfCars();
    }
}
