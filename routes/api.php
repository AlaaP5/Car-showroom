<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('Register', [AuthController::class, 'Register']);
Route::post('Login', [AuthController::class, 'Login']);

Route::middleware('auth:api')->group(function () {

    Route::prefix('category')->group(function () {
        Route::get('all', [CategoryController::class, 'fetchAll']);
        Route::get('get/{id}', [CategoryController::class, 'fetch']);
        Route::get('search/{name?}', [CategoryController::class, 'search']);
        Route::get('cars/{id}', [CategoryController::class, 'CarsOfCategory']);
    });

    Route::prefix('company')->group(function () {
        Route::get('all', [CompanyController::class, 'fetchAll']);
        Route::get('get/{id}', [CompanyController::class, 'fetch']);
        Route::get('search/{name?}', [CompanyController::class, 'search']);
        Route::get('cars/{id}', [CompanyController::class, 'CarsOfCompany']);
    });

    Route::prefix('car')->group(function () {
        Route::get('all', [CarController::class, 'fetchAll']);
        Route::get('get/{id}', [CarController::class, 'fetch']);
        Route::get('search/{name?}', [CarController::class, 'search']);
    });

    Route::prefix('post')->group(function () {
        Route::get('all', [PostController::class, 'fetchAll']);
        Route::get('get/{id}', [PostController::class, 'fetch']);
        Route::get('search/{name?}', [PostController::class, 'search']);
    });

    Route::get('comment/comments/{id}', [CommentController::class, 'CommentsOfPost']);

    Route::get('evaluation/evaluations/{id}', [EvaluationController::class, 'evaluationsOfCar']);

    Route::get('logout', [AuthController::class, 'Logout']);

    Route::middleware('check_Admin')->group(function () {

        Route::prefix('category')->group(function () {
            Route::post('add', [CategoryController::class, 'store']);
            Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory']);
        });

        Route::prefix('company')->group(function () {
            Route::post('add', [CompanyController::class, 'store']);
            Route::delete('delete/{id}', [CompanyController::class, 'deleteCompany']);
        });

        Route::prefix('car')->group(function () {
            Route::post('add', [CarController::class, 'store']);
            Route::post('update/{id}', [CarController::class, 'updateCar']);
            Route::delete('delete/{id}', [CarController::class, 'deleteCar']);
        });

        Route::prefix('post')->group(function () {
            Route::post('add', [PostController::class, 'store']);
            Route::post('update/{id}', [PostController::class, 'updatePost']);
            Route::delete('delete/{id}', [PostController::class, 'deletePost']);
        });

        Route::post('wallet/store',[AuthController::class,'storeMoney']);

    });

    Route::post('code', [AuthController::class, 'Verification']);

    Route::middleware('check_User')->group(function () {

        Route::prefix('comment')->group(function () {
            Route::post('add', [CommentController::class, 'store']);
            Route::get('get/{id}', [CommentController::class, 'fetch']);
            Route::post('update/{id}', [CommentController::class, 'updateComment']);
            Route::delete('delete/{id}', [CommentController::class, 'deleteComment']);
        });

        Route::prefix('note')->group(function () {
            Route::post('add', [NoteController::class, 'store']);
            Route::get('all', [NoteController::class, 'fetchAll']);
            Route::get('get/{id}', [NoteController::class, 'fetch']);
            Route::post('update/{id}', [NoteController::class, 'updateNote']);
            Route::delete('delete/{id}', [NoteController::class, 'deleteNote']);
        });

        Route::prefix('evaluation')->group(function () {
            Route::post('add', [EvaluationController::class, 'store']);
            Route::get('get/{id}', [EvaluationController::class, 'fetch']);
            Route::delete('delete/{id}', [EvaluationController::class, 'deleteEvaluation']);
        });

        Route::prefix('favorite')->group(function () {
            Route::post('add', [FavoriteController::class, 'store']);
            Route::get('cars',[FavoriteController::class, 'favoriteOfCars']);
        });

    });

});
