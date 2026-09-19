<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookMyStallController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ExhibitorServicesController;
use App\Http\Controllers\SMSDataController;
use App\Http\Controllers\FurnitureMasterController;
use App\Http\Controllers\ExhibitorLoginController;
use App\Http\Controllers\ExhibitorUploadSMSController;
use App\Http\Controllers\UserVisitorRegistrationController;
use App\Http\Controllers\UserExhibitorServicesController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SponsoredRegistrationController;
use App\Http\Controllers\BecomeAnExhibitorController;
use App\Http\Controllers\CityTourController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSVUploadController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\OurSponsorsController;
use App\Http\Controllers\FloorPlanController;
use App\Http\Controllers\EmployeesMasterController;
use App\Http\Controllers\EmployeesVisitorRegistrationController;
use App\Http\Controllers\VisitorPosterController;

use App\Http\Controllers\BlogController;

Route::get('/visitor-poster', [VisitorPosterController::class, 'index'])
    ->name('visitor-poster.index');
Route::post('/visitor-poster', [VisitorPosterController::class, 'generate'])
    ->middleware('throttle:10,1')
    ->name('visitor-poster.generate');
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

Route::get('/book-my-stall', [FrontController::class, 'book_my_stall'])->name('FrontBook_My_Stall');
Route::post('/book_my_stall_store', [FrontController::class, 'book_my_stall_store'])->name('book_my_stall_store');
Route::get('/book-my-stall/Thank-you', [FrontController::class, 'book_my_stall_thank_you'])->name('book_my_stall_thank_you');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:forget spatie.permission.cache'); // Add this line
    //Artisan::call('storage:link');
    return 'Cache is cleared';
});

Route::get('/admin', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::get('/edit', [HomeController::class, 'EditProfile'])->name('EditProfile');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('admin')->name('users.')->group(function () {
    Route::any('/users/index', [UserController::class, 'index'])->name('index');
    Route::get('/users/create', [UserController::class, 'create'])->name('create');
    Route::post('/users/store', [UserController::class, 'store'])->name('store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/users/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    Route::post('/users/password-update/{Id?}', [UserController::class, 'passwordupdate'])->name('passwordupdate');

    Route::get('/users/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/users/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('users/export/', [UserController::class, 'export'])->name('export');

    Route::any('/users/mail/{id}', [UserController::class, 'sendmail'])->name('sendmail');

    Route::get('users/mobilecheck/', [UserController::class, 'mobilecheck'])->name('mobilecheck');
    Route::get('users/edit-mobilecheck/', [UserController::class, 'editmobilecheck'])->name('editmobilecheck');
    
     Route::any('/users/excel/{comapny_name?}/{status?}', [UserController::class, 'exportToexcel'])->name('exportToexcel');
});


Route::prefix('admin')->name('blog.')->middleware('auth')->group(function () {
    Route::any('/blog/index', [BlogController::class, 'index'])->name('index');
    Route::get('/blog/create', [BlogController::class, 'createview'])->name('create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('store');
    Route::get('/blog/edit/{id?}', [BlogController::class, 'editview'])->name('edit');
    Route::post('/blog/update/{id?}', [BlogController::class, 'update'])->name('update');
    Route::delete('/blog/delete', [BlogController::class, 'delete'])->name('delete');
});



//Book My Stall(Brochure)
Route::prefix('admin')->name('brochure.')->middleware('auth')->group(function () {
    Route::any('/brochure/index', [BookMyStallController::class, 'index'])->name('index');
    Route::get('/brochure/create', [BookMyStallController::class, 'createview'])->name('create');
    Route::post('/brochure/store', [BookMyStallController::class, 'create'])->name('store');
    Route::get('/brochure/edit/{Id?}', [BookMyStallController::class, 'editview'])->name('edit');
    Route::post('/brochure/update/{Id?}', [BookMyStallController::class, 'update'])->name('update');
    Route::delete('/brochure/delete/{id?}', [BookMyStallController::class, 'delete'])->name('delete');
    Route::DELETE('/brochure/deleteselected', [BookMyStallController::class, 'deleteselected'])->name('deleteselected');
});

//Visitor
Route::prefix('admin')->name('visitor.')->middleware('auth')->group(function () {
    Route::any('/visitor/index', [VisitorController::class, 'index'])->name('index');
    Route::get('/visitor/preview/{id}', [VisitorController::class, 'preview'])
    ->name('preview');
    Route::get('/visitor/create', [VisitorController::class, 'createview'])->name('create');
    Route::post('/visitor/store', [VisitorController::class, 'create'])->name('store');
    Route::get('/visitor/edit/{Id?}', [VisitorController::class, 'editview'])->name('edit');
    Route::post('/visitor/update/{Id?}', [VisitorController::class, 'update'])->name('update');
    Route::delete('/visitor/delete/{Id?}', [VisitorController::class, 'delete'])->name('delete');

    Route::any('/visitor/mail/{id}', [VisitorController::class, 'sendmail'])->name('sendmail');
    
    Route::any('/international-visitor/index', [VisitorController::class, 'internationalvisitor'])->name('international_index');
    
    Route::any('/international-visitor-Excel/{Mobile?}/{EntryDate?}', [VisitorController::class, 'internationalvisitorExcel'])->name('internationalexcel');


    Route::any('/visitor-Excel/{Mobile?}/{EntryDate?}', [VisitorController::class, 'visitorExcel'])->name('excel');
    Route::DELETE('/visitor/deleteselected', [VisitorController::class, 'deleteselected'])->name('deleteselected');
});

//sponsored_regitration
Route::prefix('admin')->name('sponsored_registration.')->middleware('auth')->group(function () {
    Route::any('/Sponsored-Registration/index', [SponsoredRegistrationController::class, 'index'])->name('index');
    Route::delete('/Sponsored-Registration/delete/{Id?}', [SponsoredRegistrationController::class, 'delete'])->name('delete');
    Route::DELETE('/Sponsored-Registration-deleteselected', [SponsoredRegistrationController::class, 'deleteselected'])->name('deleteselected');
});

//Become An Exhibitor
Route::prefix('admin')->name('become_an_exhibitor.')->middleware('auth')->group(function () {
    Route::any('/Become-An-Exhibitor/index', [BecomeAnExhibitorController::class, 'index'])->name('index');
    Route::delete('/Become-An-Exhibitor/delete/{Id?}', [BecomeAnExhibitorController::class, 'delete'])->name('delete');
    Route::DELETE('/Become-An-Exhibitor/deleteselected', [BecomeAnExhibitorController::class, 'deleteselected'])->name('deleteselected');
});

//Furniture Master
Route::prefix('admin')->name('furnituremaster.')->middleware('auth')->group(function () {
    Route::any('/furnituremaster/index', [FurnitureMasterController::class, 'index'])->name('index');
    Route::post('/furnituremaster/store', [FurnitureMasterController::class, 'store'])->name('store');
    Route::get('/furnituremaster/edit/{Id?}', [FurnitureMasterController::class, 'editview'])->name('edit');
    Route::post('/furnituremaster/update/{Id?}', [FurnitureMasterController::class, 'update'])->name('update');
    Route::delete('/furnituremaster/delete', [FurnitureMasterController::class, 'delete'])->name('delete');
    Route::DELETE('/furnituremaster-deleteselected', [FurnitureMasterController::class, 'deleteselected'])->name('deleteselected');
});

//CITY TOUR Master
Route::prefix('admin')->name('citytour.')->middleware('auth')->group(function () {
    Route::any('/citytour/index', [CityTourController::class, 'index'])->name('index');
    Route::any('/citytour/create', [CityTourController::class, 'create'])->name('create');
    Route::post('/citytour/store', [CityTourController::class, 'store'])->name('store');
    Route::get('/citytour/edit/{Id?}', [CityTourController::class, 'editview'])->name('edit');
    Route::post('/citytour/update/{id?}', [CityTourController::class, 'update'])->name('update');
    Route::delete('/citytour/delete', [CityTourController::class, 'delete'])->name('delete');
    Route::DELETE('/citytour-deleteselected', [CityTourController::class, 'deleteselected'])->name('deleteselected');
});

//SMS DAta
Route::prefix('admin')->name('SMSData.')->middleware('auth')->group(function () {
    Route::any('/SMSData/index', [SMSDataController::class, 'index'])->name('index');
    Route::delete('/SMSData/delete/{id?}', [SMSDataController::class, 'delete'])->name('delete');
});

//Media
Route::prefix('admin')->name('media.')->middleware('auth')->group(function () {
    Route::any('/media/index', [MediaController::class, 'index'])->name('index');
    Route::post('/media/store', [MediaController::class, 'store'])->name('store');
    Route::delete('/media/delete/{id?}', [MediaController::class, 'delete'])->name('delete');
    Route::DELETE('/media/deleteselected', [MediaController::class, 'deleteselected'])->name('deleteselected');
});

//Our Sponsors
Route::prefix('admin')->name('our_sponsors.')->middleware('auth')->group(function () {
    Route::any('/Our/Sponsors/index', [OurSponsorsController::class, 'index'])->name('index');
    Route::post('/Our/Sponsors/store', [OurSponsorsController::class, 'store'])->name('store');
    Route::delete('/Our/Sponsors/delete/{id?}', [OurSponsorsController::class, 'delete'])->name('delete');
    Route::DELETE('/Our/Sponsors/deleteselected', [OurSponsorsController::class, 'deleteselected'])->name('deleteselected');
});

//Photo Gallery Master
Route::prefix('admin')->name('photogallery.')->middleware('auth')->group(function () {
    Route::get('/photo/gallery/index', [PhotoGalleryController::class, 'index'])->name('index');
    Route::post('/photo/gallery/store', [PhotoGalleryController::class, 'create'])->name('store');
    Route::delete('/photo/gallery/delete', [PhotoGalleryController::class, 'delete'])->name('delete');
});

//Upload CSV
Route::prefix('admin')->name('csvupload.')->middleware('auth')->group(function () {
    Route::any('/CSV/index', [CSVUploadController::class, 'index'])->name('index');
    Route::post('/CSV/store', [CSVUploadController::class, 'create'])->name('store');
});

//employees 
Route::prefix('admin')->name('employees.')->middleware('auth')->group(function () {
    Route::any('/employees/index', [EmployeesMasterController::class, 'index'])->name('index');
    Route::post('/employees/store', [EmployeesMasterController::class, 'store'])->name('store');
    Route::get('/employees/edit/{Id?}', [EmployeesMasterController::class, 'editview'])->name('edit');
    Route::post('/employees/update/{Id?}', [EmployeesMasterController::class, 'update'])->name('update');
    Route::delete('/employees/delete/{id?}', [EmployeesMasterController::class, 'delete'])->name('delete');
    Route::post('/employees/change-password', [EmployeesMasterController::class, 'changePassword'])->name('changePassword');
    Route::DELETE('/employees/deleteselected', [EmployeesMasterController::class, 'deleteselected'])->name('deleteselected');
});

//Floor plan list
Route::prefix('admin')->name('floor_plan.')->middleware('auth')->group(function () {
    Route::get('/floor/plan/index', [FloorPlanController::class, 'index'])->name('index');
    Route::delete('/floor/plan/delete', [FloorPlanController::class, 'delete'])->name('delete');
    Route::DELETE('/floor/plan/deleteselected', [FloorPlanController::class, 'deleteselected'])->name('deleteselected');
});


//Exhibitor Services
Route::prefix('admin')->name('exhibitor_services.')->middleware('auth')->group(function () {
    Route::any('/Exhibitor-Details', [ExhibitorServicesController::class, 'exhibitordetails'])->name('exhibitor_details');
    Route::any('/Exhibitor-Details-Excel/{CompanyName?}', [ExhibitorServicesController::class, 'exhibitordetailsExcel'])->name('exhibitor_details_Excel');
    Route::any('/Exhibitor-Lanyard', [ExhibitorServicesController::class, 'exhibitorlanyard'])->name('exhibitor_lanyard');
    Route::any('/Exhibitor-Lanyard-Excel/{CompanyName?}', [ExhibitorServicesController::class, 'exhibitorlanyardExcel'])->name('exhibitor_lanyard_Excel');
    Route::any('/Stall-Design', [ExhibitorServicesController::class, 'stalldesign'])->name('stalldesign');
    Route::any('/Stall-Design-Excel/{CompanyName?}', [ExhibitorServicesController::class, 'stalldesignExcel'])->name('stalldesign_Excel');
    Route::any('/Stall-Design-PDF/{id?}', [ExhibitorServicesController::class, 'stalldesignPDF'])->name('stalldesign_PDF');
    Route::any('/Additional-Furniture', [ExhibitorServicesController::class, 'additionalfurniture'])->name('additional_furniture');
    Route::any('/Additional-Furniture-Excel/{CompanyName?}', [ExhibitorServicesController::class, 'additionalfurnitureExcel'])->name('additional_furniture_Excel');
    Route::any('/Additional-Furniture-PDF/{id?}', [ExhibitorServicesController::class, 'additionalfurniturePDF'])->name('additional_furniture_PDF');

    //Participation Letter in exhibitor_details
    Route::any('/Participation-Letter/{id?}', [ExhibitorServicesController::class, 'ParticipationLetterPDF'])->name('Participation_LetterPDF');
    //Transportation Letter in exhibitor_details
    Route::any('/Transportation-Letter/{id?}', [ExhibitorServicesController::class, 'TransportationLetterPDF'])->name('Transportation_LetterPDF');

    // Admin Payment recived
    Route::any('/PaymentReceived', [ExhibitorServicesController::class, 'isPaymentReceived'])->name('isPaymentReceived');
    // No Due Letter
    Route::any('/No-Due-Letter/{id?}', [ExhibitorServicesController::class, 'noDue_LetterPDF'])->name('noDue_LetterPDF');

    //======================================Exhibitor-Vendor================================
    Route::get('/Exhibitor-Vendor', [ExhibitorServicesController::class, 'exhibitorvendor'])->name('exhibitorvendor');
    Route::post('/Exhibitor-Vendor-store', [ExhibitorServicesController::class, 'exhibitorvendorstore'])->name('exhibitorvendorstore');
    Route::get('/Exhibitor-Vendor-edit/{id?}', [ExhibitorServicesController::class, 'exhibitorvendoredit'])->name('exhibitorvendoredit');
    Route::post('/Exhibitor-Vendor-update', [ExhibitorServicesController::class, 'exhibitorvendorupdate'])->name('exhibitorvendorupdate');
    Route::delete('/Exhibitor-Vendor-Delete/{id?}', [ExhibitorServicesController::class, 'exhibitorvendordelete'])->name('exhibitorvendordelete');
    Route::any('/Exhibitor-Vendor-Excel/{CompanyName?}', [ExhibitorServicesController::class, 'exhibitorvendorExcel'])->name('exhibitorvendor_Excel');

    Route::get('/Exhibitor-Vendor-mobilecheck', [ExhibitorServicesController::class, 'exhibitorvendormobilecheck'])->name('exhibitorvendormobilecheck');
    Route::get('/Exhibitor-Vendor-mobilecheckedit', [ExhibitorServicesController::class, 'exhibitorvendormobilecheckedit'])->name('exhibitorvendormobilecheckEdit');
});


//============================== Exhibitor User Section Start=============================
// Route::get('/User/login', [ExhibitorLoginController::class, 'exhibitorlogin'])->name('exhibitorlogin');
Route::post('/User/login/submit', [ExhibitorLoginController::class, 'exhibitorloginsubmit'])->name('exhibitorloginsubmit');

Route::get('/User/Dashboard', [ExhibitorLoginController::class, 'exhibitordashboard'])->name('exhibitordashboard');

Route::get('/User/logout', [ExhibitorLoginController::class, 'exhibitorlogout'])->name('exhibitorlogout');

// Profile Routes
Route::get('User/Profile', [ExhibitorLoginController::class, 'ProfileDetail'])->name('User.profiledetail');
Route::get('User/Profile/Edit', [ExhibitorLoginController::class, 'EditProfile'])->name('User.EditProfile');
Route::post('User/Profile/update', [ExhibitorLoginController::class, 'updateProfile'])->name('User.profileupdate');
Route::post('User/change-password', [ExhibitorLoginController::class, 'changePassword'])->name('User.changepassword');

//Stall Design Accept
Route::get('User/Stall-Design-Accept', [ExhibitorLoginController::class, 'StallDesignAccept'])->name('User.StallDesignAccept');
//Stall Design Cancel
Route::get('User/Stall-Design-Cancel', [ExhibitorLoginController::class, 'StallDesignCancel'])->name('User.StallDesignCancel');
//Stall Design Form PDF
Route::get('User/Stall-Design-Form-PDF', [ExhibitorLoginController::class, 'StallDesignFormPDF'])->name('User.StallDesignFormPDF');


//Uploaded SMS(Whatsapp Einvites)
Route::get('/User/UploadedSMS', [ExhibitorUploadSMSController::class, 'index'])->name('User.UploadedSMS');
Route::post('/User/UploadedSMS/store', [ExhibitorUploadSMSController::class, 'create'])->name('User.UploadedSMSStore');


//User Visitor Registration
Route::get('/User/User-Visitor-Registration', [UserVisitorRegistrationController::class, 'index'])->name('User.visitorregistration');
Route::post('/User/User-Visitor-Registration/store', [UserVisitorRegistrationController::class, 'create'])->name('User.visitorregistrationstore');
Route::get('/User/User-Visitor-Registration/checkmobile', [UserVisitorRegistrationController::class, 'checkmobile'])->name('User.visitorregistrationcheckmobile');

Route::get('User/refresh_captcha', [UserVisitorRegistrationController::class, 'refreshCaptcha'])->name('User.refresh_captcha');

//Exhibitor Services in User
Route::get('User/Exhibitor-Details', [UserExhibitorServicesController::class, 'exhibitordetails'])->name('User.exhibitor_details');
Route::post('User/Exhibitor-Details/store', [UserExhibitorServicesController::class, 'exhibitordetailsstore'])->name('User.exhibitor_details_store');

//==========================================Exhibitor-Lanyard start====================================
Route::get('User/Exhibitor-Lanyard', [UserExhibitorServicesController::class, 'exhibitorlanyard'])->name('User.exhibitor_lanyard');
Route::post('User/Exhibitor-Lanyard/store', [UserExhibitorServicesController::class, 'exhibitorlanyardstore'])->name('User.exhibitor_lanyard_store');
Route::delete('User/Exhibitor-Lanyard', [UserExhibitorServicesController::class, 'exhibitorlanyarddelete'])->name('User.exhibitor_lanyard_delete');
Route::get('User/Exhibitor-Lanyard-mobilecheck', [UserExhibitorServicesController::class, 'exhibitorlanyardmobilecheck'])->name('User.exhibitor_lanyardmobilecheck');
//==========================================Exhibitor-Lanyard End========================================

Route::get('User/Participation-Letter', [UserExhibitorServicesController::class, 'ParticipationLetter'])->name('User.Participation_Letter');
Route::get('User/Transportation-Letter', [UserExhibitorServicesController::class, 'TransportationLetter'])->name('User.Transportation_Letter');


Route::get('User/Exhibition-Vendor', [UserExhibitorServicesController::class, 'ExhibitionVendor'])->name('User.ExhibitionVendor');


Route::get('User/Additional-Furniture', [UserExhibitorServicesController::class, 'AdditionalFurniture'])->name('User.AdditionalFurniture');
Route::delete('User/Additional-Furniture-delete', [UserExhibitorServicesController::class, 'AdditionalFurnituredelete'])->name('User.AdditionalFurnituredelete');
Route::get('User/Additional-Furniture-List', [UserExhibitorServicesController::class, 'AdditionalFurnitureList'])->name('User.AdditionalFurnitureList');
Route::post('User/Additional-Furniture-List-store', [UserExhibitorServicesController::class, 'AdditionalFurnitureListStore'])->name('User.AdditionalFurnitureListStore');

Route::any('User/No-Due-Letter', [UserExhibitorServicesController::class, 'NoDueLetterPDF'])->name('User.NoDueLetterPDF');


//Employees Modules
Route::prefix('employee')->name('employees_module.')->middleware('auth')->group(function () {
    Route::any('/index', [EmployeesVisitorRegistrationController::class, 'index'])->name('index');
    Route::get('/create', [EmployeesVisitorRegistrationController::class, 'create'])->name('create');
    Route::post('/store', [EmployeesVisitorRegistrationController::class, 'store'])->name('store');
    Route::get('/edit/{Id?}', [EmployeesVisitorRegistrationController::class, 'editview'])->name('edit');
    Route::post('/update/{Id?}', [EmployeesVisitorRegistrationController::class, 'update'])->name('update');
    Route::delete('/delete/{id?}', [EmployeesVisitorRegistrationController::class, 'delete'])->name('delete');
    Route::any('/employees/thank-you', [EmployeesVisitorRegistrationController::class, 'thank_you'])->name('thank_you');
});

//===============================Front Routes Start ===================================
Route::get('/blogs', [FrontController::class, 'blog'])->name('FrontBlog');
Route::get('/blog/{slug}', [FrontController::class, 'blogdetail'])->name('FrontBlogdetail');

Route::get('/', [FrontController::class, 'index'])->name('FrontIndex');

Route::get('/about', [FrontController::class, 'about'])->name('FrontAbout');
Route::get('/venue', [FrontController::class, 'venue'])->name('FrontVenue');

Route::get('/become-an-exhibitor', [FrontController::class, 'become_an_exhibitor'])->name('FrontBecome_An_Exhibitor');
Route::post('/become_an_exhibitor_store', [FrontController::class, 'become_an_exhibitor_store'])->name('FrontBecome_An_Exhibitor_Store');
Route::get('/become-an-exhibitor/Thank-you', [FrontController::class, 'become_an_exhibitor_thank_you'])->name('become_an_exhibitor_thank_you');
Route::get('/exhibitor-profile', [FrontController::class, 'exhibitor_profile'])->name('FrontExhibitor_Profile');
Route::get('/why-exibhit', [FrontController::class, 'why_exibhit'])->name('FrontWhy_Exibhit');
Route::get('/exhibition-benefit', [FrontController::class, 'exhibition_benefit'])->name('FrontExhibition_benefit');

Route::get('/visitor_registration', [FrontController::class, 'visitor_registration'])->name('FrontVisitor_Registration');

Route::get('/registration', [FrontController::class, 'registration'])->name('Registration');

Route::get('/b2b-visitor', [FrontController::class, 'b2bvisitor'])->name('FrontB2BVisitor');
Route::get('/general-visitor', [FrontController::class, 'generalvisitor'])->name('FrontGeneralVisitor');

Route::get('/visitor_registration_general_visitor', [FrontController::class, 'visitor_registration_general_visitor'])->name('visitor_registration_general_visitor');
Route::post('/visitor_registration-store', [FrontController::class, 'visitor_registration_store'])->name('FrontVisitor_Registration_store');
Route::get('/visitor_registration-checkmobile', [FrontController::class, 'FrontVisitor_Registration_checkmobile'])->name('FrontVisitor_Registration_checkmobile');
Route::get('/visitor-registration/Thank-you', [FrontController::class, 'visitor_registration_thank_you'])->name('visitor_registration_thank_you');
Route::get('/visitors-profile', [FrontController::class, 'visitors_profile'])->name('visitors_profile');
Route::get('/why-visit', [FrontController::class, 'why_visit'])->name('FrontWhy_Visit');

Route::get('/floor_plan', [FrontController::class, 'floor_plan_new'])->name('FrontFloor_Plan');
Route::post('/floor-plan/store', [FrontController::class, 'floor_plan_store'])->name('FrontFloor_Plan_store');
Route::get('/floor-plan/thank-you', [FrontController::class, 'floor_plan_thank_you'])->name('floor_plan_thank_you');


Route::get('/contact', [FrontController::class, 'contact'])->name('FrontContact');
Route::post('/contactus', [FrontController::class, 'contactstore'])->name('contactstore');
Route::get('/contact/Thank-you', [FrontController::class, 'contact_thank_you'])->name('contact_thank_you');



Route::get('/exhibitor_login', [FrontController::class, 'exhibitor_login'])->name('FrontExhibitor_Login');

Route::get('refresh_captcha', [FrontController::class, 'refreshCaptcha'])->name('refresh_captcha');

// Route::post('mapping/city', [FrontController::class, 'mappingcity'])->name('mappingcity');
Route::match(['get','post'],'mapping/city',[FrontController::class,'mappingcity'])->name('mappingcity');


//14-05-2024
Route::get('/Spot-Registration/', [FrontController::class, 'SpotRegistration'])->name('SpotRegistration');
Route::post('/Spot-registration-store', [FrontController::class, 'SpotRegistrationStore'])->name('SpotRegistrationStore');
Route::get('/qr-code', [FrontController::class, 'qrcode'])->name('qrcode');


Route::any('/print/record', [FrontController::class, 'printrecord'])->name('printrecord');
Route::any('/print/record/submit/{name?}/{mobile?}/{state?}/{city?}', [FrontController::class, 'printrecordsubmit'])->name('printrecordsubmit');
//14-05-2024


Route::get('/privacy-policy', [FrontController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-condition', [FrontController::class, 'terms_condition'])->name('terms_condition');


Route::get('/getMediaData', [FrontController::class, 'getMediaData'])->name('getMediaData');
Route::get('/sponser_registration', [FrontController::class, 'sponser_registration'])->name('FrontSponser_Registration');
Route::post('/sponser_registration_store', [FrontController::class, 'sponser_registration_store'])->name('FrontSponser_Registration_store');
Route::get('/who_will_visit', [FrontController::class, 'who_will_visit'])->name('FrontWho_Will_Visit');
Route::get('/show_promotion_program', [FrontController::class, 'show_promotion_program'])->name('FrontWhy_Show_Promotion_Program');

// Route::get('/privacy-policy', [FrontController::class, 'privacy_policy'])->name('privacy_policy');


Route::get('/Visitor-Registration', [FrontController::class, 'VisitorRegistrationOtherLink'])->name('VisitorRegistrationOtherLink');
Route::post('/visitor-registration-store', [FrontController::class, 'VisitorRegistrationOtherLink_store'])->name('VisitorRegistrationOtherLink_store');
