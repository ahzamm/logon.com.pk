<?php

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

Cache::forget('key');
Route::get('/clear-cache', function () {
    Cache::flush();
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "<h2 style='color:red'><marquee>Your System Has been Cleared!..'['-']'...</marquee></h2>";
});

Route::get('/flush', function () {
    Session::flush();
    return 'Your System Has been Wiped!...!';
})->name('flush');


Route::get('/','Site\HomeController@index')->name('home');
Route::get('/contact-us','Site\HomeController@contact')->name('contact');
Route::get('/careers','Site\CareerController@jobs')->name('career');
Route::get('/career/detail/{id}','Site\CareerController@job_detail')->name('job_detail');
Route::post('/career/application/{id}','Site\CareerController@application')->name('application');
Route::post('/contact-us','Site\HomeController@contactPost')->name('contact-us');
Route::get('/faqs','Site\HomeController@faqs')->name('faqs');

Route::get('/site/cities/{id}','Site\ConsumerController@getCities')->name('getcities');
Route::get('/site/corearea/{cityId}','Site\ConsumerController@getcoreAreas')->name('getcoreareas');
Route::get('/site/zonearea/{id}','Site\ConsumerController@getZoneAreas')->name('getzoneareas');
Route::post('/site/becomepartner','Site\ConsumerController@becomePartner')->name('becompartner');
Route::post('/site/becomeuser','Site\ConsumerController@becomeUser')->name('becomeuser');


// Route::get('/queue-worker',function(){
//     Artisan::call('queue:work');
// });

Route::get('/coverage-areas','Site\ConsumerController@index')->name('coverage');

Route::get('/{slug}','Site\HomeController@pages')->name('pages');

Route::prefix('admin')->group(function () {

    Route::get('/login', 'Admin\AuthController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\AuthController@login')->name('admin.login.post');
    Route::get('/verify','Admin\AuthController@verify')->name('admin.verify');
    Route::post('/verify','Admin\AuthController@verifyPost')->name('admin.verify.post');
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard','Admin\HomeController@dashboard')->name('admin.dashboard');
        Route::resource('front-pages','Admin\FrontPagesController')->parameters(['front-pages' => 'id']);
        Route::resource('front-menus','Admin\FrontMenuController')->parameters(['front-menus' => 'id']);
        Route::get('front-faqs/sort','Admin\FrontFaqController@sort')->name('faqs.sort');
        Route::post('front-faqs/sort','Admin\FrontFaqController@sortPost')->name('faqs.sort');
        Route::resource('front-faqs','Admin\FrontFaqController')->parameters(['front-faqs' => 'id']);;
        Route::get('front-contact','Admin\FrontContactController@index')->name('contact.index');
        Route::get('/front-contact/destroy/{id?}', 'Admin\FrontContactController@destroy')->name('front-contact.destroy');
        Route::post('/logout','Admin\AuthController@logout')->name('admin.logout');
        Route::resource('homeslider','Admin\HomeSliderController')->parameters(['homeslider' => 'id']);
        Route::resource('corporate','Admin\CorporateUserController')->parameters(['corporate' => 'id']);
        Route::resource('jobpost','Admin\JobPostController')->parameters(['jobpost' => 'id']);
        Route::resource('allowedip','Admin\AllowedIpController')->parameters(['allowedip' => 'id']);
        Route::resource('modalcontent','Admin\ModalContentController')->parameters(['modalcontent' => 'id']);;
        Route::get('modalshow/','Admin\ModalShowController@create')->name('modalshow.index')->middleware('checkuseraccess');
        Route::post('modalshow','Admin\ModalShowController@store')->name('modalshow.store');
        Route::get('modalshow/deactivate','Admin\ModalShowController@deactivate')->name('modalshow.deactivate');
        // Route::get('coveragerequest', 'Admin\CoverageRequestController@index')->name('coveragerequest.index');
        // Route::get('/coveragerequestmodal', 'Admin\CoverageRequestController@index')->name('coveragerequest.index');
        Route::resource('coveragerequest','Admin\CoverageRequestController')->parameters(['coveragerequest' => 'id']);
        Route::resource('why-choose-us','Admin\WhyChooseUsController')->parameters(['why-choose-us' => 'id']);
        
        // Route::resource('frontemail','Admin\FrontEmailController');
        Route::get('front-emails/edit','Admin\FrontContactController@editEmail');
        Route::post('front-emails/edit','Admin\FrontContactController@updateEmail');
        Route::get('admin/front-contact/data', 'Admin\FrontContactController@getFrontContactData')->name('front-contact.data');


        Route::get('career-emails/edit','Admin\JobPostController@editEmail');
        Route::post('career-emails/edit','Admin\JobPostController@updateEmail');
        // Route::get('/download-resume', 'Site\CareerController@downloadResume')->name('download.resume');
      


        Route::get('jobpost/detail/{id}','Admin\JobPostController@jobdetail')->name('jobpost.detail');
        Route::delete('jobpost/detail/{id}','Admin\JobPostController@jobdetailDestroy')->name('jobpost.detail.destroy');
        Route::get('jobpost/download/{id}','Admin\JobPostController@downloadResume')->name('jobpost.download');
        Route::get('maintenance','Admin\MaintenanceController@index')->name('maintenance.index');
        Route::post('maintenance/store','Admin\MaintenanceController@store')->name('maintenance.store');
        Route::get('maintenance/deactivate','Admin\MaintenanceController@deactivate')->name('maintenance.deactivate');
        Route::resource('employee','Admin\EmployeeController')->parameters(['employee' => 'id']);

        //Menus and Sub Menus Route -- Only Admin Access
        Route::get('menus/create', 'Admin\MenusController@create')->name('menus.create');
        Route::post('menus/create', 'Admin\MenusController@store')->name('menus.store');
        Route::get('menus/index', 'Admin\MenusController@index')->name('menus.index');
        Route::get('menus/sort', 'Admin\MenusController@sort')->name('menus.sort');
        Route::post('menus/sort', 'Admin\MenusController@sortPost')->name('menus.sortpost');
        Route::get('menu/edit/{id?}', 'Admin\MenusController@sort')->name('menu.edit');
        
        // Route::get('menus/show/{id}', 'Admin\MenusController@show')->name('menus.show');
        Route::get('menus/update/{id}', 'Admin\MenusController@edit')->name('menus.edit');
        Route::post('menus/update/{id}', 'Admin\MenusController@update')->name('menus.update');
        Route::post('menus/delete/{id}', 'Admin\MenusController@destroy')->name('menus.delete');
        Route::post('menus/checkroute', 'Admin\MenusController@checkroute')->name('menus.checkroute');
        Route::post('submenus/delete', 'Admin\MenusController@subMenuDelete')->name('submenus.delete');

        //User Menu Access
        // Route::get('useraccess/index', 'Admin\UserMenuAccessController@index')->name('useraccess.index');
        Route::get('useraccess/show/{id}', 'Admin\EmployeeController@showAccess')->name('useraccess.show');
        Route::post('useraccess/update/{id}', 'Admin\EmployeeController@updateAccess')->name('useraccess.update');

        Route::resource('cities','Admin\CitiesController')->parameters(['cities' => 'id']);
        Route::resource('coreareas','Admin\CoreAreaController')->parameters(['coreareas' => 'id']);
        Route::resource('zoneareas','Admin\ZoneAreaController')->parameters(['zoneareas' => 'id']);
        
        Route::get('partner-emails/{flag}','Admin\CitiesController@partnerEmail');
        Route::post('partner-emails','Admin\CitiesController@updateEmail');

        Route::resource('social', 'Admin\SocialController')->parameters(['social' => 'id']);
        Route::resource('service', 'Admin\ServiceController')->parameters(['service' => 'id']);
        Route::resource('client-benefit', 'Admin\ClientBenefitController')->parameters(['client-benefit' => 'id']);
        Route::resource('happy-clients', 'Admin\HappyClientController')->parameters(['happy-clients' => 'id']);
        Route::resource('contact-information', 'Admin\ContactInformationController')->parameters(['contact-information' => 'id']);
        Route::resource('smtp-configuration', 'Admin\SmtpConfigurationController')->parameters(['smtp-configuration' => 'id']);


        // Routes for status change
        Route::post('/homeslider/change/status', 'Admin\HomeSliderController@changeStatus')->name('homeslider.status');
        Route::post('/front-page/change/status', 'Admin\FrontPagesController@changeStatus')->name('front-page.status');
        Route::post('/front-menu/change/status', 'Admin\FrontMenuController@changeStatus')->name('front-menu.status');
        Route::post('/corporate/change/status', 'Admin\CorporateUserController@changeStatus')->name('corporate.status');
        Route::post('/city/change/status', 'Admin\CitiesController@changeStatus')->name('citiy.status');
        Route::post('/corearea/change/status', 'Admin\CoreAreaController@changeStatus')->name('corearea.status');
        Route::post('/zonearea/change/status', 'Admin\ZoneAreaController@changeStatus')->name('zonearea.status');
        Route::post('/modalcontent/change/status', 'Admin\ModalContentController@changeStatus')->name('modalcontent.status');
        Route::post('/front-faq/change/status', 'Admin\FrontFaqController@changeStatus')->name('front-faq.status');
        Route::post('/jobpost/change/status', 'Admin\JobPostController@changeStatus')->name('jobpost.status');
        Route::post('/employee/change/status', 'Admin\EmployeeController@changeStatus')->name('employee.status');
        Route::post('/why-choose-us/change/status', 'Admin\WhyChooseUsController@changeStatus')->name('why-choose-us.status');
        Route::post('/social/change_status/{id?}', 'Admin\SocialController@change_status')->name('social.status');
        Route::post('/service/change_status/{id?}', 'Admin\ServiceController@change_status')->name('service.status');
        Route::post('/client-benefit/change_status/{id?}', 'Admin\ClientBenefitController@change_status')->name('client-benefit.status');
        Route::post('/happy-clients/change_status/{id?}', 'Admin\HappyClientController@change_status')->name('happy-clients.status');
        Route::post('/smtp-configuration/change_status/{id?}', 'Admin\SmtpConfigurationController@change_status')->name('smtp-configuration.status');


        // Routes for updating User Info
        Route::post('user/{id?}/update-profile-pic/', 'Admin\EmployeeController@updateProfilePic')->name('user.profile.update');
        Route::post('user/update-password/', 'Admin\EmployeeController@updatePassword')->name('user.password.update');


        // Routes for Sorting
        Route::post('/homeslider/sort', 'Admin\HomeSliderController@sort')->name('homeslider.sort');
        Route::post('/front-menu/sort', 'Admin\FrontMenuController@sort')->name('front-menu.sort');
        Route::post('/corporate/sort', 'Admin\CorporateUserController@sort')->name('corporate.sort');
        Route::post('/front-faqs/sort', 'Admin\FrontFaqController@sort')->name('front-faqs.sort');
        Route::post('/jobpost/sort', 'Admin\JobPostController@sort')->name('jobpost.sort');
        Route::post('/menus/sort', 'Admin\MenusController@sort')->name('menus.sort');
        Route::post('/why-choose-us/sort', 'Admin\WhyChooseUsController@sort')->name('why-choose-us.sort');
        Route::post('/social/sort', 'Admin\SocialController@sort')->name('social.sort');
        Route::post('/service/sort', 'Admin\ServiceController@sort')->name('service.sort');
        Route::post('/client-benefit/sort', 'Admin\ClientBenefitController@sort')->name('client-benefit.sort');
        Route::post('/happy-clients/sort', 'Admin\HappyClientController@sort')->name('happy-clients.sort');


        // Routes for General Configurations
        Route::get('/general_configurations',  'Admin\GeneralConfigurationController@index')->name('general_configurations.index');
        Route::put('/general_configuration-update',  'Admin\GeneralConfigurationController@update')->name('general-configurations.update');
        Route::post('/otp_configuration',  'Admin\GeneralConfigurationController@change_status')->name('general-configurations.otp_configuration.update');

    });
});

