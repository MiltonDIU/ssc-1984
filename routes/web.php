<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AuditLogsController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SocialsController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictsController;
use App\Http\Controllers\Admin\AddressesController;
use App\Http\Controllers\Admin\EventCategoriesController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\GlobalSearchController;
use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\ProfessionsController;
use App\Http\Controllers\Alumni\DashboardController as AlumniDashboardController;
use App\Http\Controllers\Alumni\FrontendController;


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



Route::get('admin/csv', [\App\Http\Controllers\HomeController::class,'readCsbForm'])->name('admin.csv');
Route::post('admin/csv', [\App\Http\Controllers\HomeController::class,'readCsb'])->name('admin.csv');



Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});




Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resources([
        'socials' => SocialsController::class,
        'divisions' => DivisionController::class,
        'districts' => DistrictsController::class,
        'schools' => SchoolsController::class,
        'addresses' => AddressesController::class,
        'event-categories' => EventCategoriesController::class,
        'events' => EventsController::class,
        'upazilas' => UpazilaController::class,
        'professions' => ProfessionsController::class,
    ]);

    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class,'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class,'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);
    Route::post('users/media', [UsersController::class,'storeMedia'])->name('users.storeMedia');
    Route::post('users/ckmedia', [UsersController::class,'storeCKEditorImages'])->name('users.storeCKEditorImages');

    // Professions
    Route::delete('professions/destroy', [ProfessionsController::class,'massDestroy'])->name('professions.massDestroy');
    Route::post('professions/parse-csv-import', [ProfessionsController::class,'parseCsvImport'])->name('professions.parseCsvImport');
    Route::post('professions/process-csv-import', [ProfessionsController::class,'processCsvImport'])->name('professions.processCsvImport');

    // Division
    Route::delete('divisions/destroy', [DivisionController::class, 'massDestroy'])->name('divisions.massDestroy');
    Route::post('divisions/parse-csv-import', [DivisionController::class, 'parseCsvImport'])->name('divisions.parseCsvImport');
    Route::post('divisions/process-csv-import', [DivisionController::class, 'processCsvImport'])->name('divisions.processCsvImport');

    // Districts
    Route::delete('districts/destroy', [DistrictsController::class, 'massDestroy'])->name('districts.massDestroy');
    Route::post('districts/parse-csv-import', [DistrictsController::class, 'parseCsvImport'])->name('districts.parseCsvImport');
    Route::post('districts/process-csv-import', [DistrictsController::class, 'processCsvImport'])->name('districts.processCsvImport');

    // Upazila
    Route::delete('upazilas/destroy', [UpazilaController::class, 'massDestroy'])->name('upazilas.massDestroy');
    Route::post('upazilas/parse-csv-import', [UpazilaController::class, 'parseCsvImport'])->name('upazilas.parseCsvImport');
    Route::post('upazilas/process-csv-import', [UpazilaController::class, 'processCsvImport'])->name('upazilas.processCsvImport');


    // Schools
    Route::delete('schools/destroy',[SchoolsController::class, 'massDestroy'])->name('schools.massDestroy');
    Route::post('schools/media',[SchoolsController::class, 'storeMedia'])->name('schools.storeMedia');
    Route::post('schools/ckmedia',[SchoolsController::class, 'storeCKEditorImages'])->name('schools.storeCKEditorImages');
    Route::post('schools/parse-csv-import',[SchoolsController::class, 'parseCsvImport'])->name('schools.parseCsvImport');
    Route::post('schools/process-csv-import',[SchoolsController::class, 'processCsvImport'])->name('schools.processCsvImport');


    // Addresses
    Route::delete('addresses/destroy',[AddressesController::class, 'massDestroy'])->name('addresses.massDestroy');
    Route::post('addresses/media',[AddressesController::class, 'storeMedia'])->name('addresses.storeMedia');
    Route::post('addresses/ckmedia',[AddressesController::class, 'storeCKEditorImages'])->name('addresses.storeCKEditorImages');

    // Event Categories
    Route::delete('event-categories/destroy',[EventCategoriesController::class, 'massDestroy'])->name('event-categories.massDestroy');
    Route::post('event-categories/parse-csv-import',[EventCategoriesController::class, 'parseCsvImport'])->name('event-categories.parseCsvImport');
    Route::post('event-categories/process-csv-import',[EventCategoriesController::class, 'processCsvImport'])->name('event-categories.processCsvImport');


    // Events
    Route::delete('events/destroy',[EventsController::class, 'massDestroy'])->name('events.massDestroy');
    Route::post('events/media', [EventsController::class, 'storeMedia'])->name('events.storeMedia');
    Route::post('events/ckmedia',[EventsController::class, 'storeCKEditorImages'])->name('events.storeCKEditorImages');


    // Global Search

    Route::get('global-search',[GlobalSearchController::class, 'search'])->name('globalSearch');


    ///Ajax request method

    Route::get('district/get_by_division', [DistrictsController::class,'get_by_division'])->name('district.get_by_division');
    Route::get('upazila/get_by_district', [UpazilaController::class,'get_by_district'])->name('upazila.get_by_district');

    // Audit Logs
    Route::resource('audit-logs', AuditLogsController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    //    Route::resources(['permissions' => SettingsController::class],['except' => ['create', 'store', 'show', 'destroy']]);
    Route::post('settings/media', [SettingsController::class, 'storeMedia'])->name('settings.storeMedia');
    Route::post('settings/ckmedia', [SettingsController::class, 'storeCKEditorImages'])->name('settings.storeCKEditorImages');
    Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');





});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class,'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class,'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class,'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class,'destroy'])->name('password.destroyProfile');
        Route::get('/edit',[ProfileController::class,'edit'])->name('edit');
        Route::post('/edit',[ProfileController::class,'updateProfile'])->name('updateProfile');
    }

});



Route::group(['prefix' => 'alumni', 'as' => 'alumni.'], function () {
    Route::get('/', [AlumniDashboardController::class, 'index'])->name('dashboard');
    Route::get('/batch-mate', [AlumniDashboardController::class, 'batchMate'])->name('batch-mate');
    Route::get('/batch-mate/{profile}', [AlumniDashboardController::class, 'batchMateProfile'])->name('batch-mate.profile');
    Route::get('/schools', [AlumniDashboardController::class, 'schools'])->name('schools');
    Route::get('/school/{name}', [AlumniDashboardController::class, 'schoolProfile'])->name('schoolProfile');
    Route::get('/events', [AlumniDashboardController::class, 'events'])->name('events');
    Route::get('/school/{name}', [AlumniDashboardController::class, 'schoolProfile'])->name('schoolProfile');

    Route::get('/register', [FrontendController::class, 'register'])->name('register');
    Route::get('/otp', [FrontendController::class, 'otp'])->name('otp');
    Route::get('/otp-phone-signup', [FrontendController::class, 'otpVerify'])->name('otp-phone-signup');
    Route::get('/registration-step1', [FrontendController::class, 'registration1'])->name('registration1');
    Route::get('/registration-step2', [FrontendController::class, 'registration2'])->name('reg.step2');
    Route::get('/profile', [FrontendController::class, 'profile'])->name('profile');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
