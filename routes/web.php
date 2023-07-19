<?php

use App\Models\Blood;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        Route::group(['prefix' => 'admin'], function () {

            Route::get('/', function () {
                return view('empty');
            })->name('admin');

            // route for grades
            Route::resource('grades', 'backend\GradeController');


            // route for classrooms
            Route::resource('classrooms', 'backend\ClassController');
            Route::post('classrooms/delete_all', 'backend\ClassController@delete_all')->name('delete_all');
            Route::post('classrooms/Filter_Classes', 'backend\ClassController@Filter_Classes')->name('Filter_Classes');

            // route for sections
            Route::resource('sections', 'backend\SectionController');

            // route for get_classes
            Route::get('/classes/{id}', 'backend\SectionController@get_classes')->name('classes');

            // route for add_parent livewire wisard
            Route::view('/parent/show_form', 'livewire.show_form')->name('show_form');

            // route resource for Teachers
            Route::resource('teachers', 'backend\TeacherController');

            // route resource for Students
            Route::resource('students', 'backend\StudentController');

            Route::get('/location', function () {
                //$geoinfo = geoip('232.223.11.11')->country;

                $geoinfo = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
                dd($geoinfo);
            });



            // Routes for seed blood and nationaalities and religions
            /*Route::get('/seed/grades', 'backend\SedderController@grades')->name('grades');
            Route::get('/seed/blood_seed', 'backend\SedderController@blood')->name('blood');
            Route::get('/seed/nationalite_seed', 'backend\SedderController@nationalite')->name('nationalite');
            Route::get('/seed/religions', 'backend\SedderController@religions')->name('religions');
            Route::get('/seed/genders', 'backend\SedderController@genders')->name('genders');
            Route::get('/seed/specialisations', 'backend\SedderController@specialisations')->name('specialisations'); */

            // test route for empty template
            Route::get('/empty', function () {
                return view('empty');
            });
        });
    }
);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
