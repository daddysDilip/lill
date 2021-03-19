<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');

Route::get('clean', function() {
    \Artisan::call('config:clear');
    \Artisan::call('optimize:clear');
    return "Done!";
});

/**
 * Admin Routes
 */

Route::get('/shortly-admin','HomeController@showAdminLoginForm')->name('show.admin.login');
Route::post('/admin-login','Auth\admin\LoginController@adminLogin')->name('admin.login');

Route::get('admin-dashboard',function() {
    if(Auth::guard('admin')->check()) {
        return view('admin_dashboard');
    } else {
        return redirect()->route('show.admin.login');
    }
});

Route::group(['prefix' => 'dashboard'], function()  
{ 
    /**
     * User Routes
     */
    Route::get('manage-users','Admin\UserController@index')->name('users');
    Route::get('create-user','Admin\UserController@createUser')->name('users.create');
    Route::post('store-user','Admin\UserController@storeUser')->name('users.store');
    Route::get('edit-user/{id}','Admin\UserController@editUser')->name('users.edit');
    Route::get('checkout-user/{id}','Admin\UserController@checkoutUser')->name('users.checkout');
    Route::post('update-user/{id}', 'Admin\UserController@updateUser')->name('users.update');

    /**
     * User Roles Routes
     */
    Route::get('manage-roles','Admin\RoleController@index')->name('roles');
    Route::get('create-role','Admin\RoleController@createRole')->name('roles.create');
    Route::post('store-role','Admin\RoleController@storeRole')->name('roles.store');
    Route::get('edit-role/{id}','Admin\RoleController@editRole')->name('roles.edit');
    Route::post('update-role/{id}', 'Admin\RoleController@updateRole')->name('roles.update');

    /**
     * Site Modules Routes
     */
    Route::get('manage-modules','Admin\ModuleController@index')->name('modules');
    Route::get('create-module','Admin\ModuleController@createModule')->name('modules.create');
    Route::post('store-module','Admin\ModuleController@storeModule')->name('modules.store');
    Route::get('edit-module/{id}','Admin\ModuleController@editModule')->name('modules.edit');
    Route::post('update-module/{id}', 'Admin\ModuleController@updateModule')->name('modules.update');

    /**
     * Site Modules Routes
     */
    Route::get('manage-settings','Admin\SettingsController@index')->name('settings');
    Route::post('update-settings', 'Admin\SettingsController@updateSettings')->name('settings.update');

    /**
     * SMS Templates Routes
     */
    Route::get('manage-sms-templates','Admin\SMSController@index')->name('sms.templates');
    Route::get('create-sms-template','Admin\SMSController@createSMSTemplate')->name('sms.templates.create');
    Route::post('store-sms-template','Admin\SMSController@storeSMSTemplate')->name('sms.templates.store');
    Route::get('edit-sms-template/{id}','Admin\SMSController@editSMSTemplate')->name('sms.templates.edit');
    Route::post('update-sms-template/{id}', 'Admin\SMSController@updateSMSTemplate')->name('sms.templates.update');

    /**
     * Email Templates Routes
     */
    Route::get('manage-email-templates','Admin\EmailController@index')->name('email.templates');
    Route::get('create-email-template','Admin\EmailController@createEmailTemplate')->name('email.templates.create');
    Route::post('store-email-template','Admin\EmailController@storeEmailTemplate')->name('email.templates.store');
    Route::get('edit-email-template/{id}','Admin\EmailController@editEmailTemplate')->name('email.templates.edit');
    Route::post('update-email-template/{id}', 'Admin\EmailController@updateEmailTemplate')->name('email.templates.update');

    /**
     * Plan type Routes
     */
    Route::get('manage-plan-types','Admin\PlanTypeController@index')->name('plans.types');
    Route::get('create-plan-type','Admin\PlanTypeController@createPlanType')->name('plan.types.create');
    Route::post('store-plan-type','Admin\PlanTypeController@storePlanType')->name('plan.types.store');
    Route::get('edit-plan-type/{id}','Admin\PlanTypeController@editPlanType')->name('plan.types.edit');
    Route::post('update-plan-type/{id}', 'Admin\PlanTypeController@updatePlanType')->name('plan.types.update');

    /**
     * Plan Features Routes
     */
    Route::get('manage-plan-feature','Admin\PlanFeatureController@index')->name('plan.feature');
    Route::get('create-plan-feature','Admin\PlanFeatureController@createPlanFeature')->name('plan.feature.create');
    Route::post('store-plan-feature','Admin\PlanFeatureController@storePlanFeature')->name('plan.feature.store');
    Route::get('edit-plan-feature/{id}','Admin\PlanFeatureController@editPlanFeature')->name('plan.feature.edit');
    Route::post('update-plan-feature/{id}', 'Admin\PlanFeatureController@updatePlanFeature')->name('plan.feature.update');
    Route::delete('delete-plan-feature/{id}', 'Admin\PlanFeatureController@deletePlanFeature')->name('plan.feature.delete');

    /**
     * User Account Routes
     */
    Route::get('view-profile','Admin\UserController@showEditProfile')->name('user.edit.profile');
    Route::post('update-profile/{id}','Admin\UserController@updateProfile')->name('user.update.profile');
    Route::post('change-password','Admin\UserController@changePassword')->name('user.change.password');
    Route::get('view-change-password','Admin\UserController@viewChangePassword')->name('user.view.change.password');

    /**
     * Plans Routes
     */
    Route::get('manage-plan','Admin\PlansController@index')->name('plans');
    Route::get('create-plan','Admin\PlansController@createPlan')->name('plan.create');
    Route::post('store-plan','Admin\PlansController@storePlan')->name('plan.store');
    Route::get('edit-plan/{id}','Admin\PlansController@editPlan')->name('plan.edit');
    Route::post('update-plan/{id}', 'Admin\PlansController@updatePlan')->name('plan.update');

    Route::get('manage-customers','Admin\UserController@showCustomers')->name('customers');
    Route::get('view-customer-details/{id}','Admin\UserController@viewCustomerDetail')->name('customer.view');

    /**
     * Site Logs Routes
     */
    Route::get('site-logs','Admin\LogController@index')->name('logs');

    /**
     * User Permission Routes 
     */
    Route::get('user-permission','Admin\PermissionController@index')->name('permissions');

    Route::get('admin-logout','Auth\admin\LoginController@adminLogout')->name('admin.logout');
    Route::get('/admin-dashboard','Auth\LoginController@showAdminDashboard')->name('admin.dashboard');

    /**
     * FAQ
     */
    Route::get('manage-faq','Admin\SettingsController@showAllFAQ')->name('manage.faq');
    Route::get('create-faq','Admin\SettingsController@createFAQ')->name('faq.create');
    Route::post('insert-faq','Admin\SettingsController@insertFAQ')->name('faq.insert');
    Route::get('edit-faq/{id}','Admin\SettingsController@editFAQ')->name('faq.edit');
    Route::post('update-faq/{id}','Admin\SettingsController@updateFAQ')->name('faq.update');

    Route::get('manage-link-types','Admin\LinkTypeController@index')->name('manage.link.types');
    Route::get('create-link-type','Admin\LinkTypeController@createLinkType')->name('link.type.create');

    Route::get('manage-customer-enquiry','Admin\ReportsController@showCustomerEnquiry')->name('manage.customer.enquiry');

});

Route::get('/fetch-permission','Admin\PermissionController@fetchPermission')->name('fetch.permission');

/**
 * Client Routes
 */
 Route::get('pricing','HomeController@showPricing')->name('pricing');
 Route::get('pricing-detail/{id}','HomeController@showPricingDetail')->name('pricing-detail');
 Route::get('faq','HomeController@showFAQ')->name('faq');
 Route::get('about','HomeController@showAbout')->name('about');
 Route::get('privacy-policy','HomeController@showprivacypolicy')->name('privacy.and.policy');
 Route::get('terms-conditions','HomeController@showtermsandconditions')->name('terms.and.conditions');
 Route::get('cookie-policy','HomeController@showcookiepolicy')->name('cookie.and.policy');


 //Client Authentication Routes
Route::get('/signin','HomeController@showUserLogin')->name('user.signin');
Route::post('/login', 'Auth\LoginController@userLogin')->name('user.login');
Route::get('signup/{plan?}','Auth\RegisterController@showRegisterForm');
Route::post('user-signup','Client\RegisterController@createUser')->name('user.signup');
Route::get('verify-account/{userid}/{token}','Client\RegisterController@verifyUserAccount')->name('verify.user.account');
Route::post('confirm-account/{id}','Client\RegisterController@confirmUserAccount')->name('confirm.user.account');
Route::get('forgot-password','Auth\ResetPasswordController@showForgotPassword')->name('forgot.password');
Route::post('send-reset-password-link','Auth\ResetPasswordController@sendVerificationLink')->name('send.reset.password.link');
Route::get('verify-password-link/{token}/{email}','Auth\ResetPasswordController@verifyResetLink')->name('verify.password.link');
Route::post('change-password','Auth\ResetPasswordController@changePassword')->name('user.reset.password');

//Google Authentication Routes.
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle')->name('user.google.signup');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/user-dashboard','Auth\LoginController@showClientDashboard')->name('user.dashboard');
// Route::get('/user-link-details','Auth\LoginController@showLinkDetails')->name('user.link.detail');


//Route::get('/{slug}','Client\URLReadController@fetchLinkSchema');

Route::get('/bot-detected','Client\URLReadController@showBotPage')->name('link.show.bot');

Route::group(['prefix' => 'user-dashboard', 'middleware' => 'validUser'], function() {
    /**
     * Short URL Created & Read Routes
     */
    Route::get('create-link','Client\URLGenerateController@showCreateLink')->name('create.link');
    Route::post('fetch-website-schema','Client\URLGenerateController@fetchWebsiteSchema')->name('fetch.website.schema');
    Route::post('store-link','Client\URLGenerateController@storeLink')->name('store.link');
    Route::get('edit-link/{id}','Client\URLGenerateController@editLink')->name('edit.link');
    Route::post('update-link','Client\URLGenerateController@updateLink')->name('update.link');

    //user reoprts
    Route::get('/user-chart-report','Auth\ReportController@showChartReprot')->name('chart.report');
    Route::get('/user-Link-report','Auth\ReportController@showLinksReprot')->name('link.report');

    /**
     * Account Settings Routes
     */
    Route::get('account-settings/{tab}','Client\AccountController@showAccountSettings')->name('user.account.settings');
    Route::post('change-password','Client\AccountController@changePassword')->name('change.user.password');

    /**
     * Link Groups Routes
     */
    Route::get('link-groups','Client\LinkGroupsController@showAllGroups')->name('user.links.groups');
    Route::get('create-link-group','Client\LinkGroupsController@createLinkGroup')->name('create.link.group');
    Route::post('insert-link-group','Client\LinkGroupsController@insertLinkGroup')->name('insert.link.group');
    Route::get('view-group-links/{id}','Client\LinkGroupsController@viewGroupLinks')->name('view.group.links');
    Route::post('group-link-delete','Client\LinkGroupsController@deleteGroupLink')->name('group.link.delete');

    Route::get('download-qr-code/{code}','Client\URLGenerateController@downloadQRCode')->name('download.qr.code');

    Route::get('bulk-links','Client\BulkLinksController@showExportLinks')->name('user.bulk.links');
    Route::get('import-bulk-links','Client\BulkLinksController@showImportLinks')->name('user.bulk.import.links');
    Route::post('export-links','Client\BulkLinksController@exportLinks')->name('export.links');
    Route::get('download-file123','Client\BulkLinksController@downloadImportSampleFile')->name('download.sample.file');
    Route::post('bulk-links-import','Client\BulkLinksController@importLinks')->name('bulk.links.import');

    Route::get('user-logout','Auth\LoginController@userLogout')->name('user.logout');
});

/**
 * Ajax Routes
 */
Route::post('reply-enquiry','Admin\ReportsController@replyCustomerEnquiry')->name('reply.customer.enquiry');
Route::post('change-user-status','Admin\UserController@changeUserStatus')->name('change.user.status');
Route::get('change-role-status','Admin\RoleController@changeRoleStatus');
Route::get('change-module-status','Admin\ModuleController@changeModuleStatus');
Route::get('change-template-status','Admin\SMSController@changeTemplateStatus');
Route::post('check-email-exist', 'Admin\UserController@checkEmailExist');
Route::post('check-new-email-exist', 'Client\AccountController@checkNewEmailExist');
Route::post('check-user-password', 'Admin\UserController@checkUserPassword');
Route::post('fetch-plans-feature','Admin\PlansController@fetchPlansFeature');
Route::get('flush-log-data','Admin\LogController@flushLogs');
Route::get('add-permission','Admin\PermissionController@addPermission');
Route::get('delete-map-feature','Admin\PlansController@destroyPlanFeature');
Route::get('change-plan-status','Admin\PlansController@changePlanStatus');
Route::post('get-state-list','LocationController@getStateList')->name('get.state.list');
Route::post('get-city-list','LocationController@getCityList')->name('get.city.list');
Route::get('view-link-statistics/{id}','Admin\UserController@viewLinkStatistics')->name('view.link.statistics');

/**
 * Client ajax Routes.
 */
Route::post('check-guest-user','Client\URLGenerateController@checkGuestUser')->name('check.guest.user');
Route::post('send-quotation','HomeController@sendQuotation')->name('send.quotation');
Route::post('delete-link-group','Client\LinkGroupsController@deleteLinkGroup')->name('delete.link.group');

Route::get('get-unread-notification','Client\NotificationsController@getUnreadNotification')->name('get.unread.notification');
Route::get('read-all-notification','Client\NotificationsController@markAsReadNotification')->name('read.all.notification');

Route::post('user/checkUserEmailExist','Client\RegisterController@checkUserEmailExist');
Route::post('store-guest-user-data','Client\URLGenerateController@storeGuestUserData')->name('store.guest.user.data');
Route::post('create-shortest-link','Client\URLGenerateController@createGuestLink')->name('create.shortest.link');
Route::post('create-shortest-link-type','Client\URLGenerateController@createGuestLinkWithType')->name('create.shortest.link.type');
Route::post('search-link', 'Client\URLReadController@searchURL')->name('search.link');
Route::post('get-links','Client\URLReadController@fetchLinks')->name('get.links');
Route::post('get-filterd-links','Client\URLReadController@fetchFilterdLinks')->name('get.filterd.links');
Route::post('get-link-details','Client\URLReadController@fetchLinkData')->name('get.link.details');
Route::post('get-link-map','Client\URLReadController@fetchLinkMap')->name('get.link.map');
Route::post('add-to-favorite','Client\URLGenerateController@addToFavorite')->name('add.to.favorite');
Route::post('delete-favorite','Client\URLGenerateController@deleteFavorite')->name('delete.favorite');
Route::post('dashboard-link-change-status','Client\URLGenerateController@dashboard_link_change_status')->name('dashboard.link.change.status');
Route::post('delete-dashboard-link','Client\URLGenerateController@deleteLink')->name('dashboard.link.delete');
Route::post('sort-link','Client\URLGenerateController@sortLink')->name('sort.link');
Route::get('view-user/{id}','Client\URLGenerateController@shareLink')->name('view.share.link');
Route::post('change-account-name','Client\AccountController@changeAccountName')->name('change.account.name');
Route::post('add-new-client-email','Client\AccountController@addClientEmail')->name('add.new.client.email');
Route::post('monthly-report','Client\URLReadController@getMonthlyReport')->name('get.link.monthly.report');
Route::get('change-setting-status','Admin\SettingsController@changeSettingStatus')->name('change.setting.status');
Route::get('change-faq-status','Admin\SettingsController@changeFAQStatus')->name('change.faq.status');


Route::get('/{slug}','Client\URLReadController@fetchLinkSchema');