<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
		Route::get('/checkGroupWiseIncome/{user_key}', 'Admin\AdminController@checkGroupWiseIncome');
		Route::resource('teams', 'Admin\TeamController');
		route::get('/getmessage','Admin\AdminController@getAllMessage');
		route::get('/getmessage/{id}','Admin\AdminController@getSingleMessage');

		Route::group(['prefix' => 'support'], function () {
		/*Support*/
		Route::get('/{status}', 'Admin\SupportController@index');
		Route::get('/{id}/{status}', 'Admin\SupportController@ChangeStatus');
		/*Support Module*/
		});

		route::get('/change-password','Admin\AdminController@changPassword');
		route::post('/update-password','Admin\AdminController@updatePassword');
		route::post('/update-transaction-password','Admin\AdminController@updateTXPassword');
		route::get('/user/notifications/', 'Admin\AdminController@userNotification');
		route::post('/user/notifications-push/', 'Admin\AdminController@userNotificationPush');
		route::get('/user/notification/remove/{id}', 'Admin\AdminController@userNotificationRemove');

		route::get('/queries/', 'Admin\QueriesController@index');
		route::get('/queries/{status}', 'Admin\QueriesController@index');
		route::get('/queries/status/{query_id}/{status}','Admin\QueriesController@changeStatus');
		route::get('/queries/delete/{query_id}/','Admin\QueriesController@destroy');


		Route::group(['prefix' => 'dashboard-images'], function () {
		route::get('/','Admin\DashboardImageController@add');
		route::get('/view','Admin\DashboardImageController@view');
		route::post('/submit','Admin\DashboardImageController@create');
		route::get('/delete/{id}','Admin\DashboardImageController@delete');
		route::get('/status/{id}/{status}','Admin\DashboardImageController@changeStatus');
	});


		
		Route::group(['prefix' => 'download'], function () {
		route::get('/','Admin\Download\DownloadController@add');
		route::get('/view','Admin\Download\DownloadController@view');
		route::post('/submit','Admin\Download\DownloadController@create');
		route::get('/delete/{id}','Admin\Download\DownloadController@delete');
		route::get('/status/{id}/{status}','Admin\Download\DownloadController@changeStatus');
	});


		


		Route::group(['prefix' => 'videos'], function () {
		route::get('/','Admin\VideoController@add');
		route::get('/view','Admin\VideoController@view');
		route::post('/submit','Admin\VideoController@create');
		route::get('/delete/{id}','Admin\VideoController@delete');
		route::get('/status/{id}/{status}','Admin\VideoController@changeStatus');
	});



		route::get('/user/invoice/{id}', 'Admin\PayoutController@userInvoice');
		route::get('/user/wallet/{id}', 'Admin\PayoutController@userWallet');
		route::post('/user/update-wallet', 'Admin\PayoutController@userWalletUpdate');
		route::get('/user/pins/{user_key}', 'Admin\UserController@pins');
		route::get('/user/direct/{user_key}', 'Admin\UserController@direct');
		route::get('/user/downline/{user_key}Admin\Classified\ClassifiedController', 'Admin\UserController@downline');
		/*payout*/

		route::post('/manualPermission', 'Admin\AdminController@PayUserManualPermission');
		route::get('/payment', 'Admin\PayoutController@payment');
		route::get('/pay/user/amount/{user_key}/{user_id}/{amount}/{earning}/{id}', 'Admin\PayoutController@PayUserAmount');
		route::get('/pay/user/amountold/{user_key}/{user_id}/{total}', 'Admin\PayoutController@PayUserAmountold');
		
		route::get('/user/amount/status/{user_key}/{user_id}/{amount}/{id}/{status}', 'Admin\PayoutController@UserPaymentStatus');
		route::get('/user-payment', 'Admin\PayoutController@userPayment');
		route::get('/user-payment/pending-kyc', 'Admin\PayoutController@userPaymentPendingKyc');
		route::get('/user-old-payment', 'Admin\PayoutController@useroldPayment');
		route::get('/user-diff-payment', 'Admin\PayoutController@userdiffPayment');
		route::get('/payment/release', 'Admin\PayoutController@paymentRelease');
		route::get('/payment/release/forBank', 'Admin\PayoutController@paymentReleaseForBank');
		route::get('/payment/stop', 'Admin\PayoutController@paymentStop');
		route::get('/payment/release/history', 'Admin\PayoutController@paymentReleaseHistory');
		route::get('/payment-release-history-data/{date}', 'Admin\PayoutController@paymentReleaseHistoryByDate');
		route::post('/payment-release-history-data/changeStatus', 'Admin\PayoutController@paymentReleaseHistoryChangeStatus');
		/*payout*/
		/*turnover*/
		Route::get('/turnover', 'Admin\TurnoverController@index');
		Route::get('/achievers/{month}/{year}/{amount}/payout', 'Admin\TurnoverController@distributions');
		Route::get('/achievers/turnoverPayOut/{month}/{year}/{amount}', 'Admin\TurnoverController@doPayout');
		Route::post('/turnover/store', 'Admin\TurnoverController@store');
		/*turnover*/

		

		

		

		

		//package
		route::resource('package','Admin\Package\PackageController');
		route::get('package/status/{package_id}/{status}','Admin\Package\PackageController@changeStatus');
		route::get('package/edit/{package_id}/','Admin\Package\PackageController@edit');
		route::post('package/update','Admin\Package\PackageController@update');
		route::post('charges/update','Admin\Package\PackageController@chargesupdate');
		route::post('levelPercentage/update','Admin\Package\PackageController@levelPercentageupdate');
		route::post('levelLimitPercentage/update','Admin\Package\PackageController@levelLimitPercentageupdate');

		route::get('p/description','Admin\AdminController@package_desc');
		route::get('p/description/add','Admin\AdminController@package_desc_add');
		route::post('p/description/store','Admin\AdminController@package_desc_store');
		route::get('p/description/edit/{id}','Admin\AdminController@package_desc_edit');
		route::post('p/description/update','Admin\AdminController@package_desc_update');
		//package
		/*Basic Routes For Admin*/
		Route::get('/home', 'Admin\AdminController@index');
		Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
		
		Route::get('/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm');
		Route::post('/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail');
		Route::post('/password/reset', 'Admin\ResetPasswordController@reset');
		Route::get('/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm');

		Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		
		Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
		
		Route::post('/logout', 'Admin\AdminController@logout')->name('admin.logout');
		
		/*Basic Routes For Admin*/
		
		/*main Routes*/
		Route::group(['prefix' => 'content-manager'], function () {
		Route::get('/seminar', 'Admin\ContentManagerController@seminar');
		Route::get('/seminar/add', 'Admin\ContentManagerController@addSeminar');
		Route::post('/seminar/save', 'Admin\ContentManagerController@saveSeminar');
		Route::get('/seminar/status/{status}/{seminar_id}', 'Admin\ContentManagerController@seminarStatus');
		Route::get('/seminar/remove/{seminar_id}', 'Admin\ContentManagerController@seminarRemove');
		Route::get('/documents/', 'Admin\ContentManagerController@documents')->middleware('auth:admin');
		Route::post('/documents/upload', 'Admin\ContentManagerController@documentsStore')->middleware('auth:admin');
		Route::post('/documents/remove', 'Admin\ContentManagerController@documentsRemove')->middleware('auth:admin');
		Route::get('/documents/DownloadAttachment/{id}', 'Admin\ContentManagerController@DownloadAttachment')->middleware('auth:admin');
		// dispatch-entry
		Route::get('/dispatch-entry/{user_key}', 'Admin\ContentManagerController@dispatchEntry')->middleware('auth:admin');
		Route::get('/dispatch-entry/', 'Admin\ContentManagerController@dispatchEntry')->middleware('auth:admin');
		Route::get('/dispatch-entry/create', 'Admin\ContentManagerController@dispatchCreate')->middleware('auth:admin');
		Route::post('/dispatchStore/', 'Admin\ContentManagerController@dispatchStore');
		Route::get('/dispatch-remove/{id}', 'Admin\ContentManagerController@dispatchRemove')->middleware('auth:admin');
		route::resource('testimonial','Admin\Testimonial\TestimonialController');
		route::resource('gallery/image','Admin\Gallery\ImageController');
		route::resource('gallery/video','Admin\Gallery\VideoController');
		});



		Route::group(['prefix' => 'pin'], function () {
		/*Pin Module*/
		Route::get('/', 'Admin\PinController@index');
		Route::get('/package-1', 'Admin\PinController@Package1');
		Route::get('/package-2', 'Admin\PinController@Package2');
		Route::get('/package-3', 'Admin\PinController@Package3');
		Route::post('/searchFilter', 'Admin\PinController@searchFilter');
		Route::get('/searchFilter', 'Admin\PinController@searchFilterAlt');
		Route::get('/add', 'Admin\PinController@add');
		Route::get('/request', 'Admin\PinController@request');
		Route::get('/request/accepted', 'Admin\PinController@requestAccepted');
		Route::get('/request/details/{pin_id}', 'Admin\PinController@requestDetails');
		Route::get('/request/status-change/{pin_id}/{status}', 'Admin\PinController@requestStatus');
		Route::post('/store', 'Admin\PinController@store');
		Route::get('/assign', 'Admin\PinController@asign');
		Route::post('/assign', 'Admin\PinController@asignPinSave');
		Route::get('/status', 'Admin\PinController@statusPin');
		Route::get('/remove/status-pins/{status_code}', 'Admin\PinController@removePinsByStatus');
		Route::get('/block/{pin_id}/{status}', 'Admin\PinController@blockPin');
		Route::get('/remove/{pin_id}', 'Admin\PinController@removePin');
		/*Pin Module*/
		});
		Route::group(['prefix' => 'report'], function () {
		/*Pin Module*/
		Route::get('/sale', 'Admin\ReportController@sale');
		Route::get('/tds', 'Admin\ReportController@tds');
		Route::get('tds/{year}', 'Admin\ReportController@tds_year');
		Route::get('tds/{year}/{month}', 'Admin\ReportController@tds_month');
		Route::get('/income-report', 'Admin\ReportController@store');
		Route::get('/payouts', 'Admin\ReportController@payouts');
		Route::get('/payments', 'Admin\ReportController@payments');
		/*Pin Module*/
		});
		Route::group(['prefix' => 'associate'], function () {
		/*Pin Module*/
		Route::get('/tree', 'Admin\AssociateController@tree');
		Route::get('/tree/user/{user_key}', 'Admin\AssociateController@treeChild');
		Route::get('/add-new/', 'Admin\AssociateController@addNew');
		
		/*Pin Module*/
		});
		Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'Admin\UserController@index');
		Route::get('/1', 'Admin\UserController@active');
		Route::get('/list', 'Admin\UserController@userList');
		Route::get('/list/search/{package_id}', 'Admin\UserController@userListSearch');
		Route::get('/package-1', 'Admin\UserController@Package1');
		Route::get('/package-2', 'Admin\UserController@Package2');
		Route::get('/package-3', 'Admin\UserController@Package3');
		
		Route::get('/all-package/{user_key}', 'Admin\UserController@AllPackages');

		Route::get('/latestPayout', 'Admin\UserController@latestPayout');
		Route::get('/businessActivityPayout/{user_key}', 'Admin\UserController@businessActivityPayout');
		Route::get('/activity-payout/{user_key}', 'Admin\UserController@PayoutActivity');
		Route::get('/edit/{user_id}', 'Admin\UserController@userEdit');
		Route::post('/changeProfile_photo', 'Admin\UserController@changeProfile_photo');
		Route::post('/upgrade/package', 'Admin\UserController@upgradePackage');
		Route::post('/generalDetails', 'Admin\UserController@generalDetails');
		Route::post('/bankDetails', 'Admin\UserController@bankDetails');
		Route::post('/transactionUpdate', 'Admin\UserController@transactionUpdate');
		Route::post('/password-update', 'Admin\UserController@updatePassword');
		Route::post('/update/basicinfo', 'Admin\UserController@updateAddress');
		Route::get('/documents/{user_id}', 'Admin\UserController@userDocuments');
		Route::get('/banned/{user_id}/{status}', 'Admin\UserController@userBanned');
		Route::get('/banned', 'Admin\UserController@getUserBanned');
		Route::get('/approve-kyc/', 'Admin\UserController@approveKYC');
		Route::get('/approve-kyc/{status}', 'Admin\UserController@approveKYC');
		Route::get('/approve-invoice', 'Admin\UserController@approveInvoice');
		Route::get('/approve-invoice/{status}', 'Admin\UserController@approveInvoice');
		Route::get('/approve-bank-kyc/', 'Admin\UserController@approveBankKyc');
		Route::get('/approve-bank-kyc/{status}', 'Admin\UserController@approveBankKyc');
		
		Route::get('/ROI-user-list', 'Admin\UserController@CashBackUserList');
		Route::get('/ROI-user-list/details', 'Admin\UserController@CashBackUserListDetails');
		Route::get('/ROI-user-list/{user_key}', 'Admin\UserController@getUserUpperLevel');
		Route::get('/ROI-user-list-save', 'Admin\UserController@CashBackUserSave');


		Route::get('/bank-update-log/{user_key}/{user_id}', 'Admin\UserController@getUserBankUpdateHistories');
		Route::get('/documents/status/{status}/{user_id}/{document_id}', 'Admin\UserController@DocumentStatus');
		Route::get('/signed_invoice/status/{user_id}/{status}', 'Admin\UserController@SignedInvoiceStatus');
		Route::get('/pan-status/{user_id}/{status}', 'Admin\UserController@panStatus');
		Route::get('/aadhar-status/{user_id}/{status}', 'Admin\UserController@aadharStatus');
		Route::get('/approvedKYC/{user_id}/{status}', 'Admin\UserController@approvedKYC');
		Route::get('/bank-kyc-status/{user_id}/{status}', 'Admin\UserController@bankKYCStatus');


		// lifetime reward achievers

		Route::get('/achiever/lifetime-reward', 'Admin\UserController@lifeTimeAchievers');
		Route::get('/achiever/lifetime-reward/users/{achievement_id}', 'Admin\UserController@lifeTimeAchieversUsers');
		Route::get('/achiever/lifetime-reward/users/{user_key}/payment/{achievement_id}', 'Admin\UserController@lifeTimeAchieversUsersPayout');

		// lifetime reward achievers

		// cash back achievers

		Route::get('/achiever/ROI', 'Admin\UserController@cashBackAchievers');

		// cash back achievers
		
		// Route::get('/reference-leads/', 'Admin\UserController@ReferenceLeadsAll');
		// Route::get('/reference-leads/{user_key}', 'Admin\UserController@ReferenceLeadsByUsers');
		// Route::get('/reference-leads/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@ReferenceLeadsChangeStatus');
		// Route::post('/reference-leads/reject', 'Admin\UserController@rejectRefLead');
		
		Route::get('/downpayment/list', 'Admin\UserController@downPaymentUsers');
		Route::get('/downpayment/list/{user_key}', 'Admin\UserController@downPaymentUsersDetails');
		Route::get('/downpayment/list/{user_key}/status/{status}', 'Admin\UserController@downPaymentUsersDetailsStatus');

		Route::get('/property-allotment/{user_key}', 'Admin\UserController@propertyAllotment');
		Route::post('/property-allotment/store', 'Admin\UserController@propertyAllotmentCreate');
		Route::get('/property-allotment/user_key/{user_key}', 'Admin\UserController@propertyAllotmentList');



		Route::get('/all-leads/', 'Admin\UserController@AllLeads');

		Route::get('/follow-up-leads/', 'Admin\UserController@FollowUpLeadsAll');
		Route::get('/follow-up-leads/{user_key}', 'Admin\UserController@FollowUpByUsers');
		Route::get('/follow-up-leads/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@FollowUpChangeStatus');
		Route::post('/follow-up-leads/reject', 'Admin\UserController@rejectFollowupLead');

		Route::get('/seminar-leads/', 'Admin\UserController@SeminarLeadsAll');
		Route::get('/seminar-leads/{user_key}', 'Admin\UserController@SeminarByUsers');
		Route::get('/seminar-leads/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@SeminarChangeStatus');
		Route::post('/seminar-leads/reject', 'Admin\UserController@rejectSeminarLead');


		Route::get('/visit-leads/', 'Admin\UserController@VisitLeadsAll');
		Route::get('/visit-leads/{user_key}', 'Admin\UserController@VisitLeadsByUsers');
		Route::get('/visit-leads/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@VisitLeadsChangeStatus');
		Route::post('/visit-leads/reject', 'Admin\UserController@rejectVisitLead');

		Route::get('/digital-leads/', 'Admin\UserController@DigitalLeadsAll');
		Route::get('/digital-leads/{user_key}', 'Admin\UserController@DigitalLeadsByUsers');
		Route::get('/digital-leads/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@DigitalLeadsChangeStatus');
		Route::post('/digital-leads/reject', 'Admin\UserController@rejectDigitalLead');

		

		Route::get('/registry-forms/', 'Admin\UserController@registryFormsAll');
		Route::get('/registry-forms/{user_key}', 'Admin\UserController@registryFormsByUsers');
		Route::get('/registry-forms/{user_key}/{reference_lead_id}/{status}', 'Admin\UserController@registryFormsChangeStatus');
		Route::post('/registry-forms/reject', 'Admin\UserController@registryFormsReject');
		Route::post('/registry-forms/accept', 'Admin\UserController@registryFormsAccept');
		route::get('registry-forms/edit/{id}/','Admin\UserController@registryFormsedit');
		route::post('registry-forms/update','Admin\UserController@registryFormsupdate');

			

		});
		Route::group(['prefix' => 'testimonials'], function () {
				Route::get('/', 'Admin\TestimonialController@index');
				Route::get('/add', 'Admin\TestimonialController@create');
				Route::post('/save', 'Admin\TestimonialController@store');
				Route::get('/edit/{id}', 'Admin\TestimonialController@edit');
				Route::post('/update', 'Admin\TestimonialController@update');
				Route::get('/status/{id}/{status}', 'Admin\TestimonialController@changeStatus');
			});


		Route::get('/dispatch-entry/', 'Admin\ContentManagerController@dispatchEntry')->middleware('auth');
		Route::get('/seminar', 'Admin\ContentManagerController@seminar');
		Route::get('/seminar/add', 'Admin\ContentManagerController@addSeminar');
		Route::post('/seminar/save', 'Admin\ContentManagerController@saveSeminar');
		Route::post('/seminar/save', 'Admin\ContentManagerController@saveSeminar');
		Route::get('/documents/', 'Admin\ContentManagerController@documents')->middleware('auth');
		Route::get('/documents/DownloadAttachment/{id}', 'Admin\ContentManagerController@DownloadAttachment')->middleware('auth');


		Route::Resource('banking','Admin\BankingController');


		Route::get('/distributions', 'Admin\TurnoverController@distributions');
		Route::get('/distributions/details/{activity_id}', 'Admin\TurnoverController@distributionsDetails');


		Route::group(['prefix' => 'roles'], function () {
				Route::get('/', 'Admin\RolesController@AddUser');
				Route::post('/AddUser', 'Admin\RolesController@AddUserStore');
				Route::post('/assign', 'Admin\RolesController@assignRole');
				Route::get('/edit/{id}', 'Admin\RolesController@edit');
				Route::post('/update', 'Admin\RolesController@update');
				Route::get('/status/{id}/{status}', 'Admin\RolesController@changeStatus');
			});