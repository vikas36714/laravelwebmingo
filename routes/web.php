<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\PackageCategoryController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\ManagePinCodeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\ContentsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\PendingLeadsController;
use App\Http\Controllers\Admin\ManageLeadsController;
use App\Http\Controllers\Admin\ManageLeadStatusController;
use App\Http\Controllers\Admin\VendorLoanController;
use App\Http\Controllers\Admin\VendorLoanHistoryController;

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

Route::get('/', function () {
    Auth::logout();
    abort(404);  // for other user throw 404 error
    return 'Page Not Found !!';
});

Route::get('/admin', function () {
    Auth::logout();
    return view('auth.login');
})->name('/admin');;

Route::get('forget-password', [ForgotPasswordController::class, 'getEmail']);
Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget-password');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset_password');
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);


Route::middleware(['auth:sanctum', 'verified','admin'])->get('/admin/dashboard', function () {
    return view('dashboard');

})->name('dashboard');

Route::group(['prefix' => 'admin/dashboard','middleware' => ['auth','admin']], function () {
    // -------------------------- Manage Category ------------------------------//
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

     // -------------------------- Manage Pin code ------------------------------//
     Route::get('pincode', [ManagePinCodeController::class, 'index'])->name('admin.pincode');
     Route::get('pincode/view-form/{id}', [ManagePinCodeController::class, 'viewForm'])->name('admin.pincode.view-form');
     Route::post('pincode', [ManagePinCodeController::class, 'store'])->name('admin.pincode.store');
     Route::get('pincode/add-form/{id}', [ManagePinCodeController::class, 'addForm'])->name('admin.pincode.add-form');
     Route::get('pincode/edit/{id}', [ManagePinCodeController::class, 'edit'])->name('admin.pincode.edit');
     Route::post('pincode/edit-form/{id}', [ManagePinCodeController::class, 'editForm'])->name('admin.pincode.edit-form');
     Route::post('pincode/edit/{id}', [ManagePinCodeController::class, 'update'])->name('admin.pincode.update');
     Route::get('pincode/edit/delete/{id}', [ManagePinCodeController::class, 'destroy'])->name('admin.pincode.destroy');

    // -------------------------- Manage Sub-Category ------------------------------//
    Route::get('sub-category', [SubCategoryController::class, 'index'])->name('admin.sub-category');
    Route::get('sub-category/create', [SubCategoryController::class, 'create'])->name('admin.sub-category.create');
                  // --------- Get States By Country ----------//
    Route::post('get-state-by-country', [SubCategoryController::class, 'getStatesByCountry'])->name('admin.sub-category.get-state-by-country');

                  // --------- Get Cities By State ----------//
    Route::post('get-cities-by-state', [SubCategoryController::class, 'getCitiesByState'])->name('admin.sub-category.get-cities-by-state');

                  // --------- Get Pincode By City ----------//
    Route::post('get-pincodes-by-city', [SubCategoryController::class, 'getPincodesByCity'])->name('admin.sub-category.get-pincodes-by-city');

    Route::post('sub-category', [SubCategoryController::class, 'store'])->name('admin.sub-category.store');
    Route::get('sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.sub-category.edit');
    Route::post('sub-category/edit/{id}', [SubCategoryController::class, 'update'])->name('admin.sub-category.update');
    Route::get('sub-category/delete/{id}', [SubCategoryController::class, 'destroy'])->name('admin.sub-category.destroy');

     // -------------------------- Manage Sub Sub-Category ------------------------------//
     Route::get('sub-sub-category', [SubSubCategoryController::class, 'index'])->name('admin.sub-sub-category');
     Route::get('sub-sub-category/create', [SubSubCategoryController::class, 'create'])->name('admin.sub-sub-category.create');
    // -------------------------- Get SubCategories By Category Id ------------------------------//
     Route::post('getSubCategoriesByCategoryId', [SubSubCategoryController::class, 'getSubCategoriesByCategoryId'])->name('admin.sub-sub-category.getSubCategoriesByCategoryId');
    // -------------------------- End Get SubCategories By Category Id ------------------------------//
     Route::post('sub-sub-category', [SubSubCategoryController::class, 'store'])->name('admin.sub-sub-category.store');
     Route::get('sub-sub-category/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('admin.sub-sub-category.edit');
     Route::post('sub-sub-category/edit/{id}', [SubSubCategoryController::class, 'update'])->name('admin.sub-sub-category.update');
     Route::get('sub-sub-category/delete/{id}', [SubSubCategoryController::class, 'destroy'])->name('admin.sub-sub-category.destroy');

     // -------------------------- Manage Services ------------------------------//
     Route::get('services', [ServicesController::class, 'index'])->name('admin.services');
     Route::post('services/get-sub-sub-categories-by-subCategoryId', [ServicesController::class, 'getSubSubCategoriesBySubCategoryId'])->name('admin.services.get-sub-sub-categories-by-subCategoryId');

    // --------- Get Packages categroies By sub-sub-category ----------//
    Route::post('get-package-categories-by-subSubCategoryId', [ServicesController::class, 'getPackageCategoriesBySubSubCategory'])->name('admin.services.get-package-categories-by-subSubCategory');

     Route::post('services', [ServicesController::class, 'store'])->name('admin.services.store');
     Route::get('services/edit/{id}', [ServicesController::class, 'edit'])->name('admin.services.edit');
     Route::post('services/edit/{id}', [ServicesController::class, 'update'])->name('admin.services.update');
     Route::get('services/delete/{id}', [ServicesController::class, 'destroy'])->name('admin.services.destroy');

     Route::get('services/get_service_amount', [ServicesController::class, 'getServiceAmountByServiceId'])->name('admin.services.get_service_amount');

     // -------------------------- Manage Package Category ------------------------------//
     Route::get('package-category', [PackageCategoryController::class, 'index'])->name('admin.package-category');

     Route::post('package-category', [PackageCategoryController::class, 'store'])->name('admin.package-category.store');

     Route::get('package-category/show/{id}', [PackageCategoryController::class, 'show'])->name('admin.package-category.show');

     Route::get('package-category/edit/{id}', [PackageCategoryController::class, 'edit'])->name('admin.package-category.edit');
     Route::post('package-category/edit', [PackageCategoryController::class, 'update'])->name('admin.package-category.update');
     Route::get('package-category/delete/{id}', [PackageCategoryController::class, 'destroy'])->name('admin.package-category.destroy');

     // -------------------------- Manage Packages ------------------------------//
     Route::get('packages', [PackagesController::class, 'index'])->name('admin.packages');
     Route::get('packages/create', [PackagesController::class, 'create'])->name('admin.packages.create');
     Route::post('packages', [PackagesController::class, 'store'])->name('admin.packages.store');
     Route::get('packages/edit/{id}', [PackagesController::class, 'edit'])->name('admin.packages.edit');
     Route::post('packages/edit/{id}', [PackagesController::class, 'update'])->name('admin.packages.update');
     Route::get('packages/delete/{id}', [PackagesController::class, 'destroy'])->name('admin.packages.destroy');


     // -------------------------- Manage Users ------------------------------//
    Route::get('user', [UserController::class, 'index'])->name('admin.user');
    //Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('user/edit/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('user/view/{id}', [UserController::class, 'show'])->name('admin.user.view');

    // -------------------------- Manage Pending Leads------------------------------//
    Route::get('pending-leads', [PendingLeadsController::class, 'index'])->name('admin.pending-leads');

    // -------------------------- Manage Leads------------------------------//
    Route::get('manage-leads', [ManageLeadsController::class, 'index'])->name('admin.manage-leads');

    // -------------------------- Manage Leads Status------------------------------//
    Route::get('lead-status', [ManageLeadStatusController::class, 'index'])->name('admin.lead-status');

    // -------------------------- Manage Vendors ------------------------------//
    Route::get('vendor', [VendorController::class, 'index'])->name('admin.vendor');
    Route::get('vendor/create', [VendorController::class, 'create'])->name('admin.vendor.create');
    Route::post('vendor', [VendorController::class, 'store'])->name('admin.vendor.store');
    Route::get('vendor/edit/{id}', [VendorController::class, 'edit'])->name('admin.vendor.edit');
    Route::post('vendor/edit/{id}', [VendorController::class, 'update'])->name('admin.vendor.update');
    Route::get('vendor/view/{id}', [VendorController::class, 'show'])->name('admin.vendor.view');
    Route::get('vendor/delete/{id}', [VendorController::class, 'destroy'])->name('admin.vendor.destroy');

    // -------------------------- Manage Vendor Loans ------------------------------//
    Route::get('vendor-loan', [VendorLoanController::class, 'index'])->name('admin.vendor-loan');
    // -------- Check Vendor Exist or Not ---------//
    Route::get('vendor-loan/check-vendor-exist', [VendorLoanController::class, 'checkVendorExist'])->name('admin.vendor-loan.check-vendor-exist');
    Route::post('vendor-loan', [VendorLoanController::class, 'store'])->name('admin.vendor-loan.store');
    // -------- Get Vendor Details ---------//
    Route::get('vendor-loan/view-vendor/{id}', [VendorLoanController::class, 'show'])->name('admin.vendor-loan.view-vendor');
    // -------- Get Vendor Loan ---------//
    Route::get('vendor-loan/get-vendor-loan/{id}', [VendorLoanController::class, 'edit'])->name('admin.vendor-loan.get-vendor-loan.edit');
    Route::post('vendor-loan/edit', [VendorLoanController::class, 'update'])->name('admin.vendor-loan.update');

    // -------------------------- Manage Vendor Loan History ------------------------------//
    Route::get('vendor-loan-history/{id}', [VendorLoanHistoryController::class, 'index'])->name('admin.vendor-loan-history');


    // -------------------------- Content Pages------------------------------//
    Route::get('about', [ContentsController::class, 'about'])->name('admin.about');
    Route::post('about/{id}', [ContentsController::class, 'updateAbout'])->name('admin.about.update');
    Route::get('terms-conditions', [ContentsController::class, 'termsAndConditions'])->name('admin.terms-conditions');
    Route::post('terms-conditions/{id}', [ContentsController::class, 'updateTermAndCondition'])->name('admin.terms-conditions.update');
    Route::get('privacy-policy', [ContentsController::class, 'privacyPolicy'])->name('admin.privacy-policy');
    Route::post('privacy-policy/{id}', [ContentsController::class, 'updatePrivacyPolicy'])->name('admin.privacy-policy.update');
    Route::get('refund-cancellation', [ContentsController::class, 'refundAndCancellation'])->name('admin.refund-cancellation');
    Route::post('refund-cancellation/{id}', [ContentsController::class, 'updateRefundAndCancellation'])->name('admin.refund-cancellation.update');

    // -------------------------- Manage FAQ's ------------------------------//
    Route::get('faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::get('faq/edit/{id}', [FaqController::class, 'edit'])->name('admin.faq.edit');
    Route::post('faq/edit', [FaqController::class, 'update'])->name('admin.faq.update');
    Route::get('faq/delete/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
    Route::get('faq/view/{id}', [FaqController::class, 'show'])->name('admin.faq.view');

    Route::get('refund-cancellation', [ContentsController::class, 'refundAndCancellation'])->name('admin.refund-cancellation');

    // -------------------------- Enquiry Controller ------------------------------//
    Route::get('contact', [EnquiryController::class, 'contact'])->name('admin.contact');
    Route::get('contact/{id}', [EnquiryController::class, 'contactDestroy'])->name('admin.enquery.contact-destroy');

    Route::get('support', [EnquiryController::class, 'support'])->name('admin.support');
    Route::get('support/{id}', [EnquiryController::class, 'supportDestroy'])->name('admin.enquery.support-destroy');

    Route::get('feedback', [EnquiryController::class, 'feedback'])->name('admin.feedback');
    Route::get('feedback/{id}', [EnquiryController::class, 'feedbackDestroy'])->name('admin.enquery.feedback-destroy');

    // -------------------------- General Settings ------------------------------//
    Route::get('general-settings', [GeneralSettingsController::class, 'index'])->name('admin.general-settings');
    Route::post('general-settings/{id}', [GeneralSettingsController::class, 'update'])->name('admin.general-settings.update');



});


// -------------------------- VENDOR ROUTES FILE ------------------------------//
require 'vendor.php';
