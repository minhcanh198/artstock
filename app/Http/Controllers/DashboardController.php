<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchases;
use App\Models\Deposits;
use App\Models\Withdrawals;
use App\Models\User;
use App\Models\AdminSettings;
use App\Models\Images;
use App\Helper;
use App\Models\PaymentGateways;
use App\Models\Booking;
use App\Models\Chat;
use App\Models\Message;
use App\Models\CustomerFiles;
use App\Models\Review;
use App\Models\Payments;
use App\Models\Package;
use Carbon;
use ZipArchive;

use App\Models\Notifications;
use App\Models\CollectionsImages;
use App\Models\ImagesReported;
use App\Models\Stock;

class DashboardController extends Controller
{

    public function __construct(AdminSettings $settings, Request $request)
    {

        $this->middleware('sellOption');
        $this->settings = $settings::first();
        $this->request = $request;
    }

    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    public function myBookings()
    {
        $getBookingsList = Booking::where('artist_id', '=', Auth::user()->id)
            ->orderBy('requested_date', 'ASC')
            ->get();
        return view('dashboard.bookings', ['data' => $getBookingsList]);
    }

    public function myBookingsDetails($shootId)
    {
        $getBookingDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'users.username AS UserName', 'users.name AS User_Name')->join('cities', 'cities.id', '=', 'bookings.city_id')->join('users', 'users.id', '=', 'bookings.customer_id')->where('bookings.id', '=', $shootId)->first();
        // dd($getShootsList);
        return view('dashboard.booking_details', ['data' => $getBookingDetails]);
    }

    public function myShoots()
    {

        $getShootsList = Booking::where('customer_id', '=', Auth::user()->id)->orderBy('requested_date', 'ASC')->get();
        // dd($getShootsList);
        return view('dashboard.shoots', ['data' => $getShootsList]);
    }

    public function myShootsDetails($shootId)
    {
        $getShootsDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'users.username AS UserName', 'users.name AS User_Name')->join('cities', 'cities.id', '=', 'bookings.city_id')->join('users', 'users.id', '=', 'bookings.artist_id')->where('bookings.id', '=', $shootId)->first();
        if ($getShootsDetails == null) {
            \Session::flash('error', trans('admin.no_result'));
            return redirect('user/dashboard/my-shoots');
        }
        return view('dashboard.shoots_details', ['data' => $getShootsDetails]);
    }

    public function customCheckOut($refNo)
    {
        $getBookingDetails = Booking::select('bookings.*', 'cities.country_id as CountryId', 'cities.city_name', 'cities.description', 'users.username AS UserName', 'users.name AS User_Name')->join('cities', 'cities.id', '=', 'bookings.city_id')->join('users', 'users.id', '=', 'bookings.artist_id')->where('bookings.reference_no', '=', $refNo)->first();
        return view('dashboard.checkout', ['BookingDetails' => $getBookingDetails]);
    }


    // Photographer Start
    // START
    public function photographerPackage()
    {

        $artistId = Auth::id();
        $data = Package::where('artist_id', $artistId)->where('package_type', 'photographer')->get();
        return view('dashboard.package')->withData($data);

    }//<--- END METHOD

    public function photographerAddPackage()
    {

        return view('dashboard.add-package');

    }//<--- END METHOD

    public function photographerStorePackage(Request $request)
    {


        $rules = array(
            // 'hours'        		=> 'required',
            'price' => 'required',
            'number_of_photos' => 'required'
        );

        $this->validate($request, $rules);

        $sql = new Package();
        $sql->hours = $request->hours;
        $sql->minutes = $request->minutes;
        $sql->price = $request->price;
        $sql->number_of_photos = $request->number_of_photos;
        $sql->mode = $request->mode;
        $sql->artist_id = Auth::id();
        $sql->package_type = 'photographer';
        $sql->save();

        \Session::flash('success_message', trans('admin.success_add_package'));

        return redirect('user/dashboard/packages/photographer-package');

    }//<--- END METHOD

    public function photographerEditPackage($id)
    {

        $package = Package::find($id);

        return view('dashboard.edit-package', compact('package'));

    }//<--- END METHOD

    public function photographerUpdatePackage(Request $request)
    {


        $package = Package::find($request->id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/photographer-package');
        }

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'price' => 'required',
            'number_of_photos' => 'required'
        );

        $this->validate($request, $rules);

        // UPDATE CATEGORY

        $package->hours = $request->hours;
        $package->minutes = $request->minutes;
        $package->price = $request->price;
        $package->number_of_photos = $request->number_of_photos;
        $package->mode = $request->mode;
        $package->save();

        \Session::flash('success_message', trans('misc.success_update'));

        return redirect('user/dashboard/packages/photographer-package');

    }//<--- END METHOD

    public function photographerDeletePackage($id)
    {

        $package = Package::find($id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/photographer-package');
        } else {

            // Delete Category
            $package->delete();

            return redirect('user/dashboard/packages/photographer-package');
        }
    }//<--- END METHOD

    // Photographer End
    // Videographer Start
    // START
    public function videographerPackage()
    {

        $artistId = Auth::id();
        $data = Package::where('artist_id', $artistId)->where('package_type', 'videographer')->get();
        return view('dashboard.videographer-package')->withData($data);

    }//<--- END METHOD

    public function videographerAddPackage()
    {

        return view('dashboard.videographer-add-package');

    }//<--- END METHOD

    public function videographerStorePackage(Request $request)
    {

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'videographer_price' => 'required',
            'number_of_videos' => 'required'
        );

        $this->validate($request, $rules);

        $sql = new Package();
        $sql->videographer_hours = $request->videographer_hours;
        $sql->videographer_minutes = $request->videographer_minutes;
        $sql->videographer_price = $request->videographer_price;
        $sql->number_of_videos = $request->number_of_videos;
        $sql->mode = $request->mode;
        $sql->artist_id = Auth::id();
        $sql->package_type = 'videographer';
        $sql->save();

        \Session::flash('success_message', trans('admin.success_add_package'));

        return redirect('user/dashboard/packages/videographer-package');

    }//<--- END METHOD

    public function videographerEditPackage($id)
    {

        $package = Package::find($id);

        return view('dashboard.videographer-edit-package', compact('package'));

    }//<--- END METHOD

    public function videographerUpdatePackage(Request $request)
    {


        $package = Package::find($request->id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/videographer-package');
        }

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'videographer_price' => 'required',
            'number_of_videos' => 'required'
        );

        $this->validate($request, $rules);

        // UPDATE CATEGORY

        $package->videographer_hours = $request->videographer_hours;
        $package->videographer_minutes = $request->videographer_minutes;
        $package->videographer_price = $request->videographer_price;
        $package->number_of_videos = $request->number_of_videos;
        $package->mode = $request->mode;
        $package->save();

        \Session::flash('success_message', trans('misc.success_update'));

        return redirect('user/dashboard/packages/videographer-package');

    }//<--- END METHOD

    public function videographerDeletePackage($id)
    {

        $package = Package::find($id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/videographer-package');
        } else {

            // Delete Category
            $package->delete();

            return redirect('user/dashboard/packages/videographer-package');
        }
    }//<--- END METHOD

    // Videographer End
    // Animator Start
    // START
    public function animatorPackage()
    {

        $artistId = Auth::id();
        $data = Package::where('artist_id', $artistId)->where('package_type', 'animator')->get();
        return view('dashboard.animator-package')->withData($data);

    }//<--- END METHOD

    public function animatorAddPackage()
    {

        return view('dashboard.animator-add-package');

    }//<--- END METHOD

    public function animatorStorePackage(Request $request)
    {

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'animator_price' => 'required',
            'number_of_animations' => 'required'
        );

        $this->validate($request, $rules);

        $sql = new Package();
        $sql->animator_hours = $request->animator_hours;
        $sql->animator_minutes = $request->animator_minutes;
        $sql->animator_price = $request->animator_price;
        $sql->number_of_animations = $request->number_of_animations;
        $sql->mode = $request->mode;
        $sql->artist_id = Auth::id();
        $sql->package_type = 'animator';
        $sql->save();

        \Session::flash('success_message', trans('admin.success_add_package'));

        return redirect('user/dashboard/packages/animator-package');

    }//<--- END METHOD

    public function animatorEditPackage($id)
    {

        $package = Package::find($id);

        return view('dashboard.animator-edit-package', compact('package'));

    }//<--- END METHOD

    public function animatorUpdatePackage(Request $request)
    {


        $package = Package::find($request->id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/animator-package');
        }

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'animator_price' => 'required',
            'number_of_animations' => 'required'
        );

        $this->validate($request, $rules);

        // UPDATE CATEGORY

        $package->animator_hours = $request->animator_hours;
        $package->animator_minutes = $request->animator_minutes;
        $package->animator_price = $request->animator_price;
        $package->number_of_animations = $request->number_of_animations;
        $package->mode = $request->mode;
        $package->save();

        \Session::flash('success_message', trans('misc.success_update'));

        return redirect('user/dashboard/packages/animator-package');

    }//<--- END METHOD

    public function animatorDeletePackage($id)
    {

        $package = Package::find($id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/animator-package');
        } else {

            // Delete Category
            $package->delete();

            return redirect('user/dashboard/packages/animator-package');
        }
    }//<--- END METHOD

    // Animator End
    // Musician Start
    // START
    public function musicianPackage()
    {

        $artistId = Auth::id();
        $data = Package::where('artist_id', $artistId)->where('package_type', 'musician')->get();
        return view('dashboard.musician-package')->withData($data);

    }//<--- END METHOD

    public function musicianAddPackage()
    {

        return view('dashboard.musician-add-package');

    }//<--- END METHOD

    public function musicianStorePackage(Request $request)
    {

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'muiscian_price' => 'required',
            'number_of_music' => 'required'
        );

        $this->validate($request, $rules);

        $sql = new Package();
        $sql->muiscian_hours = $request->muiscian_hours;
        $sql->muiscian_minutes = $request->muiscian_minutes;
        $sql->muiscian_price = $request->muiscian_price;
        $sql->number_of_music = $request->number_of_music;
        $sql->mode = $request->mode;
        $sql->artist_id = Auth::id();
        $sql->package_type = 'musician';
        $sql->save();

        \Session::flash('success_message', trans('admin.success_add_package'));

        return redirect('user/dashboard/packages/musician-package');

    }//<--- END METHOD

    public function musicianEditPackage($id)
    {

        $package = Package::find($id);

        return view('dashboard.musician-edit-package', compact('package'));

    }//<--- END METHOD

    public function musicianUpdatePackage(Request $request)
    {


        $package = Package::find($request->id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/musician-package');
        }

// 		Validator::extend('ascii_only', function($attribute, $value, $parameters){
//     		return !preg_match('/[^x00-x7F\-]/i', $value);
// 		});

        $rules = array(
            // 'hours'        		=> 'required',
            'muiscian_price' => 'required',
            'number_of_music' => 'required'
        );

        $this->validate($request, $rules);

        // UPDATE CATEGORY

        $package->muiscian_hours = $request->muiscian_hours;
        $package->muiscian_minutes = $request->muiscian_minutes;
        $package->muiscian_price = $request->muiscian_price;
        $package->number_of_music = $request->number_of_music;
        $package->mode = $request->mode;
        $package->save();

        \Session::flash('success_message', trans('misc.success_update'));

        return redirect('user/dashboard/packages/musician-package');

    }//<--- END METHOD

    public function musicianDeletePackage($id)
    {

        $package = Package::find($id);

        if (!isset($package)) {
            return redirect('user/dashboard/packages/musician-package');
        } else {

            // Delete Category
            $package->delete();

            return redirect('user/dashboard/packages/musician-package');
        }
    }//<--- END METHOD

    // Musician End

    public function customCheckOutProccess(Request $request)
    {

        $mytime = Carbon\Carbon::now();

        $postData = $request->all();

        $firstName = $postData['firstName'];
        $lastName = $postData['lastName'];
        $email = $postData['email'];
        $phone = $postData['phone'];
        $requestReferenceNumber = $postData['RequestReferenceNumber'];
        $totalAmount = $postData['amount'];
        $transactionId = $postData['transaction_id'];
        $paymentStatus = $postData['payment_status'];
        $paymentMethod = $postData['payment_method'];
        $getAdminPercent = (5 / 100) * $totalAmount;
        $idCustomer = Auth::user()->id;
        $createdDate = $mytime->toDateTimeString();

        $insertPayment = Payments::create([
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Email' => $email,
            'Phone' => $phone,
            'RequestReferenceNo' => $requestReferenceNumber,
            'TotalAmount' => $totalAmount,
            'TransactionId' => $transactionId,
            'PaymentStaus' => $paymentStatus,
            'PaymentMethod' => $paymentMethod,
            'AdminPercentage' => $getAdminPercent,
            'idCustomer' => $idCustomer,
            'CreatedDate' => $createdDate
        ]);

        if ($insertPayment) {
            $updateBookingIsPaid = Booking::where('reference_no', '=', $requestReferenceNumber)->update(['isPaid' => '1']);
            if ($updateBookingIsPaid) {
                \Session::flash('success_message', 'Your Payment has been done.');

                return redirect('user/dashboard');
            } else {
                \Session::flash('success_message', 'Failed to update Paid.');

                return redirect('user/dashboard');
            }


        } else {
            \Session::flash('success_message', 'Failed to pay your payment.');

            return redirect('user/dashboard');
        }
    }

    public function getDetailsArtistCustomer(Request $request)
    {
        $customerId = $request->customerId;
        $artistId = $request->artistId;

        $getCustomerDetails = User::where('id', '=', $customerId)->first();
        $getArtistDetails = User::where('id', '=', $artistId)->first();
        $dataDetails = ['customerDetails' => $getCustomerDetails, 'artistDetails' => $getArtistDetails];
        echo json_encode($dataDetails);
    }

    public function review($shootId)
    {
        return view('dashboard.review', compact('shootId'));
    }

    public function reviewProcess(Request $request)
    {
        $reviewStar = $request->review_rate;
        $reviewDescription = $request->description;
        $reviewImage = $request->review_image;
        $shootId = $request->shootId;

        $saveReview = new Review();
        $saveReview->review_rate = $reviewStar;
        $saveReview->review_description = $reviewDescription;
        // $saveReview->review_image           = $reviewImage;
        $saveReview->shoot_id = $shootId;
        $saveReview->mode = 'on';

        //Header Main Image
        if ($request->hasFile('review_image')) {
            $headerMainImage = $reviewImage;
            $mainImageName = 'review_image_' . time() . '.' . $headerMainImage->getClientOriginalExtension();

            $Path = 'review_images/';
            $destinationPath = public_path($Path);

            if (!file_exists($destinationPath)) {
                // path does not exist
                $saveFile = $headerMainImage->move($destinationPath, $mainImageName);
                if ($saveFile) {
                    // $homePageSettings->header_main_image = $mainImageName;

                    $saveReview->review_image = $mainImageName;
                }
            } else {
                $saveFile = $headerMainImage->move($destinationPath, $mainImageName);
                if ($saveFile) {
                    // $homePageSettings->header_main_image = $mainImageName;
                    $saveReview->review_image = $mainImageName;
                }
            }
        }

        $insertReivew = $saveReview->save();

        if ($insertReivew) {
            $updateShootData = Booking::where('id', '=', $shootId)->update(['isReviewGiven' => '1']);
            if ($updateShootData) {
                \Session::flash('success', trans('admin.success_add'));
                return redirect('user/dashboard/my-shoots');
            }
        }
    }

    public function viewReview($id)
    {
        $getReviewDetails = Review::where('shoot_id', '=', $id)->first();
        $getBookingDetails = Booking::where('id', '=', $id)->first();
        $customerId = $getBookingDetails->customer_id;
        $getCustomer = User::where('id', '=', $customerId)->first();
        $artistId = $getBookingDetails->artist_id;
        $getArtist = User::where('id', '=', $artistId)->first();

        return view('dashboard.view-review', compact('getReviewDetails', 'getBookingDetails', 'getCustomer', 'getArtist'));
    }

    public function updateBookingRequestStatus(Request $request)
    {
        $shootId = $request->shootId;
        $statusVal = $request->statusVal;


        $updateStatusBooking = Booking::where('id', '=', $shootId)->update(['status' => $statusVal]);
        // dd($updateStatusBooking);

        if ($updateStatusBooking) {
            if ($statusVal == "approved") {
                $getBookingData = Booking::where('id', '=', $shootId)->first();
                $artistId = $getBookingData->artist_id;
                $customerId = $getBookingData->customer_id;


                $mytime = \Carbon\Carbon::now();
                $dateTime = $mytime->toDateTimeString();

                $createChat = Chat::create([
                    'sender_id' => $artistId,
                    'receiver_id' => $customerId,
                    'created_at' => $dateTime
                ]);


                if ($createChat) {

                    $messageTxt = "Hey, I have approved your request. Let's talk here!";

                    $generatingMsg = Message::create([
                        'chat_id' => $createChat->id,
                        'sender_id' => $artistId,
                        'receiver_id' => $customerId,
                        'message_text' => $messageTxt,
                        'created_at' => $dateTime
                    ]);

                    if ($generatingMsg) {
                        echo json_encode('true');
                    }
                }

            } else if ($statusVal == "completed") {
                echo json_encode('true');
            }

        } else {
            echo json_encode('false');
        }
    }

    //Customer  File Upload
    public function uploadFileCustomer(Request $request)
    {
        // dd($_FILES);
        $postData = $request->all();
        $referenceNo = $postData['txtReferenceNo'];
        $error = 0;
        $fileValidationError = array();
        if (isset($_FILES['filesUpload']['name'])) {
            $Path = 'customer_files/';
            if (file_exists(public_path('customer_files/' . $referenceNo))) {
                $destinationPath = public_path($Path . $referenceNo . '/');
            } else {
                mkdir(public_path($Path . $referenceNo), 0777, true);
                $Path = 'customer_files/' . $referenceNo . '/';
                $destinationPath = public_path($Path);
            }
            //   dd($destinationPath);
            for ($i = 0; $i < count($_FILES['filesUpload']['name']); $i++) {
                /* Getting file name */
                $filename = $_FILES['filesUpload']['name'][$i];


                /* Location */
                $location = $destinationPath . $filename;
                // $location = $destinationPath.$newFileName;
                $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
                $imageFileType = strtolower($imageFileType);

                $filesize = $_FILES["filesUpload"]["size"][$i];

                $newFileName = str_random(10) . $referenceNo . '.' . $imageFileType;

                $finalLocation = $destinationPath . $newFileName;

                /* Valid extensions */
                $valid_extensions = array("jpg", "jpeg", "png");
                $validFile_extensions = array("pdf", "docx", "doc");
                $validVideo_extensions = array("flv", "mp4", "mov", "avi", "wmv");

                $response = 0;
                /* Check file extension */
                if (in_array(strtolower($imageFileType), $valid_extensions)) {
                    // Verify file size - 5MB maximum
                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize) {
                        echo json_encode('filesize invalid');
                    } else {
                        /* Upload file */
                        // if(move_uploaded_file($_FILES['filesUpload']['tmp_name'][$i],$location)){
                        if (move_uploaded_file($_FILES['filesUpload']['tmp_name'][$i], $finalLocation)) {
                            $response = $finalLocation;


                            $mytime = \Carbon\Carbon::now();
                            $dateTime = $mytime->toDateTimeString();

                            $insertFileDB = CustomerFiles::create([
                                'customer_file_name' => $newFileName,
                                'file_type' => 'image',
                                'referenceNo' => $referenceNo,
                                'CreatedDate' => $dateTime,
                            ]);

                            if (!$insertFileDB) {
                                $error += 1;
                                // echo json_encode(true);
                            }
                            // else{
                            //     echo json_encode(false);
                            // }
                        }
                    }
                } elseif (in_array(strtolower($imageFileType), $validVideo_extensions)) {
                    $maxsize = 5 * 1024 * 1024;
                    if ($filesize > $maxsize) {
                        echo json_encode('filesize invalid');
                    } else {
                        /* Upload file */
                        // if(move_uploaded_file($_FILES['filesUpload']['tmp_name'][$i],$location)){
                        if (move_uploaded_file($_FILES['filesUpload']['tmp_name'][$i], $finalLocation)) {
                            $response = $finalLocation;


                            $mytime = \Carbon\Carbon::now();
                            $dateTime = $mytime->toDateTimeString();

                            $insertFileDB = CustomerFiles::create([
                                'customer_file_name' => $newFileName,
                                'file_type' => 'video',
                                'referenceNo' => $referenceNo,
                                'CreatedDate' => $dateTime,
                            ]);

                            if ($insertFileDB) {
                                $error += 1;
                                //     echo json_encode(true);
                            }
                            // else{
                            //     echo json_encode(false);
                            // }
                        }
                    }
                } else {
                    // echo json_encode('not a valid file type');
                    array_push($fileValidationError, "InValid File " + $_FILES['filesUpload']['name'][$i]);
                }
            }

            if ($error == 0 && count($fileValidationError) == 0) {

                $updateIsUpload = Booking::where('reference_no', '=', $referenceNo)->update(['isUpload' => '1', 'isCustomerAction' => 'pending']);

                \Session::flash('success_message', 'File has been sent.');

                return redirect('user/dashboard');
            }
        }
    }

    public function downloadAllFiles($referenceNo)
    {

        $zip_file = public_path('customer_files/' . $referenceNo . '/') . $referenceNo . '.zip';
        // dd($zip_file);
        $zip = new ZipArchive();
        if ($zip->open($zip_file, ZipArchive::CREATE) !== TRUE) {
            exit("message");
        }

        $getFiles = CustomerFiles::where('referenceNo', '=', $referenceNo)->get();

        if (count($getFiles) > 0) {
            for ($i = 0; $i < count($getFiles); $i++) {
                $locationFile = public_path('customer_files/' . $referenceNo . '/') . $getFiles[$i]->customer_file_name;
                $filePath = public_path('customer_files/') . $referenceNo . '/';

                $zip->addFile($locationFile, $getFiles[$i]->customer_file_name);
            }
        }
        $zip->close();


        if (file_exists($zip_file)) {
            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zip_file) . '"');
            // // 	header("Content-length: " . filesize($zip_file));
            // 	header("Pragma: no-cache");
            // 	header("Expires: 0");

            readfile($zip_file);

        }


        unlink($zip_file);
        exit;

    }

    public function viewAllFiles($referenceNo)
    {

        $getImages = CustomerFiles::where('referenceNo', '=', $referenceNo)->where('file_type', '=', 'image')->get();
        $getVideo = CustomerFiles::where('referenceNo', '=', $referenceNo)->where('file_type', '=', 'video')->get();
        $getAudio = CustomerFiles::where('referenceNo', '=', $referenceNo)->where('file_type', '=', 'audio')->get();

        // dd($getImages);
        return view('dashboard.view_all_files', ['refNo' => $referenceNo, 'gImages' => $getImages, 'gVideo' => $getVideo, 'gAudio' => $getAudio]);
    }

    public function updateCustomerAction(Request $request)
    {
        $postData = $request->all();
        // dd($postData);
        $updateBookingCustomerAction = Booking::where('reference_no', '=', $postData['refNo'])->update(['isCustomerAction' => $postData['customerAction']]);

        if ($updateBookingCustomerAction) {
            echo json_encode('true');
        } else {
            echo json_encode('false');
        }
    }

    public function artistPaymentRequest(Request $request)
    {
        $postData = $request->all();

        $updateArtistPaymentRequest = Booking::where('reference_no', '=', $postData['refNo'])->update(['isArtistPaymentRequest' => '1', 'paypal_email' => $postData['paypalEmail']]);

        if ($updateArtistPaymentRequest) {
            echo json_encode('true');
        } else {

            echo json_encode('false');
        }
    }


    public function getChatList($userID)
    {
        $getChatList = Chat::select('chat.*', 'senderUser.id AS senderId', 'senderUser.username AS senderUserName', 'senderUser.email', 'senderUser.name AS senderName', 'senderUser.avatar AS senderAvatar', 'receiverUser.id AS receiverId', 'receiverUser.username AS receiverUserName', 'receiverUser.email AS receiverEmail', 'receiverUser.name AS receiverName', 'receiverUser.avatar AS receiverAvatar',
            \DB::raw('(SELECT message_text FROM message WHERE message.chat_id = chat.chat_id ORDER BY message.created_at DESC LIMIT 1) as LatestMessage'),
            \DB::raw('(SELECT message_file FROM message WHERE message.chat_id = chat.chat_id ORDER BY message.created_at DESC LIMIT 1) as LatestMessageFile'),
            \DB::raw('(SELECT created_at FROM message WHERE message.chat_id = chat.chat_id ORDER BY message.created_at DESC LIMIT 1) as LatestMessageDate'),
            \DB::raw('(SELECT file_type FROM message WHERE message.chat_id = chat.chat_id ORDER BY message.created_at DESC LIMIT 1) as MessageType')
        )->join('users AS senderUser', 'chat.sender_id', '=', 'senderUser.id')->join('users AS receiverUser', 'chat.receiver_id', '=', 'receiverUser.id')->where('chat.sender_id', '=', $userID)->orWhere('chat.receiver_id', '=', $userID)->get();
        // dd($getChatList);

        if (count($getChatList) > 0) {
            echo json_encode($getChatList);
        } else {
            echo json_encode([]);
        }
    }

    public function getSingleChatDetails($chatID)
    {
        $getSingleChatDetail = Message::select('message.*', 'senderUser.id AS senderId', 'senderUser.username AS senderUserName', 'senderUser.email', 'senderUser.name AS senderName', 'senderUser.avatar AS senderAvatar', 'receiverUser.id AS receiverId', 'receiverUser.username AS receiverUserName', 'receiverUser.email AS receiverEmail', 'receiverUser.name AS receiverName', 'receiverUser.avatar AS receiverAvatar')->join('chat', 'message.chat_id', '=', 'chat.chat_id')->join('users AS senderUser', 'chat.sender_id', '=', 'senderUser.id')->join('users AS receiverUser', 'chat.receiver_id', '=', 'receiverUser.id')->where('message.chat_id', '=', $chatID)->get();
        // $getSingleChatDetail = Message::select('message.*','senderUser.id AS senderId', 'senderUser.username AS senderUserName', 'senderUser.email', 'senderUser.name AS senderName', 'senderUser.avatar AS senderAvatar', 'receiverUser.id AS receiverId', 'receiverUser.username AS receiverUserName', 'receiverUser.email AS receiverEmail', 'receiverUser.name AS receiverName', 'receiverUser.avatar AS receiverAvatar')->join('chat', 'message.chat_id','=', 'chat.chat_id')->join('users AS senderUser', 'chat.sender_id', '=', 'senderUser.id')->join('users AS receiverUser', 'chat.receiver_id','=','receiverUser.id')->where('message.chat_id','=', $chatID)->orderBy('created_at','asc')->get();

        if (count($getSingleChatDetail) > 0) {
            echo json_encode($getSingleChatDetail);
        } else {
            echo json_encode('empty');
        }
    }

    public function sendTextMsg(Request $request)
    {
        $textMsg = $request->textMsgValue;
        $chatID = $request->textChatId;
        $currentUserID = $request->textCurrentUserId;
        $userID = $request->textUserId;

        $mytime = \Carbon\Carbon::now();
        $dateTime = $mytime->toDateTimeString();

        $sendMsg = Message::create([
            'chat_id' => $chatID,
            'sender_id' => $currentUserID,
            'receiver_id' => $userID,
            'message_text' => $textMsg,
            'created_at' => $dateTime
        ]);

        if ($sendMsg != null) {
            echo json_encode('true');
        } else {
            echo json_encode('false');
        }
    }

    public function sendImageFileMsg(Request $request)
    {
        $txtChatId = $request->txtChatId;
        $txtCurrentUserId = $request->txtCurrentUserId;
        $txtUserId = $request->txtUserId;

        if (isset($_FILES['file']['name'])) {

            /* Getting file name */
            $filename = $_FILES['file']['name'];
            $Path = 'chats_images/';
            $destinationPath = public_path($Path);
            /* Location */
            $location = $destinationPath . $filename;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);

            $filesize = $_FILES["file"]["size"];

            $newFileName = str_random(10) . '.' . $imageFileType;

            $Path = 'chats_images/';
            $destinationPath = public_path($Path);

            $location = $destinationPath . $newFileName;

            /* Valid extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            $validFile_extensions = array("pdf", "docx", "doc");

            $response = 0;
            /* Check file extension */
            if (in_array(strtolower($imageFileType), $valid_extensions)) {
                // Verify file size - 5MB maximum
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    echo json_encode('filesize invalid');
                } else {
                    /* Upload file */
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                        $response = $location;


                        $mytime = \Carbon\Carbon::now();
                        $dateTime = $mytime->toDateTimeString();

                        $insertFileDB = Message::create([
                            'chat_id' => $txtChatId,
                            'sender_id' => $txtCurrentUserId,
                            'receiver_id' => $txtUserId,
                            'message_file' => $newFileName,
                            'file_type' => 'image',
                            'created_at' => $dateTime
                        ]);

                        if ($insertFileDB) {
                            echo json_encode(true);
                        } else {
                            echo json_encode(false);
                        }
                    }
                }
            } elseif (in_array(strtolower($imageFileType), $validFile_extensions)) {
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    echo json_encode('filesize invalid');
                } else {
                    /* Upload file */
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                        $response = $location;


                        $mytime = \Carbon\Carbon::now();
                        $dateTime = $mytime->toDateTimeString();

                        $insertFileDB = Message::create([
                            'chat_id' => $txtChatId,
                            'sender_id' => $txtCurrentUserId,
                            'receiver_id' => $txtUserId,
                            'message_file' => $newFileName,
                            'file_type' => 'file',
                            'created_at' => $dateTime
                        ]);

                        if ($insertFileDB) {
                            echo json_encode(true);
                        } else {
                            echo json_encode(false);
                        }
                    }
                }
            } else {
                echo json_encode('not a valid file type');
            }
        }
    }

    public function deleteChat($chatId, $userId)
    {
        $getChatDetails = Chat::where('chat_id', '=', $chatId)->get();
        if (count($getChatDetails) > 0) {
            $IdUser = $getChatDetails[0]->sender_id;
            // dd($getChatDetails[0]->sender_id);
            if ($IdUser == $userId) {
                $updateChatDetails = Chat::where('chat_id', '=', $chatId)->update(['sender_delete' => '1']);
                if ($updateChatDetails) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
            } else {
                $updateChatDetails = Chat::where('chat_id', '=', $chatId)->update(['receiver_delete' => '1']);
                if ($updateChatDetails) {
                    echo json_encode(true);
                } else {
                    echo json_encode(false);
                }
            }
        } else {
            echo json_encode(false);
        }
    }

    public function getUnreadMsg($uid)
    {
        $getUnreadMessages = Message::where('receiver_id', '=', $uid)->where('is_read', '=', 'no')->orderBy('created_at', 'DESC')->groupBy('chat_id')->get();

        // if(count($getUnreadMessages) > 0){
        if ($getUnreadMessages != null) {
            echo json_encode($getUnreadMessages);
        } else {
            echo json_encode('empty');
        }
    }

    public function updateUnreadMsg($chatId, $uid)
    {
        $getMsg = Message::where('chat_id', '=', $chatId)->orderBy('message_id', 'desc')->get();
        if (count($getMsg) > 0) {
            for ($i = 0; $i < count($getMsg); $i++) {
                $msgId = $getMsg[$i]->message_id;

                $updateUnreadMessages = Message::where('chat_id', '=', $chatId)->where('message_id', $msgId)->where('receiver_id', $uid)->update(['is_read' => 'yes']);
            }
            // return $msgId;
            echo json_encode($updateUnreadMessages);
        }


    }

    public function photos()
    {

        $query = request()->get('q');
        $sort = request()->get('sort');
        $pagination = 15;

        $data = Images::whereUserId(Auth::user()->id)->orderBy('id', 'desc')->paginate($pagination);

        // Search
        if (isset($query)) {
            $data = Images::where('title', 'LIKE', '%' . $query . '%')
                ->whereUserId(Auth::user()->id)
                ->orWhere('tags', 'LIKE', '%' . $query . '%')
                ->whereUserId(Auth::user()->id)
                ->orderBy('id', 'desc')->paginate($pagination);
        }

        // Sort
        if (isset($sort) && $sort == 'title') {
            $data = Images::whereUserId(Auth::user()->id)->orderBy('title', 'asc')->paginate($pagination);
        }

        if (isset($sort) && $sort == 'pending') {
            $data = Images::whereUserId(Auth::user()->id)->where('status', 'pending')->paginate($pagination);
        }

        if (isset($sort) && $sort == 'downloads') {
            $data = Images::join('downloads', 'images.id', '=', 'downloads.images_id')
                ->where('images.user_id', Auth::user()->id)
                ->groupBy('downloads.images_id')
                ->orderBy(\DB::raw('COUNT(downloads.images_id)'), 'desc')
                ->select('images.*')
                ->paginate($pagination);
        }

        if (isset($sort) && $sort == 'likes') {
            $data = Images::join('likes', function ($join) {
                $join->on('likes.images_id', '=', 'images.id')
                    ->where('images.user_id', Auth::user()->id)
                    ->where('likes.status', '=', '1');
            })
                ->groupBy('likes.images_id')
                ->orderBy(\DB::raw('COUNT(likes.images_id)'), 'desc')
                ->select('images.*')
                ->paginate($pagination);
        }

        return view('dashboard.photos', ['data' => $data, 'query' => $query, 'sort' => $sort]);
    }

    public function delete_photo(Request $request)
    {

        //<<<<---------------------------------------------

        $image = Images::find($request->id);

        // Delete Notification
        $notifications = Notifications::where('destination', $request->id)
            ->where('type', '2')
            ->orWhere('destination', $request->id)
            ->where('type', '3')
            ->orWhere('destination', $request->id)
            ->where('type', '6')
            ->get();

        if (isset($notifications)) {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }

        // Collections Images
        $collectionsImages = CollectionsImages::where('images_id', '=', $request->id)->get();
        if (isset($collectionsImages)) {
            foreach ($collectionsImages as $collectionsImage) {
                $collectionsImage->delete();
            }
        }

        // Images Reported
        $imagesReporteds = ImagesReported::where('image_id', '=', $request->id)->get();
        if (isset($imagesReporteds)) {
            foreach ($imagesReporteds as $imagesReported) {
                $imagesReported->delete();
            }
        }

        //<---- ALL RESOLUTIONS IMAGES
        $stocks = Stock::where('images_id', '=', $request->id)->get();

        foreach ($stocks as $stock) {

            $stock_path = 'uploads/' . $stock->type . '/' . $stock->name;
            $stock_pathVector = 'uploads/files/' . $stock->name;

            // Delete Stock
            if (\File::exists($stock_path)) {
                \File::delete($stock_path);
            }//<--- IF FILE EXISTS

            // Delete Stock Vector
            if (\File::exists($stock_pathVector)) {
                \File::delete($stock_pathVector);
            }//<--- IF FILE EXISTS

            $stock->delete();

        }//<--- End foreach

        $preview_image = 'uploads/preview/' . $image->preview;
        $thumbnail = 'uploads/thumbnail/' . $image->thumbnail;

        // Delete preview
        if (\File::exists($preview_image)) {
            \File::delete($preview_image);
        }//<--- IF FILE EXISTS

        // Delete thumbnail
        if (\File::exists($thumbnail)) {
            \File::delete($thumbnail);
        }//<--- IF FILE EXISTS

        $image->delete();

        \Session::flash('success_message', 'Image deleted successfully!');
        return redirect('user/dashboard/photos');


    }

    public function sales()
    {
        $data = Purchases::has('user')
            ->leftJoin('images', function ($join) {
                $join->on('purchases.images_id', '=', 'images.id');
            })
            ->where('images.user_id', Auth::user()->id)
            ->select('purchases.*')
            ->orderBy('purchases.id', 'DESC')
            ->paginate(30);

        return view('dashboard.sales')->withData($data);
    }

    public function purchases()
    {
        $data = Purchases::whereUserId(Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(30);

        return view('dashboard.purchases')->withData($data);
    }

    public function deposits()
    {

        $data = Deposits::whereUserId(Auth::user()->id)->orderBy('id', 'desc')->paginate(30);

        return view('dashboard.deposits-history')->withData($data);
    }

    // Add Funds
    public function addFunds()
    {
        // Stripe Key
        $_stripe = PaymentGateways::where('id', 2)->where('enabled', '1')->select('key')->first();

        return view('dashboard.add-funds')->with(['_stripe' => $_stripe]);
    }

    public function showWithdrawal()
    {

        $data = Withdrawals::whereUserId(Auth::user()->id)->paginate(20);
        return view('dashboard.withdrawals')->withData($data);

    }

    public function withdrawal()
    {
        if (Auth::user()->payment_gateway == 'PayPal'
            && empty(Auth::user()->paypal_account)

            || Auth::user()->payment_gateway == 'Bank'
            && empty(Auth::user()->bank)

            || empty(Auth::user()->payment_gateway)

        ) {
            \Session::flash('error', trans('misc.configure_withdrawal_method'));
            return redirect('user/dashboard/withdrawals');
        }

        // Verify amount validate
        if (Auth::user()->balance < $this->settings->amount_min_withdrawal) {
            \Session::flash('error', trans('misc.withdraw_not_valid'));
            return redirect('user/dashboard/withdrawals');
        }

        if (Auth::user()->payment_gateway == 'PayPal') {
            $_account = Auth::user()->paypal_account;
        } else {
            $_account = Auth::user()->bank;
        }

        $sql = new Withdrawals;
        $sql->user_id = Auth::user()->id;
        $sql->amount = Auth::user()->balance;
        $sql->gateway = Auth::user()->payment_gateway;
        $sql->account = $_account;
        $sql->save();

        // Remove Balance the User
        $userBalance = User::find(Auth::user()->id);
        $userBalance->balance = 0;
        $userBalance->save();

        return redirect('user/dashboard/withdrawals');

    }

    public function withdrawalConfigure()
    {

        if ($this->request->type != 'paypal' && $this->request->type != 'bank') {
            \Session::flash('error', trans('misc.error'));
            return redirect('user/dashboard/withdrawals/configure');
            exit;
        }

        // Validate Email Paypal
        if ($this->request->type == 'paypal') {
            $rules = array(
                'email_paypal' => 'required|email|confirmed',
            );

            $this->validate($this->request, $rules);

            $user = User::find(Auth::user()->id);
            $user->paypal_account = $this->request->email_paypal;
            $user->payment_gateway = 'PayPal';
            $user->save();

            \Session::flash('success', trans('admin.success_update'));
            return redirect('user/dashboard/withdrawals/configure');

        }// Validate Email Paypal

        elseif ($this->request->type == 'bank') {

            $rules = array(
                'bank' => 'required',
            );

            $this->validate($this->request, $rules);

            $user = User::find(Auth::user()->id);
            $user->bank = $this->request->bank;
            $user->payment_gateway = 'Bank';
            $user->save();

            \Session::flash('success', trans('admin.success_update'));
            return redirect('user/dashboard/withdrawals/configure');
        }

    }

    public function withdrawalDelete()
    {

        $withdrawal = Withdrawals::whereId($this->request->id)
            ->whereUserId(Auth::user()->id)
            ->whereStatus('pending')
            ->firstOrFail();

        if (isset($withdrawal)) {

            $withdrawal->delete();

            // Add Balance the User again
            User::find(Auth::user()->id)->increment('balance', $withdrawal->amount);

            return redirect('user/dashboard/withdrawals');

        }// Isset withdrawal

    }

    // withdrawals configure view
    public function withdrawalsConfigureView()
    {
        return view('dashboard.withdrawals-configure');
    }

}
