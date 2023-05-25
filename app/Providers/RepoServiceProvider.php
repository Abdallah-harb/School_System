<?php

namespace App\Providers;

use App\Repository\Attendance\AttendanceInterface;
use App\Repository\Attendance\AttendanceRepository;
use App\Repository\Quizes\QuizInterface;
use App\Repository\Quizes\QuizRepository;
use App\Repository\Fees\FeesInterface;
use App\Repository\Fees\FeesInvoiceInterface;
use App\Repository\Fees\FeesInvoiceRepository;
use App\Repository\Fees\FeesRepository;
use App\Repository\Fees\Payment\PaymentStudentInterface;
use App\Repository\Fees\Payment\PaymentStudentRepository;
use App\Repository\Fees\Processing\ProcessingFeesInterface;
use App\Repository\Fees\Processing\ProcessingFeesRepository;
use App\Repository\Fees\Receipt\ReceiptStudentInterface;
use App\Repository\Fees\Receipt\ReceiptStudentRepository;
use App\Repository\StudentPattern\StudentPromotionInterface;
use App\Repository\StudentPattern\StudentPromotionRepository;
use App\Repository\Subjects\SubjectInterface;
use App\Repository\Subjects\SubjectRepository;
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
        $this->app->bind(FeesInterface::class, FeesRepository::class);
        $this->app->bind(FeesInvoiceInterface::class, FeesInvoiceRepository::class);
        $this->app->bind(ReceiptStudentInterface::class, ReceiptStudentRepository::class);
        $this->app->bind(ProcessingFeesInterface::class, ProcessingFeesRepository::class);
        $this->app->bind(PaymentStudentInterface::class, PaymentStudentRepository::class);
        $this->app->bind(AttendanceInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectInterface::class, SubjectRepository::class);
        $this->app->bind(QuizInterface::class, QuizRepository::class);
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
