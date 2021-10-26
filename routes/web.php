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
Route::get('t2', function () {
    event(new App\Events\StatusRefUser('new Order Number'.rand('1111','9999'))  );
    return "Event has been sent!";
});
Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

/*Forgot Password User*/
Route::get('/user/password-reset', 'Auth\ForgotPasswordController@PasswordReset');
Route::post('/sendPasswordResetLink', 'Auth\ForgotPasswordController@SendsPasswordResetEmails');
Route::get('/user/passwordresetLink/{token}', 'Auth\ForgotPasswordController@changePassword');
Route::post('/updatePassword', 'Auth\ForgotPasswordController@updatePassword');
/*Forgot Password User*/

Route::get('associate/doLogin/{user_key}', 'DocumentController@userLoginByAdmin')->name('doUserLogin');


//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/user/upload/document','DocumentController@uploadDocument');
Route::get('/member/login', 'Auth\LoginController@showLoginForm');
Route::post('/member/login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', 'WebsiteController@newhome');
 //Route::get('/', 'Auth\LoginController@showLoginForm');




Route::get('/about', 'WebsiteController@about');
Route::get('/Dholera-SIR', 'WebsiteController@dholeraSir');
Route::get('/gallery', 'WebsiteController@gallery');
Route::get('/download-section', 'WebsiteController@downloads');
Route::get('/legals', 'WebsiteController@legals');
Route::get('/contact', 'WebsiteController@contact');
Route::get('/privacy', 'WebsiteController@privacy');
Route::POST('/submit', 'WebsiteController@submitSupport');



if (App::isDownForMaintenance())
{
return \Response::json(['hello' => 'Server down time'], 503);
}
Route::get('/invoice', 'HomeController@invoice');
Route::get('/printInvoice', 'HomeController@Printinvoice');

Route::get('/acknowledgement', function () {
		return view('comman.acknowledgement');
})->middleware('auth');
// Route::get('/',function () {
// return view('auth.login');
// });

Route::get('/classified/cities/{state_id}', 'DocumentController@getCities');


// CSC
	Route::get('/getState', 'Controller@getState');
	Route::get('/getCity', 'Controller@getCities');
// CSC

Route::get('/welcome', 'HomeWebController@welcome');
Route::get('/message', 'HomeController@user_message');
Route::get('/getTree/{user_key}', 'TreeController@getTree');
Route::get('/getTree/',function(){
return redirect('/associatemodule/add-new');
});
Route::get('/email', 'HomeController@email');
Route::get('/category/{type}', 'HomeWebController@categories');
Route::get('/generationPayment', 'HomeController@generationPayment');
Route::get('/binaryPayment', 'HomeController@binaryPayment');
Route::get('/payoutsevenk', 'HomeController@payoutsevenk');
Route::get('/tree/generationLevel.jsp/{user_id}/{levlel}/', 'TreeController@getGenerationLevel');
Route::get('/tree/generationByLevel.jsp/{level}', 'TreeController@GetgenerationByLevel');
Route::get('/tree/binary/', 'TreeController@tree');
Route::get('/get-notification/user', 'EmailController@getNotification');
Route::post('/transferpin/userDetails', 'EmailController@userDetailsByKey');
Route::get('/get-widget', 'HomeController@widget');

Route::group(['prefix' => 'support'], function () {
/*Support*/
Route::get('/', 'SupportController@index');
Route::POST('/store', 'SupportController@store');
Route::get('/history', 'SupportController@history');
Route::post('/chating', 'SupportController@chating');
/*Support Module*/
});
Route::group(['prefix' => 'email'], function () {
Route::post('/', 'EmailController@send');
});
// ******************************MLM***********************************


/*************************************************user Routes******************************/
// Authentication Routes...
Route::get('/get-started/user/packageVerification.jsp/{package_id}/{pin}/{sponser_id}', 'Auth\LoginController@packageVerification');
Route::get('/check/user/sponserUserName.jsp/{sponser_id}', 'Auth\LoginController@sponserUserName');
Route::get('/userDocumentsDownload/{user_id}/{document_id}', 'HomeController@userDocumentsDownload');
Route::get('/check/user/sponserUserData.jsp/{sponser_id}', 'Auth\LoginController@sponserUserData');

Route::get('/home', 'HomeController@index');
Route::get('/congrats/user/{user_key}', 'HomeController@congretsForEarnig');
Route::post('/search/user-name', 'HomeController@getUserName');
// Route::get('/application', 'HomeController@application');
/*TREE Module*/
Route::get('/activation', 'WalletController@activation');
Route::get('/transfer', 'WalletController@transfer');
Route::group(['prefix' => 'referal'], function () {
Route::get('/', 'HomeController@referal');
Route::get('/direct', 'AssociateModuleController@direct');

Route::get('/binary-status', 'TreeController@binaryStatus');
Route::get('/generation-level', 'TreeController@generationLevel');
Route::get('/club', 'TreeController@clubWiseTeam');
Route::group(['prefix' => 'tree'], function () {
/*TREE Module*/
Route::get('/', 'TreeController@tree');
Route::get('/user/{user_key}', 'TreeController@treeChild');
Route::get('/binary-status', 'TreeController@binaryStatus');
});
});
Route::get('/user/get/pin/{package_id}', 'HomeController@GetMyPackagePin');
Route::get('/user/upgrade/package', 'AssociateModuleController@upgrade');
Route::post('/topUp', 'AssociateModuleController@topUp');
Route::post('/user/upgrade/package', 'HomeController@upgradePackage');
Route::get('/user/upgrade/history', 'HomeController@upgradePackageHistory');
Route::post('/user/generalDetails', 'HomeController@generalDetails');
Route::post('/user/bankDetails', 'HomeController@bankDetails');
Route::post('/user/transactionUpdate', 'HomeController@transactionUpdate');
Route::post('/user/password-update', 'HomeController@passwordUpdate');
Route::post('/user/update/basicinfo', 'HomeController@updateAddress');
Route::get('/binary', 'HomeController@binary');
/*Payment Module*/
/*Payment Module*/
Route::post('/changeProfile_photo', 'HomeController@changeProfile_photo');
Route::get('/wallet', 'HomeController@wallet');
// AdManagementController

// User routes Only

Route::group(['prefix'=>'pin'], function(){
Route::post('/', 'PinController@index');
Route::get('/', 'PinController@index');
Route::get('/list', 'PinController@list');
Route::get('/list/removemyPin/{pin_id}', 'PinController@RemoveAssignPin');
Route::get('/assign', 'PinController@assignPin');
Route::post('/assignPost', 'PinController@asignPinSave');
Route::get('/transfer', 'PinController@pinTransfer');
Route::get('/request', 'PinController@add');
Route::get('/request/record', 'PinController@pinrecord');
Route::post('/store', 'PinController@store');
});

Route::get('/amount/', 'DownPaymentController@index');
Route::get('/amount/add', 'DownPaymentController@add');
Route::get('/amount/record', 'DownPaymentController@index');
Route::post('/amount/store', 'DownPaymentController@store');


// User routes Only
/*******************************************************
payout
*******************************************/
Route::group(['prefix'=>'payout'], function(){
Route::get('/', 'PayoutController@index');
// Route::get('/binary', 'PayoutController@binary');
Route::get('/payments', 'PayoutController@myPayment');
Route::get('/payments/details', 'PayoutController@myPaymentDetails');
Route::get('/classified_payout', 'PayoutController@classified');
Route::get('/ads_payout', 'PayoutController@ads');
Route::get('/application', 'PayoutController@application');
Route::get('/level', 'PayoutController@level');
Route::get('/all_payout', 'PayoutController@payout');
Route::get('/direct', 'PayoutController@direct');
Route::get('/single-leg', 'PayoutController@singleLeg');
Route::get('/passbook', 'PayoutController@passbook');
Route::get('/redeemption', 'PayoutController@redeemption');
Route::get('/club', 'PayoutController@club');
Route::get('/club/details/{id}', 'PayoutController@clubDetails');
Route::get('/withdraw/{Revenue}', 'PayoutController@withdraw');
Route::get('/withdraw/request/history', 'PayoutController@withdrawHistory');
Route::get('/overview/business-overview', 'PayoutController@businessoverview');
Route::get('/overview/general-revenue', 'PayoutController@generalrevenue');



// Life time reward
Route::get('/life-time-reward', 'PayoutController@lifeTimeReward');
Route::get('/life-time-reward/details/{BAid}', 'PayoutController@lifeTimeRewardDetails');

// Cash Back
Route::get('/cash-back', 'PayoutController@cashback');
Route::get('/cash-back/referrals/{date}', 'PayoutController@cashbackReferrals');
Route::get('/cash-back/details/{date}', 'PayoutController@cahbackDetails');


});
Route::group(['prefix'=>'report'], function(){
Route::get('/tds', 'ReportController@tds');

// Property Saving
Route::get('/property-savings', 'ReportController@propertySavings');

Route::get('/dispatch', 'ReportController@dispatchreport');

});

Route::get('/leads','HomeController@LeadsList');

// Route::get('/reference','ReferenceLeadController@index');
// Route::get('/reference/add','ReferenceLeadController@create');
// Route::get('/reference/edit/{id}','ReferenceLeadController@edit');
// Route::POST('/reference/create','ReferenceLeadController@store');
// Route::POST('/reference/update','ReferenceLeadController@update');

Route::get('/follow-up-leads','FollowupLeadController@index');
Route::get('/follow-up-leads/add','FollowupLeadController@create');
Route::get('/follow-up-leads/edit/{id}','FollowupLeadController@edit');
Route::POST('/follow-up-leads/create','FollowupLeadController@store');
Route::POST('/follow-up-leads/update','FollowupLeadController@update');


Route::get('/visit-leads','VisitLeadController@index');
Route::get('/visit-leads/add','VisitLeadController@create');
Route::get('/visit-leads/edit/{id}','VisitLeadController@edit');
Route::POST('/visit-leads/create','VisitLeadController@store');
Route::POST('/visit-leads/update','VisitLeadController@update');

Route::get('/digital-leads','DigitalLeadController@index');
Route::get('/digital-leads/add','DigitalLeadController@create');
Route::get('/digital-leads/edit/{id}','DigitalLeadController@edit');
Route::POST('/digital-leads/create','DigitalLeadController@store');
Route::POST('/digital-leads/update','DigitalLeadController@update');

Route::get('/seminar-leads','SeminarLeadController@index');
Route::get('/seminar-leads/add','SeminarLeadController@create');
Route::get('/seminar-leads/edit/{id}','SeminarLeadController@edit');
Route::POST('/seminar-leads/create','SeminarLeadController@store');
Route::POST('/seminar-leads/update','SeminarLeadController@update');

Route::get('/registry-form/{id}','RegistryFormController@create');
Route::POST('/registry-form/create','RegistryFormController@store');
Route::get('/registry-form/filled/{id}','RegistryFormController@filled');
Route::get('/registry-form/edit/{id}','RegistryFormController@edit');
Route::POST('/registry-form/update','RegistryFormController@update');





Route::get('/property/self','PropertyController@self');




Route::group(['prefix'=>'member'], function(){
Route::get('/', 'AssociateModuleController@index');
Route::get('/invoicepending', 'AssociateModuleController@invoicepending');
Route::get('/topup-pending', 'AssociateModuleController@topuppending');
Route::get('/add-new', 'AssociateModuleController@addNew');
Route::post('/add-new/save', 'AssociateModuleController@addNewSave');
Route::get('/downline', 'AssociateModuleController@downline');
// Route::get('/downline/paid/left', 'AssociateModuleController@downlinePaidLeft');
// Route::get('/downline/paid/right', 'AssociateModuleController@downlinePaidRight');
Route::get('/blocked-member', 'AssociateModuleController@blockedmember');
Route::get('/tagachievers', 'AssociateModuleController@tagachievers');
Route::get('/direct', 'AssociateModuleController@direct');
Route::get('/my-team', 'TreeController@MyTeam');
Route::get('/profile', 'HomeController@myProfile');
Route::post('/upload/singed-invoice', 'HomeController@uploadSingedInvoice');
Route::post('/profile/update/password', 'HomeController@updatePassword');
Route::post('/invoice', 'HomeController@invoice');
Route::get('/welcome-letter', 'HomeController@welcomeLetter');

Route::get('/level', 'AssociateModuleController@level');

Route::get('/invoice-status/left/{id?}', 'AssociateModuleController@invoiceStatusLeft');
Route::get('/invoice-status/right/{id?}', 'AssociateModuleController@invoiceStatusRight');
});
/*******************************************************
payout
*******************************************/
/*************************************************user Routes******************************/


Route::post('/user-parent-details', 'AssociateModuleController@checkParent');

/*Admin Routes*/
Route::prefix('admin')
    ->group(base_path('routes/admin.php'));


/*Admin Routes*/


// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
// Route::post('previewPage', 'Auth\RegisterController@previewPage');
// Password Reset Routes...



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
