<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminController2;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\StudentController;  // Make sure this import is at the top
use App\Http\Controllers\StudentAuthController;

// Guest Routes
Route::get('/', [GuestController::class, 'index'])->name('guest.index');
Route::get('/studentprojects/{id}', [GuestController::class, 'showStudentProject'])->name('guest.studentprojectdetail.show');
Route::get('/guestprojects', [GuestController::class, 'getAllStudentProjects'])->name('guestprojects.index');

Route::get('/guestcourses', [GuestController::class, 'getAllCourses'])->name('guestcourses.index');
Route::get('/guestcourses/search', [GuestController::class, 'searchCourses'])->name('guestcourses.search');
Route::get('/guestcourses/{id}', [GuestController::class, 'getCourseDetail'])->name('guestcoursedetail.show');

Route::get('/gueststudentprojects/{id}', [GuestController::class, 'showAllStudentProjectCourse'])->name('gueststudentprojects.show');
Route::get('/guestlecturers', [GuestController::class, 'getAllLecturers'])->name('guestlecturers.index');
Route::get('/guestlecturers/{id}', [GuestController::class, 'getLecturerDetails'])->name('guestlecturerdetail.show');
Route::get('/gueststudents', [GuestController::class, 'getStudents'])->name('gueststudents.index');
Route::get('/gueststudents/{id}', [GuestController::class, 'showStudentDetails'])->name('gueststudentdetails.show');
Route::get('/search', [GuestController::class, 'search'])->name('guest.search');
Route::get('/filter', [GuestController::class, 'filter'])->name('guest.filter');
Route::get('/guestprojects/search', [GuestController::class, 'search2'])->name('guestprojects.search');
Route::get('/filter-options', [GuestController::class, 'getFilterOptions'])->name('guest.filter.options');



// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login'); 
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');// Admin login route\
//Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login'); // Admin login route
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit'); // Admin login submit route
Route::get('/student/register', [StudentAuthController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentAuthController::class, 'register'])->name('student.register.submit');
// You need to add this route to define the 'login' route name that Laravel is looking for
// Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

// Admin Registration Routes
Route::get('/admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register'); // Admin registration route
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit'); // Admin registration submit route

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Admin Protected Routes
Route::middleware(['auth:admin'])->group(function () {    
    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/students', [AdminController::class, 'showStudentsLog'])->name('admin.students.log'); // Students Log
    Route::get('/admin/student/create', [AdminController::class, 'createStudent'])->name('admin.student.create');
    Route::post('/admin/student/store', [AdminController::class, 'storeStudent'])->name('admin.student.store');
    Route::get('/admin/student/{student}', [AdminController::class, 'showStudentDetails'])->name('admin.student.details'); // Student Details

    Route::get('/admin/studentproject/{id}/edit', [AdminController::class, 'editStudentProject'])->name('admin.studentproject.edit');
    Route::put('/admin/studentproject/{id}', [AdminController::class, 'updateStudentProject'])->name('admin.studentproject.update');
    Route::delete('/admin/studentproject/{id}', [AdminController::class, 'destroyStudentProject'])->name('admin.studentproject.destroy');
    Route::get('/admin/student/{student}/edit', [AdminController::class, 'editStudent'])->name('admin.student.edit');
    Route::put('/admin/student/{student}', [AdminController::class, 'updateStudent'])->name('admin.student.update');
    Route::delete('/admin/student/{student}', [AdminController::class, 'destroyStudent'])->name('admin.student.destroy');

    // Admin Lecturers Log
    Route::get('/admin/lecturers', [AdminController::class, 'showLecturersLog'])->name('admin.lecturer.log');
    Route::get('/admin/lecturer/create', [AdminController::class, 'createLecturer'])->name('admin.lecturer.create');
    Route::post('/admin/lecturer/store', [AdminController::class, 'storeLecturer'])->name('admin.lecturer.store');
    Route::get('/admin/lecturer/{lecturer}/matakuliah/create', [AdminController::class, 'createMatakuliah'])->name('admin.matakuliah.create');
    Route::post('/admin/matakuliah/store', [AdminController::class, 'storeMatakuliah'])->name('admin.matakuliah.store');

    Route::get('/admin/lecturer/{lecturer}', [AdminController::class, 'showLecturerDetails'])->name('admin.lecturer.details');
    Route::get('/admin/lecturer/{lecturer}/edit', [AdminController::class, 'editLecturer'])->name('admin.lecturer.edit');
    Route::put('/admin/lecturer/{lecturer}', [AdminController::class, 'updateLecturer'])->name('admin.lecturer.update');  
    Route::delete('/admin/lecturer/{lecturer}', [AdminController::class, 'destroyLecturer'])->name('admin.lecturer.destroy');

    Route::get('/admin/coursedetail/{id}', [AdminController::class, 'showCourseDetail'])->name('admin.coursedetail');

    Route::get('/admin/studentprojectdetails/{id}', [AdminController::class, 'showStudentProjectDetails'])->name('admin.studentprojectdetails');
    Route::get('/admin/project/{id}', [AdminController::class, 'showProjectDetails'])->name('admin.project.details');
    Route::get('/admin/project/{id}/edit', [AdminController::class, 'editProject'])->name('admin.project.edit');
    Route::put('/admin/project/{id}', [AdminController::class, 'updateProject'])->name('admin.project.update');
    Route::delete('/admin/project/{id}', [AdminController::class, 'destroyProject'])->name('admin.project.destroy');

    Route::get('/admin/studentproject/create/{project_id}', [AdminController::class, 'createStudentProject'])->name('admin.studentproject.create');
    Route::post('/admin/studentproject/store', [AdminController::class, 'storeStudentProject'])->name('admin.studentproject.store');
    
    // Route::get('/admin/course/create', [AdminController::class, 'createCourseAdmin'])->name('admin.course.create.placeholder');
    Route::post('/admin/course/store', [AdminController::class, 'storeCourseWithLecturer'])->name('admin.course.store.dynamic');
    Route::get('/admin/course/{id}/edit', [AdminController::class, 'editCourse'])->name('admin.course.edit');
    Route::put('/admin/course/{id}', [AdminController::class, 'updateCourse'])->name('admin.course.update');
    Route::delete('/admin/course/{id}', [AdminController::class, 'destroyCourse'])->name('admin.course.destroy');

    Route::get('/admin/project/create/{courseId}', [AdminController::class, 'createProject'])->name('admin.project.create');
    Route::post('/admin/project/store', [AdminController::class, 'storeProject'])->name('admin.project.store');

    Route::get('/admin/lecturer/{lecturerId}/course/create', [AdminController::class, 'createCourse'])->name('admin.course.create');
    Route::post('/admin/lecturer/course/store', [AdminController::class, 'storeCourse'])->name('admin.course.store');
    
    // AdminController2 routes
    Route::get('/admin/course/create2', [AdminController2::class, 'createCourseAdmin2'])->name('admin.course.create2');
    Route::post('/admin/course/store2', [AdminController2::class, 'storeLecturermkWithLecturer2'])->name('admin.course.store2');

    Route::get('/admin/matakuliah/create2', [AdminController2::class, 'createMatakuliah2'])->name('admin.matakuliah.create2');
    Route::post('/admin/matakuliah/store2', [AdminController2::class, 'storeMatakuliah2'])->name('admin.matakuliah.store2');

    // Routes for Adding Student Project with LecturerMK Selection
    Route::get('/admin/studentproject2/create', [AdminController2::class, 'createStudentProjectWithLecturerMK'])->name('admin.studentproject.create2');
    Route::post('/admin/studentproject2/store', [AdminController2::class, 'storeStudentProjectWithLecturerMK'])->name('admin.studentproject.store2');
    Route::get('/api/projects/{lmk_id}', [AdminController2::class, 'getProjectsByLecturerMK']);
});

Route::middleware('auth:student')->group(function () {
    Route::get('/studentplaceholder', function () {
        return view('student.placeholder');
    })->name('studentplaceholder');
    Route::get('/student/account', [StudentController::class, 'showAccount'])->name('student.account');
    Route::get('/student/accountedit', [StudentController::class, 'editAccount'])->name('student.edit.account');
    Route::put('/student/accountedit/update', [StudentController::class, 'updateAccount'])->name('student.update.account');

    Route::get('/student/project/create/{project_id}', [StudentController::class, 'createStudentProject'])
    ->name('student.project.create');
    Route::post('/student/project/store', [StudentController::class, 'storeStudentProject'])
        ->name('student.project.store');
        Route::get('/student/studentproject/{id}/edit', [StudentController::class, 'editStudentProject'])->name('student.studentproject.edit');
        Route::put('/student/studentproject/{id}', [StudentController::class, 'updateStudentProject'])->name('student.studentproject.update');
        Route::delete('/student/studentproject/{id}', [StudentController::class, 'destroyStudentProject'])->name('student.studentproject.destroy');
        Route::get('/student/your-projects', [StudentController::class, 'yourProjects'])->name('student.your.projects');       
});