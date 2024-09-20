<?php

namespace App\Providers;


use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\CarRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CompanyRepositoryInterface;
use App\Interfaces\EvaluationRepositoryInterface;
use App\Interfaces\FavoriteRepositoryInterface;
use App\Interfaces\NoteRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\CarRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\FavoriteRepository;
use App\Repositories\NoteRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PostRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(EvaluationRepositoryInterface::class, EvaluationRepository::class);
        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
