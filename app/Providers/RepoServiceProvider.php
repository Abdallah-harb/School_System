<?php

namespace App\Providers;

use App\Repository\StudentPattern\StudentPromotionInterface;
use App\Repository\StudentPattern\StudentPromotionRepository;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\StudentPattern\StudentInterface;
use App\Repository\StudentPattern\studentRepository;
use App\Repository\StudentPattern\Graduation\StudentGraduationInterface;
use App\Repository\StudentPattern\Graduation\StudentGraduationRepository;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentInterface::class, studentRepository::class);
        $this->app->bind(StudentPromotionInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduationInterface::class, StudentGraduationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
