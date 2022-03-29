<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
 |-----------------------------------
 | Index
 |--------- -------------------------
 */

Route::get('/', 'HomeController@index');
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/about', 'AboutController@index');
Route::get('/license', 'LicenseController@index');
Route::get('/use-guide', 'UseGuideController@index');
Route::get('/imprint', 'ImprintController@index');
Route::get('/privacy-policy', 'PrivacyPolicyController@index');
Route::get('/terms-of-service', 'TermsController@index');
Route::get('/faq', 'FaqController@index');
Route::get('/faq-list/{categoryId}', 'FaqController@faqList');
Route::get('/faq-details/{questionId}', 'FaqController@faqDetails');

Route::get('/destinations', 'DestinationsController@index');
Route::get('destinations/{citySlug}', 'DestinationsController@cityDestinations');
Route::get('destinations/{citySlug}/route/{routeSlug}', 'DestinationsController@routeDestinations');
Route::get('destinations/forms/suggest-a-city/', 'DestinationsController@suggestACity');
Route::post('destinations/request-suggest-city/', 'DestinationsController@requestSuggestCity');
Route::get('destinations/thankyou/suggest/', 'DestinationsController@thankyouSuggest');
Route::get('get-cities-by-country-id/{id}', 'DestinationsController@getCityByCountryId');
Route::post('search-destinations/', 'DestinationsController@searchDestination');

Route::get('get-artist-by-city-photo-shoot/{id}/{photoShootId}', 'BookingController@getArtistByCityIdPhotoShoot');
Route::get('get-artist-by-city/{id}', 'BookingController@getArtistByCityId');
Route::get('get-cities-by-country/{id}', 'Auth\RegisterController@getCityByCountryId');
Route::get('get-route-by-city/{id}', 'Auth\RegisterController@getRouteByCityId');

Route::get('get-time-day', 'BookingController@getTimeDate');
Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('get-category', 'HomeController@getAllCategory');

Route::get('get-type', 'HomeController@getAllType');


Route::get('forget_password', 'Auth\ForgotPasswordController@forgotPassword');
Route::post('/password/emails', 'Auth\ForgotPasswordController@forgotPasswordProcess');
Route::get('password/resets/{token}', 'Auth\ForgotPasswordController@resetPassword');
Route::post('password/resets', 'Auth\ForgotPasswordController@resetPasswordProcess');
Route::get('check-email-address/{email}', 'Auth\ForgotPasswordController@checkEmailAddress');


/*
 |-----------------------------------
 | Images Sections
 |--------- -------------------------
 */
Route::get('latest', 'HomeController@latest');
Route::get('featured', 'HomeController@featured');
Route::get('popular', 'HomeController@popular');
Route::get('most/commented', 'HomeController@commented');
Route::get('most/viewed', 'HomeController@viewed');
Route::get('most/downloads', 'HomeController@downloads');
Route::get('photos/premium', 'HomeController@premium');

/*
 |-----------------------------------
 | Authentication
 |--------- -------------------------
 */
Route::auth();

/*
 |-----------------------------------
 | Social Login
 |--------- -------------------------
 */
Route::group(['middleware' => 'guest'], function () {
    Route::get('oauth/{provider}', 'SocialAuthController@redirect')->where('provider', '(facebook|google|twitter)$');
    Route::get('oauth/{provider}/callback', 'SocialAuthController@callback')->where('provider', '(facebook|google|twitter)$');
});//<--- End Group guest

/*
 |
 |-----------------------------------
 | Default Sections
 |--------- -------------------------
 */

// Members
Route::get('members', function () {

    $data = App\Models\Query::users();

    return view('default.members')->with($data);
});

// Categories
Route::get('categories', function () {

    $data = App\Models\Categories::where('mode', 'on')->where('parent_id', '=', '0')->orderBy('name')->get();

    return view('default.categories')->withData($data);
});

// FAQ Category
Route::get('faq-categories', function () {

    $data = App\Models\FaqCategories::where('mode', 'on')->orderBy('name')->get();

    return view('default.faq_categories')->withData($data);
});

//<---- Categories List
Route::get('category/{slug}', 'HomeController@category');
Route::get('sub-category/{slug}', 'HomeController@subCategory');
Route::get('sub-category-music/{slug}', 'HomeController@subMusicCategory');

Route::get('getLimitImagesByUserId/{idUser}', 'HomeController@getLimitImagesByUserId');
Route::get('getLimitVideosByUserId/{idUser}', 'HomeController@getLimitVideosByUserId');
// Route::get('getLimitAnimationsByUserId/{idUser}', 'HomeController@getLimitAnimationsByUserId');

Route::get('get-image-by-category/{slug}', 'HomeController@categoryImages'); //rick

// Tags
Route::get('tags', function () {

    $data = App\Models\Images::select(DB::raw('GROUP_CONCAT(tags SEPARATOR ",") as tags'))->where('status', 'active')->get();

    return view('default.tags')->withData($data);
});

Route::get('tags/{tags}', 'HomeController@tags');

// Collections
Route::get('collections', 'HomeController@collections');

// Collections Detail
Route::get('{user}/collection/{id}/{slug?}', 'UserController@collectionDetail');

// Cameras
Route::get('cameras/{cameras}', 'HomeController@cameras');

// Colors
Route::get('colors/{colors}', 'HomeController@colors');

// Search
// Route::get('search', 'HomeController@getSearch'); // old Search Page

Route::get('search', 'HomeController@getSearchNew');

//Artist Search on Categories option on header by Profession
Route::post('search-artist', 'HomeController@searchArtist');

//Image|Video|Music|Animation Search on Categories option on header by Indust
Route::post('search-by-industry', 'HomeController@searchByIndustry');

Route::post('sub-category/search-by-industry', 'HomeController@searchBySubCategoryIndustry');
Route::post('sub-category-music/search-by-industry', 'HomeController@searchMusicBySubCategoryIndustry');

Route::get('get-stockdata/{id}', 'HomeController@stockData');

// Photo Details
Route::get('photo/{id}/{slug?}', 'ImagesController@show');

// Video Details
Route::get('video/{id}/{slug?}', 'ImagesController@showVideo');

//Audio/Music Page
Route::get('music', 'AudioController@index');

// Logout
Route::get('/logout', 'Auth\LoginController@logout');

/*
 |
 |-----------------------------------
 | Verify Account
 |--------- -------------------------
 */
Route::get('verify/account/{confirmation_code}', 'HomeController@getVerifyAccount')->where('confirmation_code', '[A-Za-z0-9]+');

/*
 |
 |------------------------
 | Pages Static Custom
 |--------- --------------
 */
Route::get('page/{page}', 'PagesController@show')->where('page', '[^/]*');

/*
|
|----------------------------
| Sitemaps
|--------- ------------------
*/
Route::get('sitemaps.xml', function () {
    return response()->view('default.sitemaps')->header('Content-Type', 'application/xml');
});

/*
 |
 |-----------------------------------
 | Ajax Request
 |--------- -------------------------
 */
Route::post('ajax/like', 'AjaxController@like');
Route::post('ajax/follow', 'AjaxController@follow');
Route::get('ajax/notifications', 'AjaxController@notifications');
Route::get('ajax/users', 'AjaxController@users');
Route::get('ajax/search', 'AjaxController@search');
Route::get('ajax/latest', 'AjaxController@latest');
Route::get('ajax/featured', 'AjaxController@featured');
Route::get('ajax/popular', 'AjaxController@popular');
Route::get('ajax/commented', 'AjaxController@commented');
Route::get('ajax/viewed', 'AjaxController@viewed');
Route::get('ajax/downloads', 'AjaxController@downloads');
Route::get('ajax/category', 'AjaxController@category');
Route::get('ajax/tags', 'AjaxController@tags');
Route::get('ajax/cameras', 'AjaxController@camera');
Route::get('ajax/colors', 'AjaxController@colors');
Route::get('ajax/user/images', 'AjaxController@userImages');
Route::get('ajax/comments', 'AjaxController@comments');
Route::get('ajax/premium', 'AjaxController@premium');


/*
 |
 |-----------------------------------
 | User Views LOGGED
 |--------- -------------------------
 */

Route::get('/get-users-by-city-route/{cityslug}/{cityroute}', 'DestinationsController@getUsersByCityRoute');
Route::get('/get-users-by-cate/{categorslug}', 'HomeController@getUsersByCategory');
Route::get('/get-subCat-by-category/{slug}', 'HomeController@getSubCategoryByCategory');

Route::group(['middleware' => 'auth'], function () {
    Route::get('request-to-book', 'BookingController@requestToBook');
    Route::match(array('GET', 'POST'), 'request-to-book/step-one', 'BookingController@requestToBookStepOne');
    Route::match(array('GET', 'POST'), 'request-to-book/step-two', 'BookingController@requestToBookStepTwo');
    Route::match(array('GET', 'POST'), 'request-to-book/step-three', 'BookingController@requestToBookStepThree');
    Route::post('request-to-book/complete', 'BookingController@requestToBookComplete');


    //<---- Upload
    Route::get('upload/image', function () {

        if (Auth::user()->authorized_to_upload == 'yes') {
            return view('images.upload');
        } else {
            return redirect('/');
        }

    });

    Route::get('upload/video', function () {

        if (Auth::user()->authorized_to_upload == 'yes') {
            return view('images.upload_video');
        } else {
            return redirect('/');
        }

    });

    Route::get('upload/audio', function () {

        if (Auth::user()->authorized_to_upload == 'yes') {
            return view('images.upload_audio');
        } else {
            return redirect('/');
        }

    });


    Route::get('artist/{id}', 'UserController@artist');
    Route::get('get-calendar-data', 'UserController@calendarData');
    //Hiring Module Routes end

    // Edit Photo
    Route::get('edit/photo/{id}', 'ImagesController@edit');
    Route::post('update/photo', 'ImagesController@update');

    // Delete Photo 6
    Route::post('delete/photo/{id}', 'ImagesController@destroy');

    // Account Settings
    Route::get('account', 'UserController@account');
    Route::post('account', 'UserController@update_account');

    // Password
    Route::get('account/password', 'UserController@password');
    Route::post('account/password', 'UserController@update_password');

    // Delete Account
    Route::get('account/delete', 'UserController@delete');
    Route::post('account/delete', 'UserController@delete_account');

    // Upload Avatar
    Route::post('upload/avatar', 'UserController@upload_avatar');

    //Add Personal Website
    Route::post('add/personal', 'UserController@personal_website');

    // Upload Cover
    Route::post('upload/cover', 'UserController@upload_cover');

    // Likes
    Route::get('likes', 'UserController@userLikes');

    // Feed
    Route::get('feed', 'UserController@followingFeed');

    // Photos Pending
    Route::get('photos/pending', 'UserController@photosPending');

    // Notifications
    Route::get('notifications', 'UserController@notifications');
    Route::get('notifications/delete', 'UserController@notificationsDelete');

    // Route::post('upload','ImagesController@create');
    Route::post('upload/image', 'ImagesController@imageUpload');

    Route::post('upload/video', 'ImagesController@videoUpload');

    Route::post('upload/audio', 'ImagesController@audioUpload');

    // Report Photo
    Route::post('report/photo', 'ImagesController@report');

    // Report User
    Route::post('report/user', 'UserController@report');

    // Collections
    Route::post('collection/store', 'CollectionController@store');

    // Collection Edit
    Route::post('collection/edit', 'CollectionController@edit');

    // Collectin Delete
    Route::get('collection/delete/{id}', 'CollectionController@destroy');

    // Add Image to Collection
    Route::get('collection/{id}/i/{image}', 'CollectionController@addImageCollection')->where(array('id' => '[0-9]+', 'image' => '[0-9]+'));

    // Comments
    Route::post('comment/store', 'CommentsController@store');

    // Comments Delete
    Route::post('comment/delete', 'CommentsController@destroy');

    // Comment Like
    Route::post('comment/like', 'CommentsController@like');

    //======= DASHBOARD ================//
    // Dashboard
    Route::get('user/dashboard', 'DashboardController@dashboard');

    // My Shoots
    Route::get('user/dashboard/my-shoots', 'DashboardController@myShoots');
    Route::get('user/dashboard/my-shoots-details/{id}', 'DashboardController@myShootsDetails');
    Route::get('user/dashboard/review/{id}', 'DashboardController@review');
    Route::get('user/dashboard/view-review/{id}', 'DashboardController@viewReview');
    Route::post('user/dashboard/process-review', 'DashboardController@reviewProcess');

    //Custom Checkout
    Route::get('user/dashboard/checkout/{refNo}', 'DashboardController@customCheckOut');
    Route::post('user/dashboard/checkout-payment-proccess', 'DashboardController@customCheckOutProccess');

    //Customer Files Uploaded By Artist
    Route::post('user/dashboard/upload-file-customer', 'DashboardController@uploadFileCustomer');
    Route::get('user/dashboard/download_all_files/{referenceNo}', 'DashboardController@downloadAllFiles');
    Route::get('user/dashboard/view_all_files/{referenceNo}', 'DashboardController@viewAllFiles');
    //Customer Approve or Reject
    Route::post('user/dashboard/update-customer-action', 'DashboardController@updateCustomerAction');
    //Artist Payment Request
    Route::post('user/dashboard/artist-payment-request', 'DashboardController@artistPaymentRequest');


    Route::post('get-artist-customer-details', 'DashboardController@getDetailsArtistCustomer');

    //Chat
    Route::get('chats', 'ChatController@getChats');
    Route::post('chat', 'ChatController@startChat');
    Route::get('chat/{chatId}/detail', 'ChatController@getChat');
    Route::get('chat/{chatId}', 'ChatController@getMessages');
    Route::post('chat/{chatId}/message', 'ChatController@sendMessage');

    Route::get('get-chat-list/{userId}', 'DashboardController@getChatList');
    Route::get('get-single-chat-details/{chatId}', 'DashboardController@getSingleChatDetails');
    Route::post('send-text-msg', 'DashboardController@sendTextMsg');
    Route::post('send-image-file-msg', 'DashboardController@sendImageFileMsg');

    Route::get('get-unread-messages/{uId}', 'DashboardController@getUnreadMsg');
    Route::get('update-unread-message/{chatId}/{uId}', 'DashboardController@updateUnreadMsg');

    Route::get('delete-chat/{chatId}/{userId}', 'DashboardController@deleteChat');


    // My Bookings
    Route::get('user/dashboard/my-bookings', 'DashboardController@myBookings');
    Route::get('user/dashboard/my-bookings-details/{id}', 'DashboardController@myBookingsDetails');

    Route::post('user/dashboard/update-booking-request-status', 'DashboardController@updateBookingRequestStatus');

    //Photographer Package
    Route::get('user/dashboard/packages/photographer-package', 'DashboardController@photographerPackage');
    Route::get('user/dashboard/packages/photographer-package/add', 'DashboardController@photographerAddPackage');
    Route::post('user/dashboard/packages/photographer-package/add', 'DashboardController@photographerStorePackage');
    Route::get('user/dashboard/packages/photographer-package/edit/{id}', 'DashboardController@photographerEditPackage');
    Route::post('user/dashboard/packages/photographer-package/update', 'DashboardController@photographerUpdatePackage');
    Route::get('user/dashboard/packages/photographer-package/delete/{id}', 'DashboardController@photographerDeletePackage');
    //Videographer Package
    Route::get('user/dashboard/packages/videographer-package', 'DashboardController@videographerPackage');
    Route::get('user/dashboard/packages/videographer-package/add', 'DashboardController@videographerAddPackage');
    Route::post('user/dashboard/packages/videographer-package/add', 'DashboardController@videographerStorePackage');
    Route::get('user/dashboard/packages/videographer-package/edit/{id}', 'DashboardController@videographerEditPackage');
    Route::post('user/dashboard/packages/videographer-package/update', 'DashboardController@videographerUpdatePackage');
    Route::get('user/dashboard/packages/videographer-package/delete/{id}', 'DashboardController@videographerDeletePackage');
    //Animator Package
    Route::get('user/dashboard/packages/animator-package', 'DashboardController@animatorPackage');
    Route::get('user/dashboard/packages/animator-package/add', 'DashboardController@animatorAddPackage');
    Route::post('user/dashboard/packages/animator-package/add', 'DashboardController@animatorStorePackage');
    Route::get('user/dashboard/packages/animator-package/edit/{id}', 'DashboardController@animatorEditPackage');
    Route::post('user/dashboard/packages/animator-package/update', 'DashboardController@animatorUpdatePackage');
    Route::get('user/dashboard/packages/animator-package/delete/{id}', 'DashboardController@animatorDeletePackage');
    //Musician Package
    Route::get('user/dashboard/packages/musician-package', 'DashboardController@musicianPackage');
    Route::get('user/dashboard/packages/musician-package/add', 'DashboardController@musicianAddPackage');
    Route::post('user/dashboard/packages/musician-package/add', 'DashboardController@musicianStorePackage');
    Route::get('user/dashboard/packages/musician-package/edit/{id}', 'DashboardController@musicianEditPackage');
    Route::post('user/dashboard/packages/musician-package/update', 'DashboardController@musicianUpdatePackage');
    Route::get('user/dashboard/packages/musician-package/delete/{id}', 'DashboardController@musicianDeletePackage');

    // Photos
    Route::get('user/dashboard/photos', 'DashboardController@photos');
    Route::post('user/dashboard/photos/delete', 'DashboardController@delete_photo'); // Added by shahzad

    // Sales
    Route::get('user/dashboard/sales', 'DashboardController@sales');

    // Purchases
    Route::get('user/dashboard/purchases', 'DashboardController@purchases');

    // Deposits
    Route::get('user/dashboard/deposits', 'DashboardController@deposits');

    // Add Funds
    Route::get('user/dashboard/add/funds', 'DashboardController@addFunds');
    Route::post('user/dashboard/add/funds', 'AddFundsController@send');

    // Withdrawals
    Route::get('user/dashboard/withdrawals', 'DashboardController@showWithdrawal');

    // Request withdrawal
    Route::post('request/withdrawal', 'DashboardController@withdrawal');

    Route::get('user/dashboard/withdrawals/configure', 'DashboardController@withdrawalsConfigureView');

    Route::post('user/withdrawals/configure/{type}', 'DashboardController@withdrawalConfigure');

    Route::post('delete/withdrawal/{id}', 'DashboardController@withdrawalDelete');

    // Purchase Photo
    Route::post('purchase/stock/{token_id}', 'ImagesController@purchase');
    Route::post('purchase/audio/{token_id}', 'ImagesController@purchaseaudio');

});//<------ End User Views LOGGED

Route::post('instant_buy', 'ImagesController@instant_buy');

// See all Comments Likes
Route::post('comments/likes', 'CommentsController@getLikes');

/*
 |
 |-----------------------------------
 | User Views
 |--------- -------------------------
 */

//<----------- USERS VIEWS ---------->>>

// Downloads Images
Route::group(['middleware' => 'downloads'], function () {
    Route::post('download/stock/{token_id}', 'ImagesController@download');
});


/*
 |
 |-----------------------------------
 | Profile User
 |-----------------------------------
 */

Route::get('{slug}', 'UserController@profile')->where('slug', '[A-Za-z0-9\_-]+');
Route::get('{slug}/followers', 'UserController@followers')->where('slug', '[A-Za-z0-9\_-]+');
Route::get('{slug}/following', 'UserController@following')->where('slug', '[A-Za-z0-9\_-]+');
Route::get('{slug}/collections', 'UserController@collections')->where('slug', '[A-Za-z0-9\_-]+');

/*
 |
 |-----------------------------------
 | Admin Panel
 |--------- -------------------------
 */
Route::group(['middleware' => 'role'], function () {


    // Upgrades
    Route::get('update/{version}', 'UpgradeController@update');

    // Dashboard
    Route::get('panel/admin', 'AdminController@admin');

    // Categories
    Route::get('panel/admin/categories', 'AdminController@categories');
    Route::get('panel/admin/categories/add', 'AdminController@addCategories');
    Route::post('panel/admin/categories/add', 'AdminController@storeCategories');
    Route::get('panel/admin/categories/edit/{id}', 'AdminController@editCategories')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/categories/update', 'AdminController@updateCategories');
    Route::get('panel/admin/categories/delete/{id}', 'AdminController@deleteCategories')->where(array('id' => '[0-9]+'));

    // SubCategories
    Route::get('panel/admin/sub-categories', 'AdminController@subCategories');
    Route::get('panel/admin/sub-categories/add', 'AdminController@addSubCategories');
    Route::post('panel/admin/sub-categories/add', 'AdminController@storeSubCategories');
    Route::get('panel/admin/sub-categories/edit/{id}', 'AdminController@editSubCategories')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/sub-categories/update', 'AdminController@updateSubCategories');
    Route::get('panel/admin/sub-categories/delete/{id}', 'AdminController@deleteSubCategories')->where(array('id' => '[0-9]+'));


    // FAQ Categories
    Route::get('panel/admin/faq-categories', 'AdminController@faqCategories');
    Route::get('panel/admin/faq-categories/add', 'AdminController@addFaqCategories');
    Route::post('panel/admin/faq-categories/add', 'AdminController@storeFaqCategories');
    Route::get('panel/admin/faq-categories/edit/{id}', 'AdminController@editFaqCategories')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/faq-categories/update', 'AdminController@updateFaqCategories');
    Route::get('panel/admin/faq-categories/delete/{id}', 'AdminController@deleteFaqCategories')->where(array('id' => '[0-9]+'));

    // FAQ
    Route::get('panel/admin/faq', 'AdminController@faq');
    Route::get('panel/admin/faq/add', 'AdminController@addFaq');
    Route::post('panel/admin/faq/add', 'AdminController@storeFaq');
    Route::get('panel/admin/faq/edit/{id}', 'AdminController@editFaq')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/faq/update', 'AdminController@updateFaq');
    Route::get('panel/admin/faq/delete/{id}', 'AdminController@deleteFaq')->where(array('id' => '[0-9]+'));

    //Hiring Requests
    Route::get('panel/admin/booking-requests/pending', 'AdminController@bookingPendingRequests');
    Route::get('panel/admin/booking-requests/rejected', 'AdminController@bookingRejectedRequests');
    Route::get('panel/admin/booking-requests/cancelled', 'AdminController@bookingCancelledRequests');
    Route::get('panel/admin/booking-requests/approved', 'AdminController@bookingApprovedRequests');
    Route::get('panel/admin/booking-requests/completed', 'AdminController@bookingCompletedRequests');
    Route::get('panel/admin/booking-pending-details/{id}', 'AdminController@bookingPendingRequestsDetails');
    Route::get('panel/admin/booking-rejected-details/{id}', 'AdminController@bookingRejectedRequestsDetails');
    Route::get('panel/admin/booking-cancelled-details/{id}', 'AdminController@bookingCancelledRequestsDetails');
    Route::get('panel/admin/booking-approved-details/{id}', 'AdminController@bookingApprovedRequestsDetails');
    Route::get('panel/admin/booking-completed-details/{id}', 'AdminController@bookingCompletedRequestsDetails');

    //Payment Detail
    Route::get('panel/admin/get_payment_details/{id}', 'AdminController@getPaymentDetails');


    //Destinations -> Continents
    Route::get('panel/admin/destinations/continents', 'AdminController@continent');
    Route::get('panel/admin/destinations/continents/add', 'AdminController@addContinent');
    Route::post('panel/admin/destinations/continents/add', 'AdminController@storeContinent');
    Route::get('panel/admin/destinations/continents/edit/{id}', 'AdminController@editContinent')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/destinations/continents/update', 'AdminController@updateContinent');
    Route::get('panel/admin/destinations/continents/delete/{id}', 'AdminController@deleteContinent')->where(array('id' => '[0-9]+'));

    //Destinations -> Countries
    Route::get('panel/admin/destinations/countries', 'AdminController@country');
    Route::get('panel/admin/destinations/countries/add', 'AdminController@addCountry');
    Route::post('panel/admin/destinations/countries/add', 'AdminController@storeCountry');
    Route::get('panel/admin/destinations/countries/edit/{id}', 'AdminController@editCountry')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/destinations/countries/update', 'AdminController@updateCountry');
    Route::get('panel/admin/destinations/countries/delete/{id}', 'AdminController@deleteCountry')->where(array('id' => '[0-9]+'));

    //Destinations -> States
    Route::get('panel/admin/destinations/states', 'AdminController@state');
    Route::get('panel/admin/destinations/states/add', 'AdminController@addState');
    Route::post('panel/admin/destinations/states/add', 'AdminController@storeState');
    Route::get('panel/admin/destinations/states/edit/{id}', 'AdminController@editState')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/destinations/states/update', 'AdminController@updateState');
    Route::get('panel/admin/destinations/states/delete/{id}', 'AdminController@deleteState')->where(array('id' => '[0-9]+'));

    Route::get('panel/admin/destinations/get-countries-by-continent/{id}', 'AdminController@getCountryByContinentId');
    Route::get('panel/admin/destinations/get-states-by-country/{id}', 'AdminController@getStateByCountryId');
    Route::get('panel/admin/destinations/get-cities-by-state/{id}', 'AdminController@getCityByStateId');


    //Destinations -> Cities
    Route::get('panel/admin/destinations/cities', 'AdminController@cities');
    Route::get('panel/admin/destinations/cities/add', 'AdminController@addCities');
    Route::post('panel/admin/destinations/cities/add', 'AdminController@storeCities');
    Route::get('panel/admin/destinations/cities/edit/{id}', 'AdminController@editCities')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/destinations/cities/update', 'AdminController@updateCities');
    Route::get('panel/admin/destinations/cities/delete/{id}', 'AdminController@deleteCities')->where(array('id' => '[0-9]+'));

    //Destinations -> Routes
    Route::get('panel/admin/destinations/routes', 'AdminController@routes');
    Route::get('panel/admin/destinations/routes/add', 'AdminController@addRoutes');
    Route::post('panel/admin/destinations/routes/add', 'AdminController@storeRoutes');
    Route::get('panel/admin/destinations/routes/edit/{id}', 'AdminController@editRoutes')->where(array('id' => '[0-9]+'));
    Route::post('panel/admin/destinations/routes/update', 'AdminController@updateRoutes');
    Route::get('panel/admin/destinations/routes/delete/{id}', 'AdminController@deleteRoutes')->where(array('id' => '[0-9]+'));

    //Suggest City Requests
    Route::get('panel/admin/request-suggest-country-city', 'AdminController@requestSuggestCountryCity');


    // Settings
    Route::get('panel/admin/settings', 'AdminController@settings');
    Route::post('panel/admin/settings', 'AdminController@saveSettings');

    //Inventory Start

    //Photoshoot
    Route::get('panel/admin/photoshoot-type', 'AdminController@photoshootType');
    Route::get('panel/admin/photoshoot-type/add', 'AdminController@addPhotoshootType');
    Route::post('panel/admin/photoshoot-type/add', 'AdminController@storePhotoshootType');
    Route::get('panel/admin/photoshoot-type/edit/{id}', 'AdminController@editPhotoshootType');
    Route::post('panel/admin/photoshoot-type/update', 'AdminController@updatePhotoshootType');
    Route::get('panel/admin/photoshoot-type/delete/{id}', 'AdminController@deletePhotoshootType');


    //Time Of Day
    Route::get('panel/admin/time-day', 'AdminController@timeDay');
    Route::get('panel/admin/time-day/add', 'AdminController@addTimeDay');
    Route::post('panel/admin/time-day/add', 'AdminController@storeTimeDay');
    Route::get('panel/admin/time-day/edit/{id}', 'AdminController@editTimeDay');
    Route::post('panel/admin/time-day/update', 'AdminController@updateTimeDay');
    Route::get('panel/admin/time-day/delete/{id}', 'AdminController@deleteTimeDay');

    //Trip Reason
    Route::get('panel/admin/trip-reason', 'AdminController@tripReason');
    Route::get('panel/admin/trip-reason/add', 'AdminController@addTripReason');
    Route::post('panel/admin/trip-reason/add', 'AdminController@storeTripReason');
    Route::get('panel/admin/trip-reason/edit/{id}', 'AdminController@editTripReason');
    Route::post('panel/admin/trip-reason/update', 'AdminController@updateTripReason');
    Route::get('panel/admin/trip-reason/delete/{id}', 'AdminController@deleteTripReason');

// 	//Package
// 	Route::get('panel/admin/package', 'AdminController@package');
// 	Route::get('panel/admin/package/add', 'AdminController@addPackage');
// 	Route::post('panel/admin/package/add', 'AdminController@storePackage');
// 	Route::get('panel/admin/package/edit/{id}', 'AdminController@editPackage');
// 	Route::post('panel/admin/package/update', 'AdminController@updatePackage');
// 	Route::get('panel/admin/package/delete/{id}', 'AdminController@deletePackage');

    //Preferred Style Photo
    Route::get('panel/admin/preferred-style-photo', 'AdminController@preferredStylePhoto');
    Route::get('panel/admin/preferred-style-photo/add', 'AdminController@addPreferredStylePhoto');
    Route::post('panel/admin/preferred-style-photo/add', 'AdminController@storePreferredStylePhoto');
    Route::get('panel/admin/preferred-style-photo/edit/{id}', 'AdminController@editPreferredStylePhoto');
    Route::post('panel/admin/preferred-style-photo/update', 'AdminController@updatePreferredStylePhoto');
    Route::get('panel/admin/preferred-style-photo/delete/{id}', 'AdminController@deletePreferredStylePhoto');

    //Level Of Direction
    Route::get('panel/admin/level-of-direction', 'AdminController@levelOfDirection');
    Route::get('panel/admin/level-of-direction/add', 'AdminController@addLevelOfDirection');
    Route::post('panel/admin/level-of-direction/add', 'AdminController@storeLevelOfDirection');
    Route::get('panel/admin/level-of-direction/edit/{id}', 'AdminController@editLevelOfDirection');
    Route::post('panel/admin/level-of-direction/update', 'AdminController@updateLevelOfDirection');
    Route::get('panel/admin/level-of-direction/delete/{id}', 'AdminController@deleteLevelOfDirection');

    //Music Type
    Route::get('panel/admin/music-type', 'AdminController@musicType');
    Route::get('panel/admin/music-type/add', 'AdminController@addMusicType');
    Route::post('panel/admin/music-type/add', 'AdminController@storeMusicType');
    Route::get('panel/admin/music-type/edit/{id}', 'AdminController@editMusicType');
    Route::post('panel/admin/music-type/update', 'AdminController@updateMusicType');
    Route::get('panel/admin/music-type/delete/{id}', 'AdminController@deleteMusicType');

    //Music Sub Type
    Route::get('panel/admin/music-sub-type', 'AdminController@musicSubType');
    Route::get('panel/admin/music-sub-type/add', 'AdminController@addMusicSubType');
    Route::post('panel/admin/music-sub-type/add', 'AdminController@storeMusicSubType');
    Route::get('panel/admin/music-sub-type/edit/{id}', 'AdminController@editMusicSubType');
    Route::post('panel/admin/music-sub-type/update', 'AdminController@updateMusicSubType');
    Route::get('panel/admin/music-sub-type/delete/{id}', 'AdminController@deleteMusicSubType');

    //Inventory End


    // Home Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/home-page-settings', 'AdminController@homePageSettings');
    Route::post('panel/admin/home-page-settings', 'AdminController@saveHomePageSettings');
    // Home Page Settings Admin SITE CONTENT END

    // About Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/about-page-settings', 'AdminController@aboutPageSettings');
    Route::post('panel/admin/about-page-settings', 'AdminController@saveAboutPageSettings');
    // About Page Settings Admin SITE CONTENT END

    // License Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/license-page-settings', 'AdminController@licensePageSettings');
    Route::post('panel/admin/license-page-settings', 'AdminController@saveLicensePageSettings');
    // License Page Settings Admin SITE CONTENT END

    // Use Guide Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/use-guide-page-settings', 'AdminController@useGuidePageSettings');
    Route::post('panel/admin/use-guide-page-settings', 'AdminController@saveUseGuidePageSettings');
    // Use Guide Page Settings Admin SITE CONTENT END

    // FAQ Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/faq-page-settings', 'AdminController@faqPageSettings');
    Route::post('panel/admin/faq-page-settings', 'AdminController@saveFaqPageSettings');
    // FAQ Page Settings Admin SITE CONTENT END

    // Imprint Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/imprint-page-settings', 'AdminController@imprintPageSettings');
    Route::post('panel/admin/imprint-page-settings', 'AdminController@saveImprintPageSettings');
    // Imprint Page Settings Admin SITE CONTENT END

    // Privacy Policy Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/privacy-policy-page-settings', 'AdminController@privacyPolicyPageSettings');
    Route::post('panel/admin/privacy-policy-page-settings', 'AdminController@savePrivacyPolicyPageSettings');
    // Privacy Policy Page Settings Admin SITE CONTENT END

    // Privacy Policy Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/terms-page-settings', 'AdminController@termsPageSettings');
    Route::post('panel/admin/terms-page-settings', 'AdminController@saveTermsPageSettings');
    // Privacy Policy Page Settings Admin SITE CONTENT END

    // Destination Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/destination-page-settings', 'AdminController@destinationPageSettings');
    Route::post('panel/admin/destination-page-settings', 'AdminController@saveDestinationPageSettings');
    // Destination Page Settings Admin SITE CONTENT END

    // Suggest A City Page Settings Admin SITE CONTENT START
    Route::get('panel/admin/suggest-city-page-settings', 'AdminController@suggestCityPageSettings');
    Route::post('panel/admin/suggest-city-page-settings', 'AdminController@saveSuggestCityPageSettings');
    // Suggest A City Page Settings Admin SITE CONTENT END

    // Images
    Route::get('panel/admin/images', 'AdminController@images');
    Route::post('panel/admin/images/delete', 'AdminController@delete_image');

    Route::get('panel/admin/images/{id}', 'AdminController@edit_image');
    Route::post('panel/admin/images/update', 'AdminController@update_image');

    // Videos
    Route::get('panel/admin/videos', 'AdminController@videos');
    Route::post('panel/admin/videos/delete', 'AdminController@delete_video');

    Route::get('panel/admin/videos/{id}', 'AdminController@edit_video');
    Route::post('panel/admin/videos/update', 'AdminController@update_video');

    // Limits
    Route::get('panel/admin/settings/limits', 'AdminController@settingsLimits');
    Route::post('panel/admin/settings/limits', 'AdminController@saveSettingsLimits');

    // Members
    Route::resource('panel/admin/members', 'AdminUserController',
        ['names' => [
            'edit' => 'user.edit',
            'destroy' => 'user.destroy'
        ]]
    );

    // Member Types
    Route::post('panel/admin/member_types/update/{id}', 'AdminUserTypeController@update');
    Route::resource('panel/admin/member_types', 'AdminUserTypeController',
        ['names' => [
            'index' => 'type.index',
            'create' => 'type.create',
            'store' => 'type.store',
            'edit' => 'type.edit',
            'destroy' => 'type.destroy'
        ]]
    );

    // Members Reported
    Route::get('panel/admin/members-reported', 'AdminController@members_reported');
    Route::post('panel/admin/members-reported', 'AdminController@delete_members_reported');

    // Images Reported
    Route::get('panel/admin/images-reported', 'AdminController@images_reported');
    Route::post('panel/admin/images-reported', 'AdminController@delete_images_reported');

    // Pages
    Route::resource('panel/admin/pages', 'PagesController',
        ['names' => [
            'edit' => 'pages.edit',
            'destroy' => 'pages.destroy'
        ]]
    );


    // Profiles Social
    Route::get('panel/admin/profiles-social', 'AdminController@profiles_social');
    Route::post('panel/admin/profiles-social', 'AdminController@update_profiles_social');

    // Google
    Route::get('panel/admin/google', 'AdminController@google');
    Route::post('panel/admin/google', 'AdminController@update_google');

    //***** Languages
    Route::get('panel/admin/languages', 'LangController@index');

    // ADD NEW
    Route::get('panel/admin/languages/create', 'LangController@create');

    // ADD NEW POST
    Route::post('panel/admin/languages/create', 'LangController@store');

    // EDIT LANG
    Route::get('panel/admin/languages/edit/{id}', 'LangController@edit')->where(array('id' => '[0-9]+'));

    // EDIT LANG POST
    Route::post('panel/admin/languages/edit/{id}', 'LangController@update')->where(array('id' => '[0-9]+'));

    // DELETE LANG
    Route::resource('panel/admin/languages', 'LangController',
        ['names' => [
            'destroy' => 'languages.destroy'
        ]]
    );

    // BULK UPLOAD
    Route::get('panel/admin/bulk-upload', 'bulkUploadController@bulkUpload');
    Route::post('panel/admin/bulk-upload', 'bulkUploadController@bulkUploadStore');

    // BOOKING CALENDAR
    Route::get('panel/admin/booking-calendar', 'AdminController@bookingCalendar');
    Route::post('panel/admin/booking-calendar', 'AdminController@bookingCalendarStore');

    // THEME
    Route::get('panel/admin/theme', 'AdminController@theme');
    Route::post('panel/admin/theme', 'AdminController@themeStore');

    // Payments
    Route::get('panel/admin/payments', 'AdminController@payments');
    Route::post('panel/admin/payments', 'AdminController@savePayments');

    Route::get('panel/admin/payments/{id}', 'AdminController@paymentsGateways');
    Route::post('panel/admin/payments/{id}', 'AdminController@savePaymentsGateways');

    // Purchases
    Route::get('panel/admin/purchases', 'AdminController@purchases');

    // Deposits
    Route::get('panel/admin/deposits', 'AdminController@deposits');

    //Withdrawals
    Route::get('panel/admin/withdrawals', 'AdminController@withdrawals');
    Route::get('panel/admin/withdrawal/{id}', 'AdminController@withdrawalsView');
    Route::post('panel/admin/withdrawals/paid/{id}', 'AdminController@withdrawalsPaid');


});//<--- End Group Role


Route::get('lang/{id}', function ($id) {

    $lang = App\Models\Languages::where('abbreviation', $id)->firstOrFail();

    Session::put('locale', $lang->abbreviation);

    return back();

})->where(array('id' => '[a-z]+'));

// PayPal IPN
Route::post('paypal/ipn', 'PayPalController@paypalIpn');

/*
 |
 |------------------------
 | v3.2
 |--------- --------------
 */

Route::get('install/{addon}', 'InstallController@install');

// Payments Gateways
Route::get('payment/paypal', 'PayPalController@show')->name('paypal');

Route::get('payment/stripe', 'StripeController@show')->name('stripe');
Route::post('payment/stripe/charge', 'StripeController@charge');


/*Route::fallback(function () {
	return view("404");
});*/



