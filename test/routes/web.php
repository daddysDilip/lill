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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('admin-logout',function() {
    Auth::logout();
    return view('auth.login');
})->name('admin.logout');

//Route::post('admin-logout','Auth\LoginController@adminLogout')->name('admin.logout');

/**
 * Admin Login Authentication.
 */
Route::get('/shortly-admin', function() {
    if(!Auth::guest()) {
        return view('admin_dashboard');
    } else {
        return view('auth.login');
    }
})->name('admin.login');

Route::get('get-state-list','LocationController@getStateList');
Route::get('get-city-list','LocationController@getCityList');

/**
 * Client Authentication Routes
 */
Route::post('signup','Auth\RegisterController@createUser')->name('client.signup');
Route::get('verify-account/{userid}/{token}','Auth\RegisterController@verifyUserAccount')->name('verify.user.account');
Route::post('confirm-account/{id}','Auth\RegisterController@confirmUserAccount')->name('confirm.user.account');
Route::get('sign-in','Auth\UserLoginController@signin')->name('user.signin');
Route::get('user-login','Auth\UserLoginController@login')->name('user.login');

//Google Authentication Routes.
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle')->name('user.google.signup');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin-dashboard', 'HomeController@index')->name('admin.dashboard');

    Route::group(['prefix' => 'dashboard'], function()  
    { 
        /**
         * User Routes
         */
        Route::get('manage-users','Admin\UserController@index')->name('users');
        Route::get('create-user','Admin\UserController@createUser')->name('users.create');
        Route::post('store-user','Admin\UserController@storeUser')->name('users.store');
        Route::get('edit-user/{id}','Admin\UserController@editUser')->name('users.edit');
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

        /**
         * Site Logs Routes
         */
        Route::get('site-logs','Admin\LogController@index')->name('logs');

        /**
         * User Permission Routes 
         */
        Route::get('user-permission','Admin\PermissionController@index')->name('permissions');
    });

});

/**
 * Ajax Routes
 */
Route::get('change-user-status','Admin\UserController@changeUserStatus');
Route::get('change-role-status','Admin\RoleController@changeRoleStatus');
Route::get('change-module-status','Admin\ModuleController@changeModuleStatus');
Route::get('change-template-status','Admin\SMSController@changeTemplateStatus');
Route::post('check-email-exist', 'Admin\UserController@checkEmailExist');
Route::post('check-user-password', 'Admin\UserController@checkUserPassword');
Route::post('fetch-plans-feature','Admin\PlansController@fetchPlansFeature');
Route::get('flush-log-data','Admin\LogController@flushLogs');
Route::get('fetch-permission','Admin\PermissionController@fetchPermission');
Route::get('add-permission','Admin\PermissionController@addPermission');
Route::get('delete-map-feature','Admin\PlansController@destroyPlanFeature');
Route::get('change-plan-status','Admin\PlansController@changePlanStatus');

/**
 * Client ajax Routes.
 */
Route::post('user/checkUserEmailExist','Auth\RegisterController@checkUserEmailExist');
